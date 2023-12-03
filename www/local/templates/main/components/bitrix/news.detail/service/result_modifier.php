<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1_IMG"]["VALUE"] != "")
{
	$reSizePic = CFile::ResizeImageGet(
		$arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1_IMG"]["VALUE"],
		array("width" => 300, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
		false
	);
	$arResult["SHORT_INSTRUCTIONS_1_IMG"] = $reSizePic["src"];
}
if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2_IMG"]["VALUE"] != "")
{
	$reSizePic = CFile::ResizeImageGet(
		$arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2_IMG"]["VALUE"],
		array("width" => 300, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
		false
	);
	$arResult["SHORT_INSTRUCTIONS_2_IMG"] = $reSizePic["src"];
}
if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3_IMG"]["VALUE"] != "")
{
	$reSizePic = CFile::ResizeImageGet(
		$arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3_IMG"]["VALUE"],
		array("width" => 300, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
		false
	);
	$arResult["SHORT_INSTRUCTIONS_3_IMG"] = $reSizePic["src"];
}
if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4_IMG"]["VALUE"] != "")
{
	$reSizePic = CFile::ResizeImageGet(
		$arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4_IMG"]["VALUE"],
		array("width" => 300, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
		false
	);
	$arResult["SHORT_INSTRUCTIONS_4_IMG"] = $reSizePic["src"];
}
