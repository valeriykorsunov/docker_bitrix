<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Dogsitters");


echo'
<div style="margin-top:20px;" class="inner-page inner-page--small performers">
';

$APPLICATION->IncludeComponent("bulldog:executor.list","",array()); 

echo '<div class="wrap wrap--limited performers__social">';
	$APPLICATION->IncludeComponent(
	"bulldog:content.blocks", 
	"social-list", 
	array(
		"COMPONENT_TEMPLATE" => "social-link",
		"IBLOCK_ID" => "",
		"ID_ELEM" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3000"
	),
	false
);

echo' </div>
</div>
';

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>