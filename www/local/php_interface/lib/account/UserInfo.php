<?

namespace Account;

use Bitrix\Main\Diag\Debug;
use CFile;
use CIBlockElement;
use CModule;
use CUser;
use CUserFieldEnum;
use DateTime;
use Executor\Service;

class UserInfo
{
	const IBLOCK_ID_EXECUTOR = 22,
		IBLOCK_ID_USERS_IMG = 23;

	// OnAfterUserUpdate Событие OnAfterUserUpdate вызывается после попытки изменения свойств пользователя методом CUser::Update
	static function OnAfterUserUpdateHandler($arFields)
	{
		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag("executor_id_" . $arFields["ID"]);

		// Обновить записи в услугах
		Service::updateAllPropUser($arFields["ID"]);
	}

	// вызывается в момент удаления пользователя.
	static function OnUserDeleteHandler($user_id)
	{

		// удалить сервисы исполнителя
		Service::deletAll($user_id);
	}

	static function getUserPhoto($userID = 0)
	{
		global $USER;
		if ($userID === 0)
		{
			$userID = $USER->GetID();
		}
		$arUser = CUser::GetByID($userID)->Fetch();
		return CFile::GetPath($arUser['PERSONAL_PHOTO']);
	}

	static function addUserPhoto($file)
	{
		global $USER, $DB;
		//$request = Application::getInstance()->getContext()->getRequest();

		$el = new CIBlockElement;

		// $propValues = array();
		// $arProp = $request->getPostList()->getValues();

		// foreach ($arProp as $key => $values)
		// {
		// 	switch ($key)
		// 	{
		// 		case 'pet-type':
		// 			$propValues["TYPE_PET"] = $values;
		// 			break;
		// 		case 'pet-breed':
		// 			$propValues["PET_BREED"] = $values;
		// 			break;
		// 		case 'pet-size':
		// 			$propValues["SIZE"] = $values;
		// 			break;
		// 		case 'pet-gender':
		// 			$propValues["GENDER"] = $values;
		// 			break;
		// 		case 'pet-friendly':
		// 			$propValues["ANIMALS_NEARDY"] = $values;
		// 			break;
		// 		case 'pet-features':
		// 			$propValues["PET_FEATURES"] = $values;
		// 			break;
		// 		case 'pet-special-1':
		// 			if ($values == "on")
		// 				$propValues["SPAY_NEUT"] = "9";
		// 			break;
		// 		case 'pet-special-3':
		// 			if ($values == "on")
		// 				$propValues["FREND_ANIMALS"] = "10";
		// 			break;
		// 		case 'pet-special-4':
		// 			if ($values == "on")
		// 				$propValues["VACCINATED"] = "11";
		// 			break;
		// 		case 'pet-special-5':
		// 			if ($values == "on")
		// 				$propValues["FRIEND_CHILDREN_10"] = "12";
		// 			break;
		// 		case 'pet-special-2':
		// 			if ($values == "on")
		// 				$propValues["STAY_HOME_ALONE"] = "13";
		// 			break;
		// 		case 'pet-date':
		// 			$propValues["AGE"] = date($DB->DateFormatToPHP(FORMAT_DATETIME), strtotime($values));
		// 			break;
		// 	}
		// }
		// $propValues["USER_ID"] = $USER->GetID();
		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => self::IBLOCK_ID_USERS_IMG,
				"NAME" => $file["name"],
				"ACTIVE" => "Y",
				'PREVIEW_PICTURE' => $file,
				"PROPERTY_VALUES" => array("USER_ID" => $USER->GetID())
			),
			false,
			false,
			false
		);
		if ($PRODUCT_ID)
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("executor_id_" . $USER->GetID());
		}
		return $PRODUCT_ID;
	}

	static function deleteUserPhotoElem($id)
	{
		global $USER;
		if (!CModule::IncludeModule("iblock")) return false;

		$elem = CIBlockElement::GetList(array(), array("IBLOCK_ID" => self::IBLOCK_ID_USERS_IMG, "ID" => $id), false, false, array("IBLOCK_ID", "ID", "PROPERTY_USER_ID"))->Fetch();

		if ($elem["PROPERTY_USER_ID_VALUE"] == $USER->GetID())
		{
			CIBlockElement::Delete($id);
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("executor_id_" . $USER->GetID());
		}
	}

	// пересчитать отзывы
	static function recountStarsUser($idUser)
	{
		$res = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR,
				"ACTIVE" => "Y",
				"=PROPERTY_ID_EXECUTOR" => $idUser
			),
			false,
			false,
			array(
				"IBLOCK_ID",
				"NAME",
				"PROPERTY_RATING"
			)
		);
		$sumStar = 0;
		$sumVote = 0;
		while ($row = $res->GetNext())
		{
			$sumStar = $sumStar + $row["PROPERTY_RATING_VALUE"];
			$sumVote++;
		}

		$arResult["SUMM"] = $sumStar;
		$arResult["VOTE"] = $sumVote;
		
		$arResult["AVERAGE"] = $sumVote==0 ? 0 : round($sumStar / $sumVote, 0);

		return $arResult;
	}

	/**
	 * Возвращает массив групп пользователя по его ИД
	 */
	static function getUserGroupArrayID($idUser)
	{
		$arrayGroup = array();
		$res = CUser::GetUserGroupList($idUser);
		while ($arGroup = $res->Fetch())
		{
			$arrayGroup[] = $arGroup["GROUP_ID"];
		}
		return $arrayGroup;
	}

	static function getAge($fromDate)
	{
		$bday = new DateTime($fromDate);
		$today = new DateTime('now');
		$diff = $today->diff($bday);
		return $diff->y . " years";
	}

	static function getUserFieldValue($idField)
	{
		if ($idField)
		{
			$rsUField = CUserFieldEnum::GetList(array(), array("ID" => $idField))->Fetch();
			return $rsUField["VALUE"];
		}
		return false;
	}
	static function getUserFieldAllValue(int $id)
	{
		if ($id)
		{
			$rsUField = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $id));
			while ($arIFilds = $rsUField->GetNext())
			{
				$result[$arIFilds["ID"]] = $arIFilds["VALUE"];
			}
			return $result;
		}
		return false;
	}

	static function getUserMainService()
	{
		global $USER;
		$rsField = CUser::GetList($by = "ID", $order = "ASC", array("ID" => $USER->GetID()), array("SELECT" => array("UF_MAIN_SERVICE"), "FIELDS" => array("ID", "NAME")));
		$usField = $rsField->Fetch();
		return $usField["UF_MAIN_SERVICE"];
	}

	static function setFixPrice($price, $typePrice)
	{
		global $USER;
		$user = new CUser;
		$fields = array("UF_FIX_PRICE" => $price, "UF_FIX_PRICE_TYPE" => $typePrice);
		$user->Update($USER->GetID(), $fields);
	}

	static function getForSevice($userID = 0)
	{
		global $USER;
		if ($userID == 0) $userID = $USER->GetID();
		$data = CUser::GetList(
			($by = "ID"),
			($order = "ASC"),
			array(
				'GROUPS_ID' => array(5), // исполнитель
				'ID' => $userID
			),
			array(
				'SELECT' => array(
					// 'UF_TOP_100',
					'UF_POPULARITY',
					'UF_TYPE_PETS',
					'UF_UF_TYPE_HOUSING',
					'UF_NON_SMOKERS',
					'UF_CHILD_10',
					'UF_TOP_100',
					'UF_HEADLINE'
				),
				'FIELDS' => array(
					'ID',
					'ACTIVE',
					'NAME',
					'LAST_NAME',
					'PERSONAL_PHOTO',
					'PERSONAL_COUNTRY',
					'PERSONAL_CITY'
				)
			)
		);

		return $data->Fetch();
	}

	// static function getMissedMessages()
	// {
	// 	global $DB;
	// 	global $USER;
	// 	$strSql = 'SELECT ID, UF_ID_SENDER, UF_ID_RECIPIENT, UF_MESSAGE, UF_READ_MESSAGE 
	// 				FROM chat 
	// 				WHERE UF_ID_RECIPIENT='.$USER->GetID().' AND UF_READ_MESSAGE != 1
	// 				ORDER BY ID
	// 	';
	// 	$res = $DB->QueryBind($strSql, true);

	// 	Debug::dumpToFile($res->SelectedRowsCount());
	// 	while ($row = $res->GetNext()) {
	// 		Debug::dumpToFile($row);
	// 	}
	// 	Debug::dumpToFile("--------------------------------------");
	// }

	/**
	 * Получает имя пользователя и фамилию по заданному идентификатору.
	 *
	 * @param int $id Идентификатор пользователя.
	 * @throws Some_Exception_Class Описание исключения.
	 * @return string Полное имя пользователя.
	 */
	public static function getUserNameAndLastNameForId($id)
	{
		$res = CUser::GetByID($id)->Fetch();
		return $res["NAME"]." ".$res["LAST_NAME"];
	}
}
