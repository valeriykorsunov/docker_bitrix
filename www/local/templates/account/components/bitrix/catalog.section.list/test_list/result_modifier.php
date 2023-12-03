<?

use Bitrix\Main\Config\Option;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// получить результат тестирования 
foreach ($arResult['SECTIONS'] as &$arSection)
{
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_NUMBER_QUESTIONS", "PROPERTY_NUMBER_CORRECT_ANSWERS");
	$arFilter = Array(
		"IBLOCK_ID"=>"19", 
		"ACTIVE"=>"Y", 
		"PROPERTY_USER_ID" => $USER->GetID(), 
		"PROPERTY_TEST_ID" => $arSection["ID"]
	);
	$arSection["RES_TEST"] = CIBlockElement::GetList(Array("id"=>"desk"), $arFilter, false, false, $arSelect)->GetNext();
	if($arSection["RES_TEST"])
	{
		$x1=ceil(($arSection["RES_TEST"]["PROPERTY_NUMBER_CORRECT_ANSWERS_VALUE"]/$arSection["RES_TEST"]["PROPERTY_NUMBER_QUESTIONS_VALUE"])*100);
		$x2 =(float)Option::get("askaron.settings", "UF_PERCENT_TEST");
		
		$arSection["RES_TEST_TRUE"] = ($x1>=$x2);
	}
}
