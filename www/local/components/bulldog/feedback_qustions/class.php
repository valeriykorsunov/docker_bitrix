<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

class CfeedbackQuestions extends CBitrixComponent
{
	private $arFieldsSend;

	function executeComponent()
	{
		if ($this->startResultCache() && $_SERVER["REQUEST_METHOD"] !== "POST" && $_GET["popup"] !== "y")
		{
			$this->includeComponentTemplate();
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["personal"] == 'on')
		{
			$GLOBALS['APPLICATION']->RestartBuffer();
			
			$sentemail = $this->sendMailBx($this->arParams["MESSAGE_ID"]);
			
			if ($sentemail)
			{
				$this->addSendToIB();
			}

			die();
		}

		return $this->arResult;
	}

	function sendMailBx($message_id = 7)
	{
		//$email = htmlspecialchars($request->getQuery("email")); 
		$event = 'FEEDBACK_FORM';
		$site_id = SITE_ID;
		$arFields = array(
			"AUTHOR" => $_POST["user_name"],
			"AUTHOR_EMAIL" => $_POST["user_email"],
			"TEXT" => $_POST["message"],
			"DATA_TIME" => $_POST["dataTime"],
		);

		$result = CEvent::Send($event, $site_id, $arFields, '', $message_id);

		if ($result)
		{
			$this->arFieldsSend = $arFields;
		}

		return $result;
	}

	private function addSendToIB()
	{
		$this->arParams["IBLOCK_ID"];
		$el = new CIBlockElement;
		
		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"NAME" => $this->arFieldsSend["AUTHOR"],
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => $this->arFieldsSend["TEXT"],
				"PROPERTY_VALUES" => array(
					"AUTHOR_EMAIL" => $this->arFieldsSend["AUTHOR_EMAIL"]
				)
			),
			false,
			false,
			false
		);
		
		return $PRODUCT_ID;
	}

}
?>