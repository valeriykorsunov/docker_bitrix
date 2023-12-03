<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



foreach ($arResult["ITEMS"] as &$arItem)
{
	if ($arItem["PROPERTIES"]["USER"]["VALUE"])
	{
		$rsUser = CUser::GetByID($arItem["PROPERTIES"]["USER"]["VALUE"]);
		$arUser = $rsUser->Fetch();
		$arItem["USER"]["NAME"] = $arUser["NAME"]." ".$arUser["LAST_NAME"];
		$arItem["USER"]["PERSONAL_CITY"] = $arUser["PERSONAL_CITY"];
		$arItem["USER"]["PERSONAL_PHOTO"] = CFile::GetPath($arUser["PERSONAL_PHOTO"]);
	}
}
