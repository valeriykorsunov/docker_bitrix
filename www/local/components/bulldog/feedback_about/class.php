<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;


class CfeedbackAbout extends CBitrixComponent
{
	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();
		$fields = array();


		if ($this->startResultCache() && !$request->isPost())
		{
			$this->includeComponentTemplate();
		}

		if ($request->isPost() && $request->getPost("personal") !== "")
		{
			$fields["AUTHOR_NAME"] = $request->getPost("name");
			$fields["AUTHOR_PHONE"] = $request->getPost("phone");
			$fields["CITY"] = $request->getPost("city");
			$fields["AUTHOR_EMAIL"] = $request->getPost("email");
			$fields["MESSAGE"] = $request->getPost("message");
			
			$sentemail = $this->sendMailBx($this->arParams["MESSAGE_ID"], $fields);
			if ($sentemail)
			{
				$this->addSendToIB($fields);
			}
		}
	}


	/** 
	 * 	SendImmediate - отправка сразу..
	 */
	function sendMailBx($message_id = 7, $fields) 
	{
		$event = 'FEEDBACK_FORM';
		$site_id = SITE_ID;

		$result = CEvent::Send($event, $site_id, $fields, '', $message_id);
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
				"PREVIEW_TEXT" => $fields["MESSAGE"],
				"PROPERTY_VALUES" => array(
					"PHONE" => $fields["AUTHOR_PHONE"],
					"CITY" => $fields["CITY"],
					"EMAIL" => $fields["AUTHOR_EMAIL"],
				)
			),
			false,
			false,
			false
		);

		return $PRODUCT_ID;
	}
}
