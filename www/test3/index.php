<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent("bitrix:news", "services", Array(
	"ADD_ELEMENT_CHAIN" => "N",	// Add element name to breadcrumbs
		"ADD_SECTIONS_CHAIN" => "Y",	// Add Section name to breadcrumb navigation
		"AJAX_MODE" => "N",	// Enable AJAX mode
		"AJAX_OPTION_ADDITIONAL" => "",	// Additional ID
		"AJAX_OPTION_HISTORY" => "N",	// Emulate browser navigation
		"AJAX_OPTION_JUMP" => "N",	// Enable scrolling to component's top
		"AJAX_OPTION_STYLE" => "Y",	// Enable styles loading
		"BROWSER_TITLE" => "-",	// Set browser window title from property value
		"CACHE_FILTER" => "N",	// Cache if the filter is active
		"CACHE_GROUPS" => "Y",	// Respect Access Permissions
		"CACHE_TIME" => "36000000",	// Cache time (sec.)
		"CACHE_TYPE" => "A",	// Cache type
		"CHECK_DATES" => "N",	// Show only currently active elements
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Display at the bottom of the list
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
		"DETAIL_FIELD_CODE" => array(	// Fields
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",	// Show the ALL link
		"DETAIL_PAGER_TEMPLATE" => "",	// Name of the pager template
		"DETAIL_PAGER_TITLE" => "Страница",	// Category name
		"DETAIL_PROPERTY_CODE" => array(	// Properties
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",	// Set canonical URL
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Display at the bottom of the list
		"DISPLAY_DATE" => "Y",	// Display element date
		"DISPLAY_NAME" => "Y",	// Display element title
		"DISPLAY_PICTURE" => "Y",	// Display element preview picture
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Display element preview text
		"DISPLAY_TOP_PAGER" => "N",	// Display at the top of the list
		"FILE_404" => "",	// Show this page (/404.php by default)
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Hide link to the details page if no detailed description provided
		"IBLOCK_ID" => "28",	// Information block
		"IBLOCK_TYPE" => "Services",	// Type of information block
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Include information block into navigation chain
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Date display format
		"LIST_FIELD_CODE" => array(	// Fields
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Properties
			0 => "",
			1 => "",
		),
		"LIST_USE_SHARE" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",	// Set page description from property
		"META_KEYWORDS" => "-",	// Set page keywords from property
		"NEWS_COUNT" => "20",	// News per page
		"PAGER_BASE_LINK_ENABLE" => "N",	// Enable link processing
		"PAGER_DESC_NUMBERING" => "N",	// Use reverse page navigation
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Cache time for pages with reverse page navigation
		"PAGER_SHOW_ALL" => "N",	// Show the ALL link
		"PAGER_SHOW_ALWAYS" => "N",	// Always show the pager
		"PAGER_TEMPLATE" => ".default",	// Breadcrumb navigation template
		"PAGER_TITLE" => "Новости",	// Category name
		"PREVIEW_TRUNCATE_LEN" => "",	// Maximum preview text length (for Text type only)
		"SEF_FOLDER" => "/test3/",	// Folder for SEF (site-root-relative)
		"SEF_MODE" => "Y",	// Enable SEF (Search Engine Friendly Urls) support
		"SEF_URL_TEMPLATES" => array(
			"detail" => "#ELEMENT_CODE#/",
			"news" => "",
			"section" => "",
		),
		"SET_LAST_MODIFIED" => "N",	// Set page last modified date to response header
		"SET_STATUS_404" => "Y",	// Set status 404
		"SET_TITLE" => "Y",	// Set page title
		"SHOW_404" => "Y",	// Show page
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "SORT",	// Field for the news first sorting pass
		"SORT_BY2" => "SORT",	// Field for the news second sorting pass
		"SORT_ORDER1" => "ASC",	// Direction for the news first sorting pass
		"SORT_ORDER2" => "ASC",	// Direction for the news second sorting pass
		"STRICT_SECTION_CHECK" => "N",	// Use strict section check
		"TEMPLATE_THEME" => "blue",
		"USE_CATEGORIES" => "N",	// Show Related Information
		"USE_FILTER" => "N",	// Show filter
		"USE_PERMISSIONS" => "N",	// Use additional access restriction
		"USE_RATING" => "N",	// Enable Rating
		"USE_REVIEW" => "N",	// Allow Writing Reviews
		"USE_RSS" => "N",	// Allow RSS Export
		"USE_SEARCH" => "N",	// Enable Search
		"USE_SHARE" => "N",	// Show Social Network Bookmarks Bar
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>