<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


\Bitrix\Main\Diag\Debug::dumpToFile($_REQUEST ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);


\Bitrix\Main\Diag\Debug::dumpToFile($_SERVER ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);