<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Tests");
$APPLICATION->SetTitle("Tests");

$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"test_list",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "tests",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("NAME","DESCRIPTION",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "/account/tests/#ID#/",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"TITLE" => $APPLICATION->GetPageProperty("TITLE")
	)
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>