<?

use Account\AccountAccess;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Моя страница");

if(AccountAccess::$typeUser == "CUSTOMER")
{
	include 'customer.php';
}
if(AccountAccess::$typeUser == "EXECUTOR")
{
	include 'executor.php';
}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>