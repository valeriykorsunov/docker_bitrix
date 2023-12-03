<?

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!CModule::IncludeModule("iblock")) return exit;

function AjaxServiceRequest(){
	global $USER;
	if(!$USER->IsAuthorized()) return false;

	$request = Application::getInstance()->getContext()->getRequest();
	
	if($request->getPost("requestStart")=="Y")
	{
		return Account\ServiceRequest::start($request["requestID"]);
	}

	if($request->getPost("requestEnd")=="Y")
	{
		return Account\ServiceRequest::end($request["requestID"]);
	}
	
	if($request->getPost("requestDelete")=="Y")
	{
		return Account\ServiceRequest::delete($request["requestID"]);
	}
}
/*------------------------------------------------------------------------------*/

if(\Site\App\UserLicense::getStatus()){
	$res = AjaxServiceRequest();
}

