<?
//define('NEED_AUTH', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	".default",
	Array("AUTH_RESULT" => $APPLICATION->arAuthResult)
);

