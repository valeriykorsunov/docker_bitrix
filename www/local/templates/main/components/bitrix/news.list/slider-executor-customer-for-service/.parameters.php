<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"inscription_on_the_central_picture" => Array(
		"NAME" => GetMessage("inscription_on_the_central_picture"),
		"TYPE" => "STRING",
		"DEFAULT" => "Забота о вашем питомце совсем рядом",
	),
	"url_executor" => Array(
		"NAME" => GetMessage("url_executor"),
		"TYPE" => "STRING",
		"DEFAULT" => "/",
	),
	"url_customer" => Array(
		"NAME" => GetMessage("url_customer"),
		"TYPE" => "STRING",
		"DEFAULT" => "/#",
	),
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>
