<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as &$arItem)
{
	$reSizePic = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"],
		array("width" => 601, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
	);
	$arItem["PREVIEW_PICTURE"]["RESIZE_SRC"] = $reSizePic["src"];
}