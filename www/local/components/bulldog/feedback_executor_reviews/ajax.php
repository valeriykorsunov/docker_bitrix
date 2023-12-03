<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$APPLICATION->IncludeComponent("bulldog:feedback_executor_reviews","",array("IBLOCK_ID"=>"22"));

