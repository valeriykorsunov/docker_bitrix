<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;


class CfeedbackCall extends CBitrixComponent
{

	/* 
	 * метод executeComponent исполнянется вместо component.php
	 */
	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();
		$fields = array();

		if ($request->isPost() && $request->getPost("personal") == "on" && $request["feedback_call"] == "y")
		{
			$fields["AUTHOR_NAME"] = $request->getPost("name");
			$fields["AUTHOR_PHONE"] = $request->getPost("phone");
			$fields["PROP_TIME"] = $request->getPost("time");
			$fields["PESONAL"] = $request->getPost("personal");
			$fields["EMAIL_TO"] = COption::GetOptionString('main','email_from');
			
			$sentemail = $this->sendMailBx($request->getPost("PARAM_MESSAGE_ID"), $fields);

			$GLOBALS['APPLICATION']->RestartBuffer();
				if ($sentemail == "Y")
				{
					$this->addSendToIB($fields);
				}
				else
				{
					echo "Ошибка отправки сообщения - executeComponent";
				}
			die();
		}

		if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["popup"] == "y")
		{
			$GLOBALS['APPLICATION']->RestartBuffer();

			$this->includeComponentTemplate();

			die();
		}
	}


	/** 
	 * 	SendImmediate - отправка сразу..
	 */
	function sendMailBx($message_id = 7, $fields) 
	{
		$event = 'FEEDBACK_FORM';
		$site_id = SITE_ID;

		$result = CEvent::SendImmediate($event, $site_id, $fields, '', $message_id);
		return $result;
	}

	private function addSendToIB($fields)
	{
		global $USER, $DB;

		$el = new CIBlockElement;

		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"NAME" => $fields["AUTHOR_NAME"],
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => "",
				"PROPERTY_VALUES" => array(
					"PHONE" => $fields["AUTHOR_PHONE"],
					"RESPONSE_TIME" => $fields["PROP_TIME"]
				)
			),
			false,
			false,
			false
		);

		return $PRODUCT_ID;
	}
}
