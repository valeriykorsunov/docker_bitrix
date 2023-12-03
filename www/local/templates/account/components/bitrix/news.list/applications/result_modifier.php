<?

use Account\AccountAccess;
use Account\UserInfo;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Запрос кол-ва непрочитанных сообщений
// if($arResult["ITEMS"])
// {
// 	$arMisMessage = UserInfo::getMissedMessages();
// }

foreach ($arResult["ITEMS"] as &$arItem)
{
	if (AccountAccess::$typeUser == "CUSTOMER")
	{
		$arItem["recipientID"] = $arItem["PROPERTIES"]["EXECUTOR_ID"]["VALUE"];
	}

	if (AccountAccess::$typeUser == "EXECUTOR")
	{
		$arItem["recipientID"] = $arItem["PROPERTIES"]["CUSTOMER_ID"]["VALUE"];
	}

	if(strtotime($arItem["ACTIVE_TO"]) < date(time()))
	{
		$arItem["activeApplication"] = FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"]))." - ".FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_TO"]));
		// $arItem["activeApplication"] = "Completed";
	}
	else
	{
		$arItem["activeApplication"] = FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"]))." - ".FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_TO"]));
	}

	// Услуга
	$arItem["SERVICE"] = CIBlockElement::GetByID($arItem["PROPERTIES"]["SERVICE"]["VALUE"])->Fetch();
	// питомец
	$resPet = CIBlockElement::GetList([],["ID"=>$arItem["PROPERTIES"]["PET"]["VALUE"]],false,false,["ID","IBLOCK_ID","NAME","PROPERTY_TYPE_PET","PROPERTY_PET_BREED"])->GetNextElement();

	$arItem["PET"] = [
		// "FIELDS" => $resPet->GetFields(),
		"PROP" => $resPet->GetProperties()
	];
	$arItem["PET"]["TYPE"] = Pet::getNameTypePet($arItem["PET"]["PROP"]["TYPE_PET"]["VALUE"]);

	$arItem["CONTACT_NAME"] = UserInfo::getUserNameAndLastNameForId($arItem["recipientID"]);
	
	// CIBlockElement::GetList([],["ID"=>$arItem["PROPERTIES"]["PET"]["VALUE"]],false,false,["ID","IBLOCK_ID","NAME","PROPERTY_TYPE_PET","PROPERTY_PET_BREED"])->Fetch();
}