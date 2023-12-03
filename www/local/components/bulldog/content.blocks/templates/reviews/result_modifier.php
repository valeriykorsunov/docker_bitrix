<?

use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Entity\ExpressionField;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$res = CIBlockElement::GetList(
	array(),
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y"
	),
	false,
	false,
	array(
		"ID", "IBLOCK_ID", "PROPERTY_RATING", "ACTIVE"
	)
);
$sum_rating = 0;
$num_rows = $res->result->num_rows;
while ($ar_fields = $res->GetNext())
{
	$sum_rating += $ar_fields["PROPERTY_RATING_VALUE"];
	//Debug::dump($ar_fields);
}

$arResult["AVERAGE_RATING"] = round($sum_rating/$num_rows, 2);
