<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;

// отзыв
class CfeedbackReviews extends CBitrixComponent
{
	private
		$fileId,
		$arFieldsSend;

	/* 
	 * метод executeComponent исполнянется вместо component.php
	 */
	function executeComponent()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["personal"] == "on")
		{
			$GLOBALS['APPLICATION']->RestartBuffer();

			$sentemail = $this->sendMailBx($_POST['PARAM_MESSAGE_ID']);

			if ($sentemail)
			{
				$this->addSendToIB();
			}
			else
			{
				echo "Ошибка отправки сообщения - CfeedbackReviews";
			}

			die();
		}

		if ($_SERVER["REQUEST_METHOD"] == "GET" && $this->request["reviewsPopUp"] == "y")
		{
			$GLOBALS['APPLICATION']->RestartBuffer();

			$this->includeComponentTemplate();

			die();
		}

		return $this->arResult;
	}

	/** Отправка сообщения используюя функцию битрикс
	 * 
	 */
	function sendMailBx($message_id = 32) 
	{
		//$email = htmlspecialchars($request->getQuery("email")); 
		$arFileId = array();
		foreach($_FILES["files"]['type'] as $key => $type)
		{
			$arFileId[$key] = CFile::SaveFile(
				array(
					"name" => $_FILES["files"]['name'][$key],   // имя файла, как оно будет в письме
					"size" => $_FILES["files"]['size'][$key],   // работает и без указания размера
					"tmp_name" => $_FILES["files"]['tmp_name'][$key],                    // собственно файл
					// "type" => "",                            // тип, не ясно зачем
					"old_file" => "0",                          // ID "старого" файла
					"del" => "N",                               // удалять прошлый?
					"MODULE_ID" => "",                          // имя модуля, работает и так
					"description" => "",                        // описание
					// "content" => "содержимое файла"          // если указать, то вместо файла будет указанный текст
				),
				'mails',  // относительный путь от upload, где будут храниться файлы
				false,    // ForceMD5
				false     // SkipExt
			);
		}

		$event = 'FEEDBACK_FORM';
		$site_id = SITE_ID;
		$arFields = array(
			"AUTHOR" => $_POST["name"],
			"AUTHOR_EMAIL" => $_POST["email"],
			"TEXT" => $_POST["review-text"],
			"DATA_TIME" => $_POST["dataTime"],
			"COUNT_FILES" => count($_FILES["files"]['name']),// файлов в письме
			"APPRAISAL" => $_POST["appraisal"],// Общая оценка сервиса
			// ссылка на элемент в админке
		);

		$result = CEvent::Send($event, $site_id, $arFields, '', $message_id, $arFileId);

		foreach($arFileId as $id)
		{
			CFile::Delete($id);
		}

		return $result;
	}

	private function addSendToIB()
	{
		global $USER, $DB;

		$el = new CIBlockElement;

		$property_enums = CIBlockPropertyEnum::GetList(
			array(),
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"CODE" => "RATING",
				"VALUE" => $_POST["appraisal"]
			)
		);
		$propRating = $property_enums->Fetch();

		foreach ($_FILES["files"]['type'] as $key => $type)
		{
			$photo['n' . $key] = array(
				"VALUE" => array(
					"name" => $_FILES["files"]['name'][$key],
					"size" => $_FILES["files"]['size'][$key],
					"tmp_name" => $_FILES["files"]["tmp_name"][$key],
					"type" => $_FILES["files"]['type'][$key]
				)
			);
		}

		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"NAME" => $_POST["name"],
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "N",
				"PREVIEW_TEXT" => $_POST["review-text"],
				"PROPERTY_VALUES" => array(
					"USER" => $USER->GetID(),
					"RATING" => $propRating["ID"],
					"PHOTO" => $photo
				)
			),
			false,
			false,
			false
		);

		return $PRODUCT_ID;
	}
}
