<?

use Bitrix\Main\Diag\Debug;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as &$arItems)
{
	$reSizePic = CFile::ResizeImageGet(
		$arItems["PREVIEW_PICTURE"],
		array("width" => 85, "height" => 81),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
	);
	$arItems["PREVIEW_PICTURE"]["SRC"] = $reSizePic["src"];
}

