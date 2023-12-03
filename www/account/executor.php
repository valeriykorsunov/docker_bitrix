<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"executor",
	array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "N",
		"USER_PROPERTY" => array(
			0 => "UF_UF_TYPE_HOUSING",
			1 => "UF_TYPE_PETS",
			2 => "UF_NON_SMOKERS"
		),
		"SEND_INFO" => "Y",
		"CHECK_RIGHTS" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);
