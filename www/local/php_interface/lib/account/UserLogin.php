<?

namespace Account;

use Bitrix\Main\Application;
use Account\AccountAccess;
use Bitrix\Main\Diag\Debug;
use CIBlockElement;
use CUser;
use NotificationAndChat;

class UserLogin
{
	const IBLOCK_ID_EXECUTOR_SERVICE = 21;

	//  Проверяем пришел ли email или login и если email авторизуем по нему
	static function DoBeforeUserLoginHandler(&$arFields)
	{
		$userLogin = $_POST["USER_LOGIN"];
		if (isset($userLogin))
		{
			$isEmail = strpos($userLogin, "@");
			if ($isEmail > 0)
			{
				$arFilter = array("EMAIL" => $userLogin);
				$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $arFilter);
				if ($res = $rsUsers->Fetch())
				{
					if ($res["EMAIL"] == $arFields["LOGIN"])
						$arFields["LOGIN"] = $res["LOGIN"];
				}
			}
		}
	}

	//до попытки регистрации нового пользователя методом CUser::Register
	static function OnBeforeUserRegisterHandler(&$arFields)
	{
		$request = Application::getInstance()->getContext()->getRequest();
		if(!$request["personal-data-agreements"]) return false;

		\Bitrix\Main\Diag\Debug::dumpToFile($arFields ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);
		// подставляет email в логин; парсит фио
		// $fio = preg_replace('/^ +| +$|( ) +/m', '$1', $arFields["LOGIN"] );
		// $arFIO = explode(" ", $fio);
		// $arFields["NAME"] = $arFIO[0];
		// $arFields["LAST_NAME "] = $arFIO[1];
		$arFields["LOGIN"] = $arFields["EMAIL"];

		// выбрать группу
		$request = Application::getInstance()->getContext()->getRequest();
		if( $request->getPost("GROUP_ID"))
		{
			$arFields["GROUP_ID"][] = $request->getPost("GROUP_ID");
		}


		// включить уведомления по умолчанию
		$arFields["UF_ADMIN_EMAIL"] = 1;
		//return false;
	}

	// вызывается после попытки добавления нового пользователя методом CUser::Add. 
	static function OnAfterUserAddHandler(&$arFields)
	{
		//UserLogin::isAddServiceDogsitting($arFields["ID"]);

		$notif = new NotificationAndChat();
		$message = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_NOTIF_NEW_USER");
		$notif->sentNotification($message, $arFields["ID"]);
	}

	/**
	 * вызван из метода CUser::Authorize после авторизации пользователя
	 */
	static function OnAfterUserAuthorizeHandler($arUser)
	{
		//self::isAddServiceDogsitting($arUser["user_fields"]["ID"]);
	}

	/**
	 * добавить обязательную услугу пользователю
	 */
	static function addServiceDogsitting($idUser)
	{
		$OBLIGATORILY_SER = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_OBLIGATORILY_SER");

		global $DB;
		$el = new CIBlockElement;

		foreach($OBLIGATORILY_SER as $service)
		{
			// проверить есть ли в базе такой элемент
			$res = CIBlockElement::GetList(
				array(),
				array(
					"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR_SERVICE,
					"ACTIVE" => "Y",
					"=PROPERTY_USER_ID" => $idUser,
					"!PROPERTY_DOGSITTING" => false,
					"NAME" => $service
				),
				false,
				false,
				array(
					"IBLOCK_ID",
					"NAME",
				)
			);
			if($res->SelectedRowsCount() > 0) continue;

			$propValues = array();
			$propValues["PRICE"] = "0";
			$propValues["USER_ID"] = $idUser;
			$propValues["DOGSITTING"] = "35";
	
			$PRODUCT_ID = $el->Add(
				array(
					"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR_SERVICE,
					"NAME" => $service,
					"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
					"ACTIVE" => "Y",
					"PREVIEW_TEXT" => "",
					"PROPERTY_VALUES" => $propValues
				),
				false,
				false,
				false
			);
		}
	}

	/**
	 * проверить наличие у исполнителя обязательных услуг
	 */
	static function isAddServiceDogsitting($idUser)
	{
		if(AccountAccess::isExecutor($idUser))
		{
			$res = CIBlockElement::GetList(
				array(),
				array(
					"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR_SERVICE,
					"ACTIVE" => "Y",
					"=PROPERTY_USER_ID" => $idUser,
					"!PROPERTY_DOGSITTING" => false
				),
				false,
				false,
				array(
					"IBLOCK_ID",
					"NAME",
					"PROPERTY_SERVICE_AVAILABLE",
					"PROPERTY_CALCULATION_PERIOD",
					"PROPERTY_PRICE",
					"DOGSITTING"
				)
			);
			$OBLIGATORILY_SER = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_OBLIGATORILY_SER");
			
			if($res->SelectedRowsCount() < count($OBLIGATORILY_SER))
			{
				self::addServiceDogsitting($idUser);
			}
		}
	}
	
}
