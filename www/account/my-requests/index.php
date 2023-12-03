<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("My requests");

global $USER, $DB;
global $arFilter;
$arFilter["PROPERTY_EXECUTOR_ID"] = $USER->GetID();
$arFilter["ACTIVE"] = "Y";
//$arFilter["ACTIVE_DATE"] = "Y";
$arFilter["!PROPERTY_CURRENT_STATE"] = [44, 47];

global $arFilterHist;
$arFilterHist["PROPERTY_EXECUTOR_ID"] = $USER->GetID();
$arFilterHist["PROPERTY_CURRENT_STATE"] = 44;
// $arFilterHist["!ACTIVE_DATE"] = "Y";

global $arFilterWeekend;
$arFilterWeekend["PROPERTY_EXECUTOR_ID"] = $USER->GetID();
$arFilterWeekend["ACTIVE"] = "Y";
//$arFilterWeekend["ACTIVE_DATE"] = "Y";
$arFilterWeekend["PROPERTY_CURRENT_STATE"] = 47;
$arFilterWeekend[">=DATE_ACTIVE_FROM"] = date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")));
?>
<div id="js-applications-page"></div>

<div class="personal-area__content">
	<div class="personal-area__grid">

		<div class="js-tabs b-tabs b-tabs--personal" data-hash>
			<ul class="b-tabs__navigation">
				<li class="b-tabs__navigation-item">
					<a class="b-tabs__navigation-link" href="#personal-tab1">Upcoming or current services</a>
				</li>
				<li class="b-tabs__navigation-item">
					<a class="b-tabs__navigation-link" href="#personal-tab2">My history</a>
				</li>
				<li class="b-tabs__navigation-item">
					<a class="b-tabs__navigation-link" href="#personal-tab3">Days off</a>
				</li>
			</ul>
			<div class="b-tabs__progress-line">
				<span class="js-tabs-thumb b-tabs__thumb"></span>
			</div>

			<div class="js-tabs-content b-tabs__content" id="personal-tab1">
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"applications",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
					"ADD_SECTIONS_CHAIN" => "N",	// Add Section name to breadcrumb navigation
					"AJAX_MODE" => "N",	// Enable AJAX mode
					"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
					"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
					"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
					"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
					"CACHE_FILTER" => "N",	// Cache if the filter is active
					"CACHE_GROUPS" => "Y",	// Respect Access Permissions
					"CACHE_TIME" => "3600000",	// Cache time (sec.)
					"CACHE_TYPE" => "A",	// Cache type
					"CHECK_DATES" => "N",	// Show only currently active elements
					"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
					"DISPLAY_BOTTOM_PAGER" => "N",	// Display at the bottom of the list
					"DISPLAY_DATE" => "N",	// Display element date
					"DISPLAY_NAME" => "N",	// Display element title
					"DISPLAY_PICTURE" => "Y",	// Display element preview picture
					"DISPLAY_PREVIEW_TEXT" => "N",	// Display element preview text
					"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
					"FIELD_CODE" => array(	// Fields
						0 => "NAME",
						1 => "PREVIEW_TEXT",
						2 => "ACTIVE_FROM",
						3 => "ACTIVE_TO",
					),
					"FILTER_NAME" => "arFilter",	// Filter
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
					"IBLOCK_ID" => "20",	// Information block code
					"IBLOCK_TYPE" => "applications",	// Type of information block (used for verification only)
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Include information block into navigation chain
					"INCLUDE_SUBSECTIONS" => "N",	// Show elements from subsections
					"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
					"NEWS_COUNT" => "100",	// News per page
					"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
					"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
					"PAGER_SHOW_ALL" => "N",	// Show the ALL link
					"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
					"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
					"PAGER_TITLE" => "Новости",	// Category name
					"PARENT_SECTION" => "",	// Section ID
					"PARENT_SECTION_CODE" => "",	// Section code
					"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
					"PROPERTY_CODE" => array(	// Properties
						0 => "CUSTOMER_ID",
						13 => "EXECUTOR_ID",
						2 => 'CURRENT_STATE'
					),
					"SET_BROWSER_TITLE" => "N",	// Set browser window title
					"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
					"SET_META_DESCRIPTION" => "N",	// Set page description
					"SET_META_KEYWORDS" => "N",	// Set page keywords
					"SET_STATUS_404" => "N",	// Set status 404
					"SET_TITLE" => "N",	// Set page title
					"SHOW_404" => "N",	// Show page
					"SORT_BY1" => "SORT",	// Field for the news first sorting pass
					"SORT_BY2" => "TIMESTAMP_X",	// Field for the news second sorting pass
					"SORT_ORDER1" => "ASC",	// Direction for the news first sorting pass
					"SORT_ORDER2" => "DESC",	// Direction for the news second sorting pass
					"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);
			?>
			</div>

			<div class="js-tabs-content b-tabs__content" id="personal-tab2">

			<?
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"applications",
				array(
					"HISTORY" => "Y",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
					"ADD_SECTIONS_CHAIN" => "N",	// Add Section name to breadcrumb navigation
					"AJAX_MODE" => "N",	// Enable AJAX mode
					"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
					"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
					"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
					"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
					"CACHE_FILTER" => "N",	// Cache if the filter is active
					"CACHE_GROUPS" => "Y",	// Respect Access Permissions
					"CACHE_TIME" => "3600000",	// Cache time (sec.)
					"CACHE_TYPE" => "A",	// Cache type
					"CHECK_DATES" => "N",	// Show only currently active elements
					"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
					"DISPLAY_BOTTOM_PAGER" => "N",	// Display at the bottom of the list
					"DISPLAY_DATE" => "N",	// Display element date
					"DISPLAY_NAME" => "N",	// Display element title
					"DISPLAY_PICTURE" => "Y",	// Display element preview picture
					"DISPLAY_PREVIEW_TEXT" => "N",	// Display element preview text
					"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
					"FIELD_CODE" => array(	// Fields
						0 => "NAME",
						1 => "PREVIEW_TEXT",
						2 => "ACTIVE_FROM",
						3 => "ACTIVE_TO",
					),
					"FILTER_NAME" => "arFilterHist",	// Filter
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
					"IBLOCK_ID" => "20",	// Information block code
					"IBLOCK_TYPE" => "applications",	// Type of information block (used for verification only)
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Include information block into navigation chain
					"INCLUDE_SUBSECTIONS" => "N",	// Show elements from subsections
					"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
					"NEWS_COUNT" => "100",	// News per page
					"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
					"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
					"PAGER_SHOW_ALL" => "N",	// Show the ALL link
					"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
					"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
					"PAGER_TITLE" => "Новости",	// Category name
					"PARENT_SECTION" => "",	// Section ID
					"PARENT_SECTION_CODE" => "",	// Section code
					"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
					"PROPERTY_CODE" => array(	// Properties
						0 => "CUSTOMER_ID",
						13 => "EXECUTOR_ID",
					),
					"SET_BROWSER_TITLE" => "N",	// Set browser window title
					"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
					"SET_META_DESCRIPTION" => "N",	// Set page description
					"SET_META_KEYWORDS" => "N",	// Set page keywords
					"SET_STATUS_404" => "N",	// Set status 404
					"SET_TITLE" => "N",	// Set page title
					"SHOW_404" => "N",	// Show page
					"SORT_BY1" => "SORT",	// Field for the news first sorting pass
					"SORT_BY2" => "TIMESTAMP_X",	// Field for the news second sorting pass
					"SORT_ORDER1" => "ASC",	// Direction for the news first sorting pass
					"SORT_ORDER2" => "DESC",	// Direction for the news second sorting pass
					"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);
			?>
			</div>

			<div class="js-tabs-content b-tabs__content" id="personal-tab3">
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"applications",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
					"ADD_SECTIONS_CHAIN" => "N",	// Add Section name to breadcrumb navigation
					"AJAX_MODE" => "N",	// Enable AJAX mode
					"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
					"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
					"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
					"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
					"CACHE_FILTER" => "N",	// Cache if the filter is active
					"CACHE_GROUPS" => "Y",	// Respect Access Permissions
					"CACHE_TIME" => "3600000",	// Cache time (sec.)
					"CACHE_TYPE" => "A",	// Cache type
					"CHECK_DATES" => "N",	// Show only currently active elements
					"DETAIL_URL" => "",	// Detail page URL (from information block settings by default)
					"DISPLAY_BOTTOM_PAGER" => "N",	// Display at the bottom of the list
					"DISPLAY_DATE" => "N",	// Display element date
					"DISPLAY_NAME" => "N",	// Display element title
					"DISPLAY_PICTURE" => "Y",	// Display element preview picture
					"DISPLAY_PREVIEW_TEXT" => "N",	// Display element preview text
					"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
					"FIELD_CODE" => array(	// Fields
						0 => "NAME",
						1 => "PREVIEW_TEXT",
						2 => "ACTIVE_FROM",
						3 => "ACTIVE_TO",
					),
					"FILTER_NAME" => "arFilterWeekend",	// Filter
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
					"IBLOCK_ID" => "20",	// Information block code
					"IBLOCK_TYPE" => "applications",	// Type of information block (used for verification only)
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Include information block into navigation chain
					"INCLUDE_SUBSECTIONS" => "N",	// Show elements from subsections
					"MESSAGE_404" => "",	// Show this message (a component provided message is used by default)
					"NEWS_COUNT" => "100",	// News per page
					"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
					"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
					"PAGER_SHOW_ALL" => "N",	// Show the ALL link
					"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
					"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
					"PAGER_TITLE" => "Новости",	// Category name
					"PARENT_SECTION" => "",	// Section ID
					"PARENT_SECTION_CODE" => "",	// Section code
					"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
					"PROPERTY_CODE" => array(	// Properties
						0 => "CUSTOMER_ID",
						13 => "EXECUTOR_ID",
						2 => 'CURRENT_STATE'
					),
					"SET_BROWSER_TITLE" => "N",	// Set browser window title
					"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
					"SET_META_DESCRIPTION" => "N",	// Set page description
					"SET_META_KEYWORDS" => "N",	// Set page keywords
					"SET_STATUS_404" => "N",	// Set status 404
					"SET_TITLE" => "N",	// Set page title
					"SHOW_404" => "N",	// Show page
					"SORT_BY1" => "SORT",	// Field for the news first sorting pass
					"SORT_BY2" => "ACTIVE_FROM",	// Field for the news second sorting pass
					"SORT_ORDER1" => "ASC",	// Direction for the news first sorting pass
					"SORT_ORDER2" => "ASC",	// Direction for the news second sorting pass
					"STRICT_SECTION_CHECK" => "N",	// Check parent section when showing list
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);
			?>
			</div>
		</div>
		<? $APPLICATION->IncludeComponent("bulldog:chat", "", array()); ?>

	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>