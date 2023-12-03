<?
namespace Executor;

use CIBlockElement;
use Pet;
use Account\UserInfo;
use BulldogUtils;

class Service 
{
	
	static private $IBLOCK_ID = "21";
	// Обновить свойство "имеются питомцы у догситтера" всех услуг догситтера
	static function udatePropAllElementsUser($userID, $propName)
	{
		$res = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID" => self::$IBLOCK_ID,
				"USER_ID" => $userID
			),
			false,
			false,
			array(
				"ID", "IBLOCK_ID"
			)
		);
		$isUserHas = Pet::isUserHas($userID);

		while($item = $res->GetNext())
		{
			CIBlockElement::SetPropertyValues(
				$item, 
				self::$IBLOCK_ID, 
				$propName, 
				Pet::isUserHas($userID)
			);
		}
	}

	static function deletAll($userID)
	{
		$res = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID" => self::$IBLOCK_ID,
				"USER_ID" => $userID
			),
			false,
			false,
			array(
				"ID", "IBLOCK_ID"
			)
		);

		while($item = $res->GetNext())
		{
			CIBlockElement::Delete($item["ID"]);
		}
	}

	static function updateAllPropUser($userID)
	{
		
		$res = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID" => self::$IBLOCK_ID,
				"PROPERTY_USER_ID" => $userID
			),
			false,
			false,
			array(
				"ID", "IBLOCK_ID","ACTIVE"
			)
		);
		while($item = $res->GetNext())
		{
			self::updateService($item["ID"], $userID);
		}
	}
	
	static function updateService($elementID, $userID)
	{
		$PROP = array();
		
		$res = CIBlockElement::GetProperty(
			self::$IBLOCK_ID,
			$elementID,
			array("sort" => "asc")
		);
		
		while ($ob = $res->GetNext())
		{
			$PROP[$ob["CODE"]] = $ob["VALUE"];
		}
		
		$userInfo = UserInfo::getForSevice($userID);
		$PROP["USER_ACTIVE"] = $userInfo["ACTIVE"];
		// Страна
		$PROP["USER_COUNTRY"] = $userInfo["PERSONAL_COUNTRY"];
		// Город
		$PROP["USER_CITY"] = $userInfo["PERSONAL_CITY"];
		// Популярность
		$PROP["USER_POPULARITY"] = $userInfo["UF_POPULARITY"];
		// Тип питомцев
		$PROP["USER_TYPE_PETS"] = array();
		foreach($userInfo["UF_TYPE_PETS"] as $value)
		{
			$PROP["USER_TYPE_PETS"][] = BulldogUtils::getXmlIdFromHighloadblock($value, 4);
		}
		// Тип жилья
		$PROP["USER_TYPE_HOUSING"] = BulldogUtils::getXmlIdFromHighloadblock($userInfo["UF_UF_TYPE_HOUSING"], 5);
		// Некурящие в доме
		$PROP["USER_NON_SMOKERS"] = $userInfo["UF_NON_SMOKERS"];
		// детей до 10 лет
		$PROP["USER_CHILD_10"] = $userInfo["UF_CHILD_10"];
		// топ 100
		$PROP["USER_TOP_100"] = $userInfo["UF_TOP_100"];

		$arrFilds = array(
			"PROPERTY_VALUES" => $PROP
		);
		$el = new CIBlockElement;
		$res = $el->Update($elementID, $arrFilds);

		if ($res)
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("services_id_" . $userID);
		}

		return $res;
	}

}