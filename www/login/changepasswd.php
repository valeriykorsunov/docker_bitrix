<?
define("NEED_AUTH", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>

$APPLICATION->IncludeComponent('bitrix:system.auth.changepasswd', '', array());

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>