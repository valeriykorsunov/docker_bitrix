<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

class AddPet extends CBitrixComponent
{

	function executeComponent()
	{
		global $USER, $DB;
		if($this->request->isPost() & !$USER->IsAuthorized()){
			$GLOBALS['APPLICATION']->RestartBuffer();
			echo 'Требуется авторизация';
			exit;
		}
		$request = Application::getInstance()->getContext()->getRequest();
		$this->arResult["EDIT_PET"] = "N";
		$this->arResult["PET"]["BIRTHDAY"] = date($DB->DateFormatToPHP(FORMAT_DATETIME)); // день родждения

		if ($this->arParams["request_handler"] == "Y")
		{
			if ($request->isPost() & $this->request["EDIT_PET"] == "N" && $request->getPost("pet-name") != "")
			{
				$GLOBALS['APPLICATION']->RestartBuffer();
				$this->addToIB();
				exit;
			}

			if ($request->isPost() & $this->request["EDIT_PET"] == "Y" && $request->getPost("pet-name") != "")
			{
				$GLOBALS['APPLICATION']->RestartBuffer();
				$this->updatePet();
				exit;
			}

			if ($request->getQuery("id") != "" && $request->getQuery("delete") == "y")
			{
				$this->deleteElem($request->getQuery("id"));
				exit;
			}

			if ($request->isPost() & $request["FORM_EDIT_PET"] == "Y")
			{
				$this->getPetInfo();

				$GLOBALS["APPLICATION"]->RestartBuffer();
				$this->viewTemplate();
				exit;
			}

			if ($request->isPost() & $request["FORM_EDIT_PET"] == "N" && $this->request["CLEAR_FORM"] == "Y")
			{
				$GLOBALS["APPLICATION"]->RestartBuffer();
				$this->viewTemplate();
				exit;
			}

			if ($request->isPost() & $request["UPDATE_PET_CARD"] == "Y")
			{
				$GLOBALS["APPLICATION"]->RestartBuffer();
				$this->getPetInfo();
				echo json_encode( $this->arResult["PET"], JSON_UNESCAPED_UNICODE);
				exit;
			}

		}
		else
		{
			$this->viewTemplate();
		}
	}

