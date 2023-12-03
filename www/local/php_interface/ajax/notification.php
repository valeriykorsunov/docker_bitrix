<?
use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Application::getInstance()->getContext()->getRequest();

// удаление 
if($request->getQuery("delete-user-img") == "y" && $request->getQuery("id"))
{
	
	exit;
}