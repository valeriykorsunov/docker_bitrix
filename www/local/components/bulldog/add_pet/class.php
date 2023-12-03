<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Application;
use Bitrix\Main\Authentication\Context;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;


class AddPet extends CBitrixComponent
{

	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();

		if ($request->isPost() && $request->getPost("pet-name") != "")
		{
			$this->addToIB();
		}

		if ($this->startResultCache())
		{
			$this->arResult["PROP"] = $this->getPropertyTypeList();
			$this->includeComponentTemplate();
		}
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
					$propValues["SPAY_NEUT"] = $values;
					break;
				case 'pet-special-2':
					$propValues["FREND_ANIMALS"] = $values;
					break;
				case 'pet-special-4':
					$propValues["VACCINATED"] = $values;
					break;
				case 'pet-special-5':
					$propValues["FRIEND_CHILDREN_10"] = $values;
					break;
				case 'pet-special-2':
					$propValues["STAY_HOME_ALONE"] = $values;
					break;
				case 'pet-date':
					$propValues["AGE"] = $values;
					break;
			}
		}
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

		return $PRODUCT_ID;
	}

	// получить значения свойств типа список
	function getPropertyTypeList()
	{
		$arProp = array();
		$IBLOCK_ID =  $this->arParams["IBLOCK_ID"];

		// CIBlockProperty::GetByID или CIBlockProperty::GetList
		// $properties = CIBlockProperty::GetList(
		// 	array("sort" => "asc", "name" => "asc"), 
		// 	array(
		// 		"ACTIVE" => "Y", 
		// 		"IBLOCK_ID" => $IBLOCK_ID,
		// 		"PROPERTY_TYPE" => "L"
		// 	)
		// );
		// while ($prop_fields = $properties->GetNext())
		// {

		// 	Debug::dumpToFile($prop_fields);
		// }

		return $arProp;
	}
}
