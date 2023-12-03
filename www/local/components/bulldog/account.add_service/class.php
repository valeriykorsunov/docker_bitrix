<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Account\UserInfo;
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

class AddService extends CBitrixComponent
{

	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();
		if ($this->arParams["request_handler"] == "Y") {
			if ($request->isPost() && $request->getPost("name") != "") {
				$GLOBALS['APPLICATION']->RestartBuffer();
				$addToIB = $this->addToIB();
			}

			if ($request->getQuery("id") != "" && $request->getQuery("delete") == "y") {
				$this->deleteElem($request->getQuery("id"));
			}

			if ($request->getPost("id") != "" && $request->getPost("updadeServiceAvailable") == "y") {
				$this->updateServiceAvailable($request);
			}

			if ($request->getPost("id") != "" && $request->getPost("formUpdateService") == "Y") {
				$GLOBALS['APPLICATION']->RestartBuffer();
				$this->formUpdateService($request);
			}
		} elseif ($this->startResultCache()) {
			$this->arResult["CALCULATION_PERIOD"] = $this->getPropertyTypeList(60);
			$this->arResult["SERVICE_NAME_LIST"] = $this->getServiceNameList();
			$this->includeComponentTemplate();
		}
	}

	function getServiceNameList()
	{
		$result = \Bitrix\Iblock\ElementTable::getList([
			"select" => [
				"NAME"
			],
			"filter" => [
				"IBLOCK_ID" => \DogSitter\Settings::ID_IB_ServiceNameList,
				"ACTIVE" => "Y",
			]
		])->fetchAll();

		return $result;
	}

	private function addToIB()
	{
		global $USER, $DB;
		$request = Application::getInstance()->getContext()->getRequest();

		$el = new CIBlockElement;

		$propValues = array();
		$propValues["PRICE"] = $request->getPost("price");
		$propValues["CALCULATION_PERIOD"] = $request->getPost("price-type");
		$propValues["USER_ID"] = $USER->GetID();

		// получить свойства пользователя 
		$userInf = Account\UserInfo::getForSevice();
		$propValues["USER_ACTIVE"] = $userInf["ACTIVE"];
		// Страна
		$propValues["USER_COUNTRY"] = $userInf["PERSONAL_COUNTRY"];
		// Город
		$propValues["USER_CITY"] = $userInf["PERSONAL_CITY"];
		// Популярность
		$propValues["USER_POPULARITY"] = $userInf["UF_POPULARITY"];
		// Тип питомцев
		foreach ($userInf["UF_TYPE_PETS"] as $value) {
			$propValues["USER_TYPE_PETS"][] = BulldogUtils::getXmlIdFromHighloadblock($value, 4);
		}
		// Тип жилья
		$propValues["USER_TYPE_HOUSING"] = BulldogUtils::getXmlIdFromHighloadblock($userInf["UF_UF_TYPE_HOUSING"], 5);
		// Некурящие в доме
		$propValues["USER_NON_SMOKERS"] = $userInf["UF_NON_SMOKERS"];
		// детей до 10 лет
		$propValues["USER_CHILD_10"] = $userInf["UF_CHILD_10"];
		// топ 100
		$propValues["USER_TOP_100"] = $userInf["UF_TOP_100"];
		// имеются питомцы у догситтера - делать запрос
		$propValues["THERE_ARE_PETS"] = Pet::isUserHas($USER->GetID());

		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
				"NAME" => $request->getPost("name"),
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => $request->getPost("description"),
				"PROPERTY_VALUES" => $propValues
			),
			false,
			false,
			false
		);
		if ($PRODUCT_ID) {
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("services_id_" . $USER->GetID());
		}
		return $PRODUCT_ID;
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
		while ($enum_fields = $property_enums->GetNext()) {
			$arProp[$enum_fields["ID"]] = $enum_fields["VALUE"];
		}

		return $arProp;
	}

	function deleteElem($id)
	{
		global $USER;
		$elem = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ID" => $id), false, false, array("IBLOCK_ID", "ID", "PROPERTY_USER_ID"))->Fetch();

		if ($elem["PROPERTY_USER_ID_VALUE"] == $USER->GetID()) {
			CIBlockElement::Delete($id);
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("services_id_" . $USER->GetID());
		}
	}

	function updateServiceAvailable($request)
	{

		$PROP = array();

		$res = CIBlockElement::GetProperty(
			$this->arParams["IBLOCK_ID"],
			$request->getPost("id"),
			array("sort" => "asc")
		);
		while ($ob = $res->GetNext()) {
			$PROP[$ob["CODE"]] = $ob["VALUE"];
		}

		$PROP["SERVICE_AVAILABLE"] = $request->getPost("updadeValue");
		$el = new CIBlockElement;
		$res = $el->Update(
			$request->getPost("id"),
			array(
				"PROPERTY_VALUES" => $PROP
			)
		);
		if ($res) {
			global $USER;
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("services_id_" . $USER->GetID());
		}
	}

	function formUpdateService($request)
	{
		global $USER;
		$PROP = array();

		$res = CIBlockElement::GetProperty(
			$this->arParams["IBLOCK_ID"],
			$request->getPost("id"),
			array("sort" => "asc")
		);
		while ($ob = $res->GetNext()) {
			$PROP[$ob["CODE"]] = $ob["VALUE"];
		}

		$PROP["PRICE"] = $request->getPost("service-1-price");
		$PROP["CALCULATION_PERIOD"] = $request->getPost("service-1-price-type");
		$PROP["TYPE_SERVICES"] = $request->getPost("TYPE_SERVICES");
		$PROP["USER_ID"] = $USER->GetID();

		$arrFilds = array(
			"PREVIEW_TEXT" => $request->getPost("service-1-description"),
			"PROPERTY_VALUES" => $PROP
		);
		if ($PROP["DOGSITTING"] != 35){
			$arrFilds["NAME"] = $request->getPost("service-1-name");
		} 

		$el = new CIBlockElement;
		$res = $el->Update($request->getPost("id"), $arrFilds);
		if ($res) {
			if ($PROP["DOGSITTING"] == 35) {
				$res = UserInfo::getUserMainService();
				$nameRecService = $request->getPost("name_edit");
				if ($nameRecService == $res) {
					UserInfo::setFixPrice($PROP["PRICE"], $PROP["CALCULATION_PERIOD"]);
				}
			}
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("services_id_" . $USER->GetID());
		}
		return $res;
	}
}
