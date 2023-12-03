<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div style="margin-top:70px;" class="text-page">
	<div class="wrap wrap--limited wrap--relative">
		<h1>Contacts</h1>
 <br>
<div class="b-contacts__bottom">
			<span class="decor b-contacts__leaves" aria-hidden="true">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/theme/decor-leaves-contacts.svg" alt>
			</span>

				<?
				$APPLICATION->IncludeComponent(
					"bulldog:feedback_about", 
					"", 
					array(
						"COMPONENT_TEMPLATE" => "",
						"IBLOCK_ID" => "14",
						"ID_FORM" => "about-proj",
						"MESSAGE_ID" => "34"
					),
					false,
					array("HIDE_ICONS" => "Y")
				);
				?>


				<?
				$APPLICATION->IncludeComponent(
					"bulldog:content.blocks", 
					"contacts-about", 
					array(
						"CACHE_TIME" => "7200",
						"CACHE_TYPE" => "A",
						"IBLOCK_ID" => "",
						"ID_ELEM" => "",
						"COMPONENT_TEMPLATE" => "contacts-about",
						"header" => "We are always in touch!",
						"inst_name_link" => "@BobbyBulldog"
					),
					false
				);
				?>

			</div>
		<!--<b> Address: 185 Haydons Road, London, SW19 8TB, UK </b> <br>
		<b> Phone: +442082557719 </b> <br>
		<b> E-mail: <a href="mailto:Bobbythebulldoggy@gmail.com">Bobbythebulldoggy@gmail.com</a> </b> <br>-->
		<!-- <hr> -->
		 <?
// 		 $APPLICATION->IncludeComponent(
// 	"bitrix:news.list",
// 	"tariffs",
// 	Array(
// 		"ACTIVE" => "Y",
// 		"CACHE_FILTER" => "Y",
// 		"CACHE_GROUPS" => "Y",
// 		"CACHE_TIME" => "3600",
// 		"CACHE_TYPE" => "A",
// 		"FIELD_CODE" => array(),
// 		"IBLOCK_ID" => "25",
// 		"IBLOCK_TYPE" => "tariffs",
// 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
// 		"NEWS_COUNT" => "10",
// 		"PAGER_TEMPLATE" => "",
// 		"PROPERTY_CODE" => array("DAYS","PRICE"),
// 		"SET_TITLE" => "N",
// 		"SORT_BY1" => "SORT",
// 		"SORT_BY2" => "ID",
// 		"SORT_ORDER1" => "ASC",
// 		"SORT_ORDER2" => "DESC"
// 	)
// );
?>
		<!-- <div style="margin-top: 30px;position: absolute;">
 <a href="/terms_conditions/">BtheB Terms &amp; Conditions</a>
		</div> -->
	</div>
</div>
<div style="margin-top:70px;">
<?$APPLICATION->IncludeComponent(
	"bulldog:content.blocks",
	"social-link",
	array(
		"COMPONENT_TEMPLATE" => "social-link",
		"IBLOCK_ID" => "",
		"ID_ELEM" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3000"
	),
	false
				);?> 
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>