<?

use Account\AccountAccess;
use Mailing;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Notification");

if(AccountAccess::$typeUser == "CUSTOMER")
{
	$APPLICATION->IncludeComponent(
		"bitrix:main.profile",
		"customer_notification",
		array(
			"USER_PROPERTY_NAME" => "",
			"SET_TITLE" => "Y",
			"AJAX_MODE" => "N",
			"USER_PROPERTY" => array(),
			"SEND_INFO" => "Y",
			"CHECK_RIGHTS" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"TITLE" => $APPLICATION->GetPageProperty("TITLE")
		)
	);
}
if(AccountAccess::$typeUser == "EXECUTOR")
{
	$APPLICATION->IncludeComponent(
		"bitrix:main.profile",
		"executor_notification",
		array(
			"USER_PROPERTY_NAME" => "",
			"SET_TITLE" => "Y",
			"AJAX_MODE" => "N",
			"USER_PROPERTY" => array(),
			"SEND_INFO" => "Y",
			"CHECK_RIGHTS" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"TITLE" => $APPLICATION->GetPageProperty("TITLE")
		)
	);
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>