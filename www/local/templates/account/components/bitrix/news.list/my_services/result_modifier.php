<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// foreach ($arResult["ITEMS"] as &$arItem)
// {
// 	$bday = new DateTime($arItem["PROPERTIES"]["AGE"]["VALUE"]); 
// 	$today = new DateTime('now');
// 	$diff = $today->diff($bday);
// 	$arItem["PROPERTIES"]["AGE"]["VALUE"] = $diff->y." years, ".$diff->m." month, ".$diff->d." days";

// 	$reSizePic = CFile::ResizeImageGet(
// 		$arItem["PREVIEW_PICTURE"],
// 		array("width" => 160, "height" => 160),
// 		BX_RESIZE_IMAGE_PROPORTIONAL,
// 		false
// 	);
// 	$arItem["PREVIEW_PICTURE"]["SRC"] = $reSizePic["src"];
// }


foreach ($arResult["ITEMS"] as &$arItem)
{
	// CALCULATION_PERIOD
	$arProp = array();
	$IBLOCK_ID =  $arParams["IBLOCK_ID"];
	$property_enums = CIBlockPropertyEnum::GetList(
		array("DEF" => "ASC", "SORT" => "ASC"),
		array(
			"IBLOCK_ID" => $IBLOCK_ID,
			"PROPERTY_ID" => 60 // CALCULATION_PERIOD
		)
	);
	while ($enum_fields = $property_enums->GetNext())
	{
		$arProp[$enum_fields["ID"]] = $enum_fields["VALUE"];
	}
	$arItem["CALCULATION_PERIOD"]=$arProp;
	
	// Type service
	$arPropTypeServ = array();
	$property_enums = CIBlockElement::GetList(
		array("SORT" => "ASC"),
		array(
			"IBLOCK_ID" => 24,
			"ACTIVE" => "Y"
		)
	);
	while ($enum_fields = $property_enums->GetNext())
	{
		$arPropTypeServ[$enum_fields["ID"]] = $enum_fields["NAME"];
	}
	$arItem["TYPE_SERVICE"]=$arPropTypeServ;
}

