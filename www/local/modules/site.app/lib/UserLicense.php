<?

namespace Site\App;

use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Config\ConfigurationException;
use Bitrix\Main\LoaderException;

class UserLicense
{
	protected static $STATUS;
	protected static $LicenseDate;
	protected static $LicenseDateDemo;

	/**
	 * Текущий статус подписки
	 * @return bool 
	 */
	static function getStatus()
	{
		if (\is_null(self::$STATUS)) {
			self::determineStatus();
		}

		return self::$STATUS;
	}

	/**
	 * Вычислить лицензию пользователя
	 * @return bool 
	 */
	protected static function determineStatus()
	{
		global $USER, $DB;
		if (!$USER->IsAuthorized()) return \false;

		$date1 = self::getLicenseDate();
		// $date2 = date('d/m/Y H:i:s a');     // текущее время и дата
		$date2 = date($DB->DateFormatToPHP(\CSite::GetDateFormat("SHORT") . " H:i:s a"), time());     // текущее время и дата
		$result = $DB->CompareDates($date1, $date2); // функция сравнения 
		if ($result >= 0)
			self::$STATUS = \true;
		else
			self::$STATUS = \false;

		return self::$STATUS;
	}

	/**
	 * Проверяем параметр. Если поле пустое то вернуть текущую дату -1 день. 
	 * @param mixed $data 
	 * @return string отформатированная дата
	 */
	private static function setDateLicense($data)
	{
		global $DB;
		if ($data) {
			return $data;
		} else {
			$dateNew = new \DateTime();
			$dateNew->modify("-1 day");
			return $dateNew->format($DB->DateFormatToPHP(\CSite::GetDateFormat("SHORT") . " H:i:s a"));
		}
	}

	/**
	 * Возвращает дату окончания лицензии текущего пользователя.
	 * используется: - для ограничений в чате. 
	 * @return 
	 */
	static function getLicenseDate()
	{
		if (self::$LicenseDate) return self::$LicenseDate;

		global $USER, $DB;
		$userID = $USER->GetID();
		$data = \CUser::GetList(
			($by = "ID"),
			($order = "ASC"),
			array(
				'ID' => $userID
			),
			array(
				'SELECT' => array(
					'UF_LICENSE_END',
					'UF_LICENSE_DEMO'
				),
				'FIELDS' => array(
					'ID',
					'NAME',
					'LAST_NAME',
				)
			)
		)->Fetch();
		$LicenseDate = self::setDateLicense($data["UF_LICENSE_END"]);
		$LicenseDateDemo = self::setDateLicense($data["UF_LICENSE_DEMO"]);
		self::$LicenseDate = $DB->CompareDates($LicenseDate, $LicenseDateDemo) >= 0 ? $LicenseDate : $LicenseDateDemo;

		return self::$LicenseDate;
	}

	/**
	 * 
	 * @return array массив с ключами: 
	 * "RED_PERIOD"  bool -  лицензия заканчивается или закончилась
	 * "DAYS_LEFT"  string - осталось дней.
	 */
	static function InformationDaysLeft()
	{
		$result = ["RED_PERIOD" => \true];
		$dataEnd = self::getLicenseDate();
		$date1 = new \DateTime($dataEnd);
		$date2 = new \DateTime();
		//format("%H:%I:%S (Полных дней: %a)"); //('%r%a');
		$dataDays  = $date2->diff($date1);
		$result["DAYS_LEFT"] = (int)$dataDays->format("%r%a");
		if ($result["DAYS_LEFT"] < 5) {
			$result["DAYS_LEFT"] = $result["DAYS_LEFT"] < 0 ? 0 : $dataDays->format("Full days: %a (%H:%I:%S)");
		} else {
			$result["RED_PERIOD"] = \false;
		}

		return $result;
	}

	/**
	 * Добавить новую оплату от пользователя
	 * @return bool
	 */
	static function addNewPayment($idGoods)
	{
		if (!\CModule::IncludeModule("iblock")) return false;
		$arResult = \CIBlockElement::GetList(
			array(),
			array(
				"ID" => $idGoods,
				"IBLOCK_ID" => 25, // 
				"ACTIVE" => "Y"
			),
			\false,
			\false,
			array(
				"IBLOCK_ID", "ID", "NAME", "PROPERTY_DAYS", "PROPERTY_PRICE", "PROPERTY_SUM"
			)
		)->Fetch();
		if (!$arResult) {
			// TODO ERROR элемент(товар) не найден 
			return \false;
		}
		global $USER, $DB;
		$el = new \CIBlockElement;
		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => 26, // Заказы подписок
				"NAME" => $arResult["NAME"],
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => "",
				"PROPERTY_VALUES" => array(
					"USER" => $USER->GetID(),
					"TARIFF" => $arResult["ID"],
					"STATUS" => 46 // 46 = waiting for payment
				)
			),
			false,
			false,
			false
		);
		if (!$PRODUCT_ID) {
			// TODO Error не удалось записать продажу
			return \false;
		}

		return [
			"id" => $PRODUCT_ID,
			"sum" => $arResult["PROPERTY_SUM_VALUE"]
		];
	}

	/**
	 * Изменяет статус указанных тарифов.(заказ оплачен)
	 *
	 * @param int $idOrder ID тарифов, для которых нужно изменить статус.
	 * @throws Exception Если модуль "iblock" не может быть подключен.
	 * @return mixed
	 */
	static function changeStatus($idOrder)
	{
		if (!\CModule::IncludeModule("iblock")) return false;

		// изменить дату окончания лицензии 
		\Bitrix\Main\Loader::includeModule("iblock");
		$orderClass = \Bitrix\Iblock\Iblock::wakeUp(\DogSitter\Settings::ID_IB_orders)->getEntityDataClass();
		$arOrder = $orderClass::GetList([
			"select" => [
				"US" => "USER.VALUE",
				"T" => "TARIFF.VALUE"
			],
			'filter' => [
				"ID" => $idOrder
			]
		])->Fetch();

		$tariffClass = \Bitrix\Iblock\Iblock::wakeUp(\DogSitter\Settings::ID_IB_Tariffs)->getEntityDataClass();
		$tariff =$tariffClass::getList([
			"select" => [
				"D" => "DAYS.VALUE"
			],
			'filter' => [
				"ID" => $arOrder["T"]
			]
		])->Fetch();

		$data = \CUser::GetList(
			($by = "ID"),
			($order = "ASC"),
			array(
				'ID' => $arOrder["US"]
			),
			array(
				'SELECT' => array(
					'UF_LICENSE_END'
				),
				'FIELDS' => array(
					'ID'
				)
			)
		)->Fetch();
		global $DB;	
		$dateTime = new \DateTime();
		$dateTime->format($DB->DateFormatToPHP(\CSite::GetDateFormat("SHORT") . " H:i:s"));	
		$licDateEnd = new \DateTime($data["UF_LICENSE_END"]);

		$newDate = $licDateEnd > $dateTime ? $licDateEnd : $dateTime;

		$newDate->modify(\round("+".$tariff["D"]) . " day");

		global $USER;
		$user = new \CUser;
		$fields = array(
			"UF_LICENSE_END" => $newDate->format("m/d/Y H:i:s")
		);
		$up = $user->Update($arOrder["US"], $fields);

		return \CIBlockElement::SetPropertyValues(
			$idOrder,
			\DogSitter\Settings::ID_IB_orders,
			"45",
			"STATUS",
		);

	}
}
