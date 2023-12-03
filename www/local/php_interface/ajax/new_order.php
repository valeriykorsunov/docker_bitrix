<?
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Application::getInstance()->getContext()->getRequest();

if($request->isPost() & $request->getPost("check") == "")
{
	$param = array(
		"ID_EXECUTOR" => $request->getPost("executorID"),
		"DATE_FROM" => $request->getPost("start-date"),
		"DATE_TO" => $request->getPost("end-date"),
		"SERVICE" => $request->getPost("service"),
		"PET" => $request->getPost("pets"),
		"MESSAGE" => $request->getPost("message"),

	);
	DogsitterOrder::addOrder($param);
}