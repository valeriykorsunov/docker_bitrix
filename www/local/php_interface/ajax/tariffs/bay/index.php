<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// echo"<pre>"; var_dump($_POST); echo "</pre>"; exit;
$input = json_decode(file_get_contents("php://input"), true);
$arResult = array();
if(json_last_error() === 0)
{
	$add = \Site\App\UserLicense::addNewPayment($input["ID"]);
	$arResult["idPay"] = $add["id"];
	$arResult["sum"] = $add["sum"];
	$arResult["successfully"] = $add ? "Y" : "N" ;
	header('Content-Type: application/json');
	echo json_encode($arResult);
}
exit;