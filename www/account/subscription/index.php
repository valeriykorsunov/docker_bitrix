<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Managing subscriptions");

$APPLICATION->IncludeFile("/account/subscription/inc.php", [], ["SHOW_BORDER"=>false]);
?>



<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>