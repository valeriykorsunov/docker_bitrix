<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Test");

echo'
<div class="personal-area__content">
	<h1 class="h5 personal-area__title">Qualification tests</h1>
	<div class="personal-area__gray-wrapper">
		<div id="question_block" class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--in-gray personal-area__scroll-block--center-content">
';
$APPLICATION->IncludeComponent(
	"bulldog:test",
	"",
	Array(
		"IBLOCK_ID" => "18",
		"IBLOCK_ID_RESULT" => "19",
		"LocalRedirect" => "/account/tests/"
	)
);

echo'
</div>
</div>
</div>
';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>