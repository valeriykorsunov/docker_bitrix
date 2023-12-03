<?

use Bitrix\Main\Diag\Debug;

class BulldogUtils
{
	static function numbersOnly($str)
	{
		return preg_replace("/[^0-9]/", '', $str);
	}

	// принадлежит к указанной группе
	static function isUserGruop($idGroup)
	{
		global $USER;
		$arGroups = $USER->GetUserGroupArray();
		return (in_array($idGroup, $arGroups) || $USER->IsAdmin());
	}

	//Событие "OnAfterIBlockElementAdd" вызывается после попытки добавления нового элемента информационного блока методом CIBlockElement::Add.
	static function OnAfterIBlockElementAddHandler($arFields)
	{
		if ($arFields["IBLOCK_ID"] == 5) // Статьи
		{
			Mailing::addItemToQueue($arFields["ID"], "Articles");
		}
		if ($arFields["IBLOCK_ID"] == 17) // Материалы
		{
			Mailing::addItemToQueue($arFields["ID"], "materials");
		}
	}

	static function OnAfterIBlockSectionAddHandler($arFields)
	{
		if ($arFields["IBLOCK_ID"] == 18) // Тесты
		{
			Mailing::addItemToQueue($arFields["ID"], "Tests");
		}
	}

	// Получить UF_XML_ID в хайлоад блоке по ID
	static function getXmlIdFromHighloadblock($idItem, $highloadID)
	{
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($highloadID)->fetch();
		$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();

		$data = $entity_data_class::getList(array(
			"select" => array("ID", "UF_XML_ID"),
			"order" => array("ID" => "ASC"),
			"filter" => array("ID" => $idItem)  // Задаем параметры фильтра выборки
		))->Fetch();

		return $data["UF_XML_ID"];
	}

	// Список свойств 
	static function getListItemHighloadblock($highloadID)
	{
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($highloadID)->fetch();
		$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();

		$result = $entity_data_class::getList(array(
			"select" => array("ID", "UF_NAME"),
			"order" => array("UF_SORT"=>"ASC","UF_NAME" => "ASC")
		));

		$array = array();
		while ($item = $result->Fetch()) 
		{
			$array[] = $item;
		}
		return $array;
	}
}
