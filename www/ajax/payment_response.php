<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// изменить статус оплаты
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
\Bitrix\Main\Diag\Debug::dumpToFile($_REQUEST ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);

\Bitrix\Main\Diag\Debug::dumpToFile($request["transStatus"] ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);
\Bitrix\Main\Diag\Debug::dumpToFile($request["cartId"] ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);

if($request["transStatus"] == "Y"){
	\Site\App\UserLicense::changeStatus($request["cartId"]);
}
