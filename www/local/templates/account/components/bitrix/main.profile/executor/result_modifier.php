<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();


// тип жилья - значения списка
$arParams = $arResult["USER_PROPERTIES"]["DATA"]["UF_TYPE_HOUSING"];
if(!empty($arParams["USER_TYPE"]["CLASS_NAME"])){
	$rsEnum = call_user_func_array(
		array($arParams["USER_TYPE"]["CLASS_NAME"], "getlist"),
		array(
			$arParams,
		)
	);
}
$enum = array();
if (is_object($rsEnum))
{
	while ($arEnum = $rsEnum->GetNext())
	{
		$enum[$arEnum["ID"]] = $arEnum["VALUE"];
	}
}
$arResult["USER_PROPERTIES"]["DATA"]["UF_TYPE_HOUSING"]["FIELDS"] = $enum;

// тип жилья - значения списка
$arParams = $arResult["USER_PROPERTIES"]["DATA"]["UF_TYPE_PETS"];
$rsEnum = call_user_func_array(
	array($arParams["USER_TYPE"]["CLASS_NAME"], "getlist"),
	array(
		$arParams
	)
);
$enum = array();
if (is_object($rsEnum))
{
	while ($arEnum = $rsEnum->GetNext())
	{
		$enum[$arEnum["ID"]] = $arEnum["VALUE"];
	}
}
$arResult["USER_PROPERTIES"]["DATA"]["UF_TYPE_PETS"]["FIELDS"] = $enum;


// получить список изображений

global $USER;
$res = CIBlockElement::GetList(
	array(),
	array("IBLOCK_ID" => 23, "PROPERTY_USER_ID"=>$USER->GetID()),
	false,
	false,
	array("IBLOCK_ID","ID", "PREVIEW_PICTURE","PROPERTY_USER_ID")
);

$img = array();
while ($resImg = $res->Fetch())
{
	if ($resImg["PREVIEW_PICTURE"])
	{
		$resizeImg = CFile::ResizeImageGet(
			$resImg["PREVIEW_PICTURE"],
			array(
				"width" => 150,
				"height" => 150
			)
		);
		$resImg["PREVIEW_PICTURE_PATH"] = $resizeImg["src"];
	}
	$img[] = $resImg;
}
$arResult["img"] = $img;
