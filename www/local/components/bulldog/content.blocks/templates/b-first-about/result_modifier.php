<?
use Bitrix\Main\Diag\Debug;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$arResult["src_first_image"] = CFile::GetPath($arResult["fields"]["PREVIEW_PICTURE"]);

$arResult["first_decor_image"] = CFile::GetPath($arResult["props"]["LIST_IMG"]["VALUE"][0]);
$arResult["decor_image_medium"] = CFile::GetPath($arResult["props"]["LIST_IMG"]["VALUE"][1]);
$arResult["decor_image_large"] = CFile::GetPath($arResult["props"]["LIST_IMG"]["VALUE"][2]);