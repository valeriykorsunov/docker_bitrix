<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock"))
return;

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("SORT" => "ASC"), Array("ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}



$arComponentParameters = array(
	"PARAMETERS"=> array(
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "ID инфобллока с тестами",
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"IBLOCK_ID_RESULT" => array(
			"PARENT" => "BASE",
			"NAME" => "ID инфобллока с тестами",
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"LocalRedirect" => array(
			"PARENT" => "BASE",
			"NAME" => "Путь для редиректа в случае отсутсвия элемента",
			"TYPE" => "STRING",
			"VALUES" => "/account/tests/"
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000),
	)

);