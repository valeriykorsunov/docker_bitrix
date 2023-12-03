<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$item)
{
	if ($item["IBLOCK_SECTION_ID"])
	{
		$db_sect = CIBlockSection::GetList(
			array(),
			array("IBLOCK_ID" => $item["IBLOCK_ID"], "ID" => $item["IBLOCK_SECTION_ID"]),
			false,
			array("IBLOCK_ID", "ID", "NAME", "UF_COLOUR")
		);
		$ar_res = $db_sect->GetNext();
		
		$obEnum = new \CUserFieldEnum;
		$rsEnum = $obEnum->GetList(array(), array("USER_FIELD_NAME" => "UF_COLOUR", "ID" => $ar_res["UF_COLOUR"]));

		$item["IBLOCK_SECTION_COLOR"] = $rsEnum->Fetch();
		$item["IBLOCK_SECTION_NAME"] = $ar_res['NAME'];
	}

}



// if (array_key_exists('IS_AJAX', $_REQUEST) && $_REQUEST['IS_AJAX'] == 'Y')
// {
//     $APPLICATION->RestartBuffer();
// }