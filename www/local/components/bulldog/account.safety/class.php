<?php

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class AccountSafety extends CBitrixComponent
{
	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();

		if($request->getQuery("deletFileID"))
		{
			global $USER;
			$obUser = new CUser;
			$arFields[$request->getQuery("deletFileID")] = array('del' => "Y");

			$obUser->Update($USER->GetID(), $arFields);
			
			die();
		}

		if($request->isPost() && $request->getPost("ADD_DOC") == "Y")
		{
			global $USER;
			$obUser = new CUser;
			$arFields[$request->getPost("PROPERTY_NAME")] = $request->getFile("DOCUMENT");
			$obUser->Update($USER->GetID(), $arFields);

			die();
		}

		if ($this->startResultCache())
		{
			global $USER;
			$data = CUser::GetList(
				($by = "ID"),
				($order = "ASC"),
				array('ID' => $USER->GetID()),
				array(
					"SELECT" => array(
						"UF_VERIFICATION_COMPLETED",
						"UF_DOCUMENT_1",
						"UF_DOCUMENT_2",
						"UF_DOCUMENT_3",
					),
					"FIELDS" => array("ID", "LOGIN")
				)
			);
			$arUser = $data->Fetch();
			$this->arResult["USER"] = $arUser;
			$this->arResult["USER"]["UF_DOCUMENT_1"] = $this->getFileUrls($arUser["UF_DOCUMENT_1"]);
			$this->arResult["USER"]["UF_DOCUMENT_1_ID"] = $arUser["UF_DOCUMENT_1"];
			$this->arResult["USER"]["UF_DOCUMENT_2"] = $this->getFileUrls($arUser["UF_DOCUMENT_2"]);
			$this->arResult["USER"]["UF_DOCUMENT_2_ID"] = $arUser["UF_DOCUMENT_2"];
			$this->arResult["USER"]["UF_DOCUMENT_3"] = $this->getFileUrls($arUser["UF_DOCUMENT_3"]);
			$this->arResult["USER"]["UF_DOCUMENT_3_ID"] = $arUser["UF_DOCUMENT_3"];

			if ($arUser["UF_VERIFICATION_COMPLETED"] == "1")
			{
				$this->includeComponentTemplate("verification_completed");
			}
			else
			{
				if($request->isPost() && $request->getPost("upData") == "Y") $GLOBALS['APPLICATION']->RestartBuffer();

					$this->includeComponentTemplate("no_verification");

				if($request->isPost() && $request->getPost("upData") == "Y") die();
			}
		}
	}

	function getFileUrls($docID)
	{
		$reSizePic = CFile::ResizeImageGet(
			$docID,
			array("width" => 178, "height" => 206),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false
		);

		$result["RESIZE_SRC"] = $reSizePic["src"];
		$result["PATH"] = CFile::GetPath($docID);

		return $result;
	}
}
