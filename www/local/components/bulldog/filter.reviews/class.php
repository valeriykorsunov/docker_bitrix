<?

use Bitrix\Main\Diag\Debug;

class FilterReviews extends CBitrixComponent
{

	public function executeComponent()
	{
		global $USER;
		if ($this->startResultCache(false, array($USER->GetGroups(),$_REQUEST)))
		{
			$this->arResult["STARS"] = $this->getStars();
			$this->includeComponentTemplate();
		}
	}

	function getStars()
	{
		$stars = array();
		$arSelect = array("ID", "NAME", "PROPERTY_RATING");
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"], 
			"ACTIVE" => "Y"
		);
		$res = CIBlockElement::GetList(
			array("PROPERTY_RATING" => "ASC"), 
			$arFilter, 
			array("PROPERTY_RATING"), 
			false, 
			$arSelect);
		while ($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$stars[$arFields["PROPERTY_RATING_VALUE"]] = $arFields["CNT"];
		}
		return $stars;
	}
}
