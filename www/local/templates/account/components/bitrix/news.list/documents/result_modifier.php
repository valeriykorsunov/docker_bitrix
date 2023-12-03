<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem)
{

// Документы
		$arFile = CFile::GetByID($arItem["PROPERTIES"]["FILE"]["VALUE"])->Fetch();
		$file["SIZE"] = CFile::FormatSize($arFile["FILE_SIZE"]);
		$file["PATH"] = CFile::GetPath($arFile["ID"]);
		
		setlocale(LC_ALL, 'ru_RU.utf8');
		$path_info = pathinfo($arFile["ORIGINAL_NAME"]);
		$file["EXTENTION"] = $path_info['extension'];
		$file["FILE_NAME"] =  substr ($arFile["ORIGINAL_NAME"], 0, strrpos($arFile["ORIGINAL_NAME"], '.'));
		
		$arItem["PROPERTIES"]["FILE"]["VALUE_FILE"] = $file;

}