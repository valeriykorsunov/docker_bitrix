<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
echo '
<div class="personal-area__content">
	<div class="personal-area__grid">
		<div class="personal-area__left">
			<h1 class="h5 personal-area__title personal-area__title--mb-big">My Page</h1>
			<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--data">
				<div class="b-personal-data">
';


$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"customer",
	array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "N",
		"USER_PROPERTY" => array(),
		"SEND_INFO" => "Y",
		"CHECK_RIGHTS" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);
$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"change_your_password",
	array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y",
		"AJAX_MODE" => "N",
		"USER_PROPERTY" => array(),
		"SEND_INFO" => "Y",
		"CHECK_RIGHTS" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);

echo '
				</div>
			</div>
		</div>
	</div>
</div>
';
