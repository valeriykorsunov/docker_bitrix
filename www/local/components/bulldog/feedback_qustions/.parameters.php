<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

$arIBlock = array();

$rsIBlock = CIBlock::GetList(array("SORT" => "ASC"), array("ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}


$arComponentParameters = array(
	"PARAMETERS" => array(
		"ID_FORM" => array(
			"PARENT" => "BASE",
			"NAME" => "Уникальный идентификатор формы",
			"STRING" => "STRING",
		),
		"MESSAGE_ID" => array(
			"PARENT" => "BASE",
			"NAME" => "ID почтового шаблона",
			"STRING" => "STRING",
		)
	)

);
