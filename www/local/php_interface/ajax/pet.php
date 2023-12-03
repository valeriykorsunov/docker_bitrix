<?

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost())
{
	$APPLICATION->IncludeComponent(
		"bulldog:my_pet",
		"",
		array(
			"IBLOCK_ID" => "15" 
		)
	);
}