	private function getPetInfo()
	{
		global $USER;

		$this->arResult["EDIT_PET"] = "Y";
		$arrPet = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_CODE" => "pets",
				"ID" => $this->request["PET_ID"],
				"PROPERTY_USER_ID" => $USER->GetID()
			),
			false,
			false,
			array(
				"NAME",
				"PREVIEW_PICTURE",
				"ACTIVE_FROM",
				"PROPERTY_TYPE_PET",
				"PROPERTY_PET_BREED",
				"PROPERTY_SIZE",
				"PROPERTY_GENDER",
				"PROPERTY_ANIMALS_NEARDY",
				"PROPERTY_PET_FEATURES",
				"PROPERTY_SPAY_NEUT",
				"PROPERTY_FREND_ANIMALS",
				"PROPERTY_VACCINATED",
				"PROPERTY_FRIEND_CHILDREN_10",
				"PROPERTY_STAY_HOME_ALONE"
			)
		)->Fetch();

		$this->arResult["PET"]["ID"] = $this->request["PET_ID"];
		$this->arResult["PET"]["TYPE_PET_ID"] = $arrPet["PROPERTY_TYPE_PET_ENUM_ID"];
		$this->arResult["PET"]["TYPE_PET_NAME"] =  $arrPet["PROPERTY_TYPE_PET_VALUE"];
		$this->arResult["PET"]["NAME"] = $arrPet["NAME"];
		$this->arResult["PET"]["PET_BREED"] = $arrPet["PROPERTY_PET_BREED_VALUE"];
		$this->arResult["PET"]["ANIMALS_NEARDY"] = $arrPet["PROPERTY_ANIMALS_NEARDY_VALUE"];
		$this->arResult["PET"]["SIZE"] = $arrPet["PROPERTY_SIZE_ENUM_ID"];
		$this->arResult["PET"]["SIZE_NAME"] = $arrPet["PROPERTY_SIZE_VALUE"];
		$this->arResult["PET"]["GENDER"] = $arrPet["PROPERTY_GENDER_ENUM_ID"];
		$this->arResult["PET"]["GENDER_NAME"] = $arrPet["PROPERTY_GENDER_VALUE"];
		$this->arResult["PET"]["PET_FEATURES"] = $arrPet["PROPERTY_PET_FEATURES_VALUE"];
		$this->arResult["PET"]["SPAY_NEUT"] = ($arrPet["PROPERTY_SPAY_NEUT_VALUE"] == "Yes" ? true : false); // Стерилизован/кастрирован
		$this->arResult["PET"]["STAY_HOME_ALONE"] = ($arrPet["PROPERTY_STAY_HOME_ALONE_VALUE"] == "Yes" ? true : false); // Остается ли питомец один дома
		$this->arResult["PET"]["FREND_ANIMALS"] = ($arrPet["PROPERTY_FREND_ANIMALS_VALUE"] == "Yes" ? true : false); // Дружелюбен к другим животным
		$this->arResult["PET"]["VACCINATED"] = ($arrPet["PROPERTY_VACCINATED_VALUE"] == "Yes" ? true : false); // Имеет необходимые вакцинации
		$this->arResult["PET"]["FRIEND_CHILDREN_10"] = ($arrPet["PROPERTY_FRIEND_CHILDREN_10_VALUE"] == "Yes" ? true : false); // Дружелюбен к детям до 10 лет
		$this->arResult["PET"]["BIRTHDAY"] = $arrPet["ACTIVE_FROM"]; // день родждения

		if ($arrPet["PREVIEW_PICTURE"])
		{
			$resizeImg = CFile::ResizeImageGet(
				$arrPet["PREVIEW_PICTURE"],
				array(
					"width" => 150,
					"height" => 150
				)
			);
			$this->arResult["PET"]["PREVIEW_PICTURE"]["SRC"] = $resizeImg["src"]; 
			$this->arResult["PET"]["PREVIEW_PICTURE"]["ID"] = $arrPet["PREVIEW_PICTURE"]; 
		}
	}

	private function viewTemplate()
	{
		foreach(BulldogUtils::getListItemHighloadblock(4) as $val) // 4 = Pettype
		{
			$this->arResult["PROP"]["TYPE_PET"][$val["ID"]] = $val["UF_NAME"]; 
		}
		$this->arResult["PROP"]["SIZE"] = $this->getPropertyTypeList(32);
		$this->arResult["PROP"]["GENDER"] = $this->getPropertyTypeList(33);

		$this->includeComponentTemplate();
	}

	private function addToIB()
	{
		global $USER, $DB;
		$request = Application::getInstance()->getContext()->getRequest();

		$el = new CIBlockElement;

		$propValues = array();
		$arProp = $request->getPostList()->getValues();

		foreach ($arProp as $key => $values)
		{
			switch ($key)
			{
				case 'pet-type':
					$propValues["TYPE_PET"] = $values;
					break;
				case 'pet-breed':
					$propValues["PET_BREED"] = $values;
					break;
				case 'pet-size':
					$propValues["SIZE"] = $values;
					break;
				case 'pet-gender':
					$propValues["GENDER"] = $values;
					break;
				case 'pet-friendly':
					$propValues["ANIMALS_NEARDY"] = $values;
					break;
				case 'pet-features':
					$propValues["PET_FEATURES"] = $values;
					break;
				case 'pet-special-1':
					if ($values == "on")
						$propValues["SPAY_NEUT"] = "9";
					break;
				case 'pet-special-3':
					if ($values == "on")
						$propValues["FREND_ANIMALS"] = "10";
					break;
				case 'pet-special-4':
					if ($values == "on")
						$propValues["VACCINATED"] = "11";
					break;
				case 'pet-special-5':
					if ($values == "on")
						$propValues["FRIEND_CHILDREN_10"] = "12";
					break;
				case 'pet-special-2':
					if ($values == "on")
						$propValues["STAY_HOME_ALONE"] = "13";
					break;
				case 'pet-date':
					$propValues["AGE"] = date($DB->DateFormatToPHP(FORMAT_DATETIME), strtotime($values));
					break;
			}
		}
		$propValues["USER_ID"] = $USER->GetID();
		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"NAME" => $request->getPost("pet-name"),
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "Y",
				'PREVIEW_PICTURE' => $request->getFile("avatar"),
				"PREVIEW_TEXT" => "",
				"PROPERTY_VALUES" => $propValues
			),
			false,
			false,
			false
		);
		if ($PRODUCT_ID)
		{
			Pet::afterChangeStateForPet();
		}
		return $PRODUCT_ID;
	}

	private function updatePet()
	{

		global $USER, $DB;
		$PROP = array();
		$PROP["USER_ID"] = $USER->GetID();
		$arProp = $this->request->getPostList()->getValues();
		foreach ($arProp as $key => $values)
		{
			switch ($key)
			{
				case 'pet-type':
					$PROP["TYPE_PET"] = $values;
					break;
				case 'pet-breed':
					$PROP["PET_BREED"] = $values;
					break;
				case 'pet-size':
					$PROP["SIZE"] = $values;
					break;
				case 'pet-gender':
					$PROP["GENDER"] = $values;
					break;
				case 'pet-friendly':
					$PROP["ANIMALS_NEARDY"] = $values;
					break;
				case 'pet-features':
					$PROP["PET_FEATURES"] = $values;
					break;
				case 'pet-special-1':
					if ($values == "on")
						$PROP["SPAY_NEUT"] = "9";
					break;
				case 'pet-special-3':
					if ($values == "on")
						$PROP["FREND_ANIMALS"] = "10";
					break;
				case 'pet-special-4':
					if ($values == "on")
						$PROP["VACCINATED"] = "11";
					break;
				case 'pet-special-5':
					if ($values == "on")
						$PROP["FRIEND_CHILDREN_10"] = "12";
					break;
				case 'pet-special-2':
					if ($values == "on")
						$PROP["STAY_HOME_ALONE"] = "13";
					break;
				case 'pet-date':
					$PROP["AGE"] = date($DB->DateFormatToPHP(FORMAT_DATETIME), strtotime($values));
					break;
			}
		}

		$arLoadProductArray = array(
			"MODIFIED_BY"    => $USER->GetID(),
			"PROPERTY_VALUES" => $PROP,
			"NAME" => $this->request->getPost("pet-name"),
		);

		if($this->request->getFile("avatar")["size"] > 1 ){
			$arLoadProductArray['PREVIEW_PICTURE'] = $this->request->getFile("avatar");
		}

		$el = new CIBlockElement;
		$res = $el->Update(
			$this->request->getPost("PET_ID"),
			$arLoadProductArray
		);

		if ($res)
		{
			Pet::afterChangeStateForPet();
		}
	}

	// получить значения свойств типа список
	function getPropertyTypeList($id)
	{
		$arProp = array();
		$IBLOCK_ID =  $this->arParams["IBLOCK_ID"];

		$property_enums = CIBlockPropertyEnum::GetList(
			array("DEF" => "ASC", "SORT" => "ASC"),
			array(
				"IBLOCK_ID" => $IBLOCK_ID,
				"PROPERTY_ID" => $id
			)
		);
		while ($enum_fields = $property_enums->GetNext())
		{
			$arProp[$enum_fields["ID"]] = $enum_fields["VALUE"];
		}

		return $arProp;
	}

	function deleteElem($id)
	{
		global $USER;
		$elem = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ID" => $id), false, false, array("IBLOCK_ID", "ID", "PROPERTY_USER_ID"))->Fetch();
		if ($elem["PROPERTY_USER_ID_VALUE"] == $USER->GetID())
		{
			CIBlockElement::Delete($id);
			Pet::afterChangeStateForPet();
		}
	}
}
