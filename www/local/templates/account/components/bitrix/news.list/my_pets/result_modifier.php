<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem)
{
	$bday = new DateTime($arItem["PROPERTIES"]["AGE"]["VALUE"]); 
	$today = new DateTime('now');
	$diff = $today->diff($bday);
	$arItem["PROPERTIES"]["AGE"]["VALUE"] = $diff->y." years, ".$diff->m." month, ".$diff->d." days";

	$reSizePic = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width" => 160, "height" => 160),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
	);
	$arItem["PREVIEW_PICTURE"]["SRC"] = $reSizePic["src"];
}