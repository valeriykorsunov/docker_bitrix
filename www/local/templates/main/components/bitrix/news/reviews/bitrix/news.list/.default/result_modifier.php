<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["ITEMS"] as &$arItem)
{
	
	if ($arItem["PROPERTIES"]["USER"]["VALUE"])
	{
		$rsUser = CUser::GetByID($arItem["PROPERTIES"]["USER"]["VALUE"]);
		$arUser = $rsUser->Fetch();

		$arItem["USER"]["NAME"] = $arUser["NAME"].$arUser["LAST_NAME"];
		$arItem["USER"]["PERSONAL_PHOTO"] = CFile::GetPath($arUser["PERSONAL_PHOTO"]);
		
		$res = \Bitrix\Main\UserGroupTable::getList(
			array(
				'filter' => array(
					'USER_ID' => $arItem["PROPERTIES"]["USER"]["VALUE"], 
					'GROUP.ACTIVE' => 'Y',
					'GROUP_ID' => array("5","6")
				),
				'select' => array('GROUP_ID', 'GROUP_CODE' => 'GROUP.STRING_ID', 'GROUP_NAME' => 'GROUP.NAME'),
			)
		);
		$row = $res->fetchAll();
		$arItem["USER"]["GROUP"] = $row[0];
	}
}
