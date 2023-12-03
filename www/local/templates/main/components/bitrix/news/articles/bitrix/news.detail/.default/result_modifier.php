<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


	if ($arResult["IBLOCK_SECTION_ID"])
	{
		$db_sect = CIBlockSection::GetList(
			array(),
			array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]),
			false,
			array("IBLOCK_ID", "ID", "NAME", "UF_COLOUR")
		);
		$ar_res = $db_sect->GetNext();
		
		$obEnum = new \CUserFieldEnum;
		$rsEnum = $obEnum->GetList(array(), array("USER_FIELD_NAME" => "UF_COLOUR", "ID" => $ar_res["UF_COLOUR"]));

		$arResult["IBLOCK_SECTION_COLOR"] = $rsEnum->Fetch();
		$arResult["IBLOCK_SECTION_NAME"] = $ar_res['NAME'];
	}


	global $arrFilter;
	$arrFilter = array(
		"IBLOCK_SECTION_ID" => $arResult["IBLOCK_SECTION_ID"]
	);

$APPLICATION->SetPageProperty("TITLE", $arResult["NAME"]);