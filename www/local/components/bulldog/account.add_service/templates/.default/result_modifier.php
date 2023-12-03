<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
	$arResult["TYPE_SERVICE"]=$arPropTypeServ;


