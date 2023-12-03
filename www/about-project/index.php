<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О проекте");

/** FILTERS */
global $filterPopularReviews;
$filterPopularReviews["!PROPERTY_POPULAR_REVIEWS"] = false;

?>

<div class="index">

	<?
	$APPLICATION->IncludeComponent(
		"bulldog:content.blocks",
		"b-first-about",
		array(
			"IBLOCK_ID" => "3",
			"ID_ELEM" => "100",
			"COMPONENT_TEMPLATE" => "b-first-about",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3000"
		),
		false
	);
	?>
	<div class="wrap wrap--limited wrap--relative" style="margin-bottom: 80px;">
		<?/*$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"tariffs",
			Array(
				"ACTIVE" => "Y",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"FIELD_CODE" => array(),
				"IBLOCK_ID" => "25",
				"IBLOCK_TYPE" => "tariffs",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"NEWS_COUNT" => "10",
				"PAGER_TEMPLATE" => "",
				"PROPERTY_CODE" => array("DAYS","PRICE"),
				"SET_TITLE" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "ID",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "DESC"
			)
);*/?>

	</div>

	<div class="wrap wrap--limited">
		<?
		$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"gallery_pets", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "information_for_pages",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "VIDEO",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "gallery_pets",
		"TITLE" => ""
	),
	false
);

/*$APPLICATION->IncludeComponent(
			"bulldog:content.blocks",
			"features",
			array(
				"CACHE_TIME" => "3000",
				"CACHE_TYPE" => "A",
				"IBLOCK_ID" => "3",
				"ID_ELEM" => "9",
				"var1" => "",
				"var2" => "",
				"var3" => "",
				"COMPONENT_TEMPLATE" => "features"
			),
			false
);*/

		// $APPLICATION->IncludeComponent(
		// 	"bitrix:news.list",
		// 	"popular_reviews",
		// 	array(
		// 		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		// 		"ADD_SECTIONS_CHAIN" => "N",
		// 		"AJAX_MODE" => "N",
		// 		"AJAX_OPTION_ADDITIONAL" => "",
		// 		"AJAX_OPTION_HISTORY" => "N",
		// 		"AJAX_OPTION_JUMP" => "N",
		// 		"AJAX_OPTION_STYLE" => "Y",
		// 		"CACHE_FILTER" => "N",
		// 		"CACHE_GROUPS" => "Y",
		// 		"CACHE_TIME" => "36000000",
		// 		"CACHE_TYPE" => "A",
		// 		"CHECK_DATES" => "Y",
		// 		"DETAIL_URL" => "",
		// 		"DISPLAY_BOTTOM_PAGER" => "Y",
		// 		"DISPLAY_DATE" => "Y",
		// 		"DISPLAY_NAME" => "Y",
		// 		"DISPLAY_PICTURE" => "Y",
		// 		"DISPLAY_PREVIEW_TEXT" => "Y",
		// 		"DISPLAY_TOP_PAGER" => "N",
		// 		"FIELD_CODE" => array(
		// 			0 => "",
		// 			1 => "",
		// 		),
		// 		"FILTER_NAME" => "filterPopularReviews",
		// 		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		// 		"IBLOCK_ID" => "10",
		// 		"IBLOCK_TYPE" => "reviews",
		// 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		// 		"INCLUDE_SUBSECTIONS" => "N",
		// 		"MESSAGE_404" => "",
		// 		"NEWS_COUNT" => "6",
		// 		"PAGER_BASE_LINK_ENABLE" => "N",
		// 		"PAGER_DESC_NUMBERING" => "N",
		// 		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		// 		"PAGER_SHOW_ALL" => "N",
		// 		"PAGER_SHOW_ALWAYS" => "N",
		// 		"PAGER_TEMPLATE" => ".default",
		// 		"PAGER_TITLE" => "Новости",
		// 		"PARENT_SECTION" => "",
		// 		"PARENT_SECTION_CODE" => "",
		// 		"PREVIEW_TRUNCATE_LEN" => "",
		// 		"PROPERTY_CODE" => array(
		// 			0 => "RATING",
		// 			1 => "USER",
		// 			2 => "",
		// 		),
		// 		"SET_BROWSER_TITLE" => "N",
		// 		"SET_LAST_MODIFIED" => "N",
		// 		"SET_META_DESCRIPTION" => "N",
		// 		"SET_META_KEYWORDS" => "N",
		// 		"SET_STATUS_404" => "N",
		// 		"SET_TITLE" => "N",
		// 		"SHOW_404" => "N",
		// 		"SORT_BY1" => "SORT",
		// 		"SORT_BY2" => "ID",
		// 		"SORT_ORDER1" => "ASC",
		// 		"SORT_ORDER2" => "DESC",
		// 		"STRICT_SECTION_CHECK" => "N",
		// 		"COMPONENT_TEMPLATE" => "popular_reviews",
		// 		"TITLE_BLOCK" => "Your feedback",
		// 		"dop_css_class" => "index__reviews--about"
		// 	),
		// 	false
		// );



		// $APPLICATION->IncludeComponent(
		// 	"bitrix:news.list",
		// 	"our-employees",
		// 	array(
		// 		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
		// 		"ADD_SECTIONS_CHAIN" => "N",	// Add Section name to breadcrumb navigation
		// 		"AJAX_MODE" => "N",	// Enable AJAX mode
		// 		"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
		// 		"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
		// 		"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
		// 		"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
		// 		"CACHE_FILTER" => "N",	// Cache if the filter is active
		// 		"CACHE_GROUPS" => "Y",	// Respect Access Permissions
		// 		"CACHE_TIME" => "36000000",	// Cache time (sec.)
		// 		"CACHE_TYPE" => "A",	// Cache type
		// 		"CHECK_DATES" => "Y",	// Show only currently active elements
		// 		"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
		// 		"DISPLAY_BOTTOM_PAGER" => "N",	// Display at the bottom of the list
		// 		"DISPLAY_DATE" => "N",	// Display element date
		// 		"DISPLAY_NAME" => "N",	// Display element title
		// 		"DISPLAY_PICTURE" => "Y",	// Display element preview picture
		// 		"DISPLAY_PREVIEW_TEXT" => "N",	// Display element preview text
		// 		"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
		// 		"FIELD_CODE" => array(	// Fields
		// 			0 => "NAME",
		// 			1 => "",
		// 		),
		// 		"FILTER_NAME" => "",	// Filter
		// 		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
		// 		"IBLOCK_ID" => "13",	// Information block code
		// 		"IBLOCK_TYPE" => "information_for_pages",	// Type of information block (used for verification only)
		// 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Include information block into navigation chain
		// 		"INCLUDE_SUBSECTIONS" => "N",	// Show elements from subsections
		// 		"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
		// 		"NEWS_COUNT" => "12",	// News per page
		// 		"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
		// 		"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
		// 		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
		// 		"PAGER_SHOW_ALL" => "N",	// Show the ALL link
		// 		"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
		// 		"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
		// 		"PAGER_TITLE" => "Новости",	// Category name
		// 		"PARENT_SECTION" => "",	// Section ID
		// 		"PARENT_SECTION_CODE" => "",	// Section code
		// 		"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
		// 		"PROPERTY_CODE" => array(	// Properties
		// 			0 => "EMAIL",
		// 			1 => "FACEBOOK",
		// 			2 => "INSTAGRAM",
		// 			3 => "VK",
		// 			4 => "POST",
		// 			5 => "PHONE",
		// 			6 => "",
		// 		),
		// 		"SET_BROWSER_TITLE" => "N",	// Set browser window title
		// 		"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
		// 		"SET_META_DESCRIPTION" => "N",	// Set page description
		// 		"SET_META_KEYWORDS" => "N",	// Set page keywords
		// 		"SET_STATUS_404" => "N",	// Set status 404
		// 		"SET_TITLE" => "N",	// Set page title
		// 		"SHOW_404" => "N",	// Show page
		// 		"SORT_BY1" => "SORT",	// Field for the news first sorting pass
		// 		"SORT_BY2" => "ID",	// Field for the news second sorting pass
		// 		"SORT_ORDER1" => "ASC",	// Direction for the news first sorting pass
		// 		"SORT_ORDER2" => "DESC",	// Direction for the news second sorting pass
		// 		"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
		// 		"COMPONENT_TEMPLATE" => ".default"
		// 	),
		// 	false
		// );
		?>

		<section class="index__contacts b-contacts">
			<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
				<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--pink b-contacts__particle b-contacts__particle--pink"></span>
				</li>
				<li class="parallax-layer" data-depth="-0.3"><span class="parallax-particle parallax-particle--steelblue b-contacts__particle b-contacts__particle--steelblue"></span>
				</li>
			</ul>
			<?
$APPLICATION->IncludeComponent(
				"bulldog:content.blocks",
				"company_details",
				array(
					"CACHE_TIME" => "3000",
					"CACHE_TYPE" => "A",
					"IBLOCK_ID" => "3",
					"ID_ELEM" => "107",
					"var1" => "",
					"var2" => "",
					"var3" => "",
					"COMPONENT_TEMPLATE" => "company_details"
				),
				false
);
			?>

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
		</section>

	</div>

</div>
<div style="margin-top:200px;">
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