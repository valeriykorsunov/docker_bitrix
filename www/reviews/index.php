<?
use Bitrix\Main\Diag\Debug;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Reviews");

/** FILTERS */
global $filterPopularReviews;
$filterPopularReviews["!PROPERTY_POPULAR_REVIEWS"] = false;

global $filterReviwes;
$to = date($DB->DateFormatToPHP(FORMAT_DATETIME)); //по текущую дату
if($_GET["time"] == "week")
{
	$from = date($DB->DateFormatToPHP(FORMAT_DATETIME), time() - 86400 * 7); //от минус 7 дней назад 
	$filterReviwes = Array(">=DATE_ACTIVE_FROM" => $from, "<=DATE_ACTIVE_FROM" => $to);
}
if($_GET["time"] == "month")
{
	$from = date($DB->DateFormatToPHP(FORMAT_DATETIME), time() - 86400 * 30); //от минус 30 дней назад 
	$filterReviwes = Array(">=DATE_ACTIVE_FROM" => $from, "<=DATE_ACTIVE_FROM" => $to);
}
if($_GET["stars"])
{
	$filterReviwes["PROPERTY_RATING_VALUE"] = $_GET["stars"];
}


/***********************************************************************************/
echo'
<div class="inner-page reviews">
	<div class="wrap wrap--limited reviews__wrapper"><span class="reviews__bg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1674.08 396.487">

				<path id="Path_7716" data-name="Path 7716" d="M4894.871,1917.611s-191.636-253.551-572.785-85.218-581.254-7.553-807.935,106.012-222.985,294.231-108.323,211.978,286.448-199.683,659.454-22.468,432-318.21,770.292-117.411S4894.871,1917.611,4894.871,1917.611Z" transform="translate(-3328.923 -1774.692)" fill="#f5f6f7" />
			</svg></span>
		<ul class="parallax-scene js-scene" data-relative-input="true">
			<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--light-green reviews__particle reviews__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--steelblue reviews__particle reviews__particle--steelblue"></span>
			</li>
			<li class="parallax-layer" data-depth="0.1"><span class="parallax-particle parallax-particle--yellow reviews__particle reviews__particle--yellow"></span>
			</li>
		</ul>
';

		$APPLICATION->IncludeComponent(
	"bulldog:content.blocks", 
	"reviews", 
	array(
		"COMPONENT_TEMPLATE" => "reviews",
		"IBLOCK_ID" => "10",
		"ID_ELEM" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3000",
		"real_user_reviews" => "100"
	),
	false
);


$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"popular_reviews", 
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
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "filterPopularReviews",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "reviews",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
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
			0 => "RATING",
			1 => "USER",
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
		"COMPONENT_TEMPLATE" => "popular_reviews",
		"TITLE_BLOCK" => "Popular reviews"
	),
	false
);



$APPLICATION->IncludeComponent(
	"bulldog:filter.reviews",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "10",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3000"
	),
	false
);

$APPLICATION->IncludeComponent(
	"bulldog:feedback_reviews", 
	"", 
	array(
		"COMPONENT_TEMPLATE" => "",
		"IBLOCK_ID" => "10",
		"ID_FORM" => "reviews",
		"MESSAGE_ID" => "32"
	),
	false,
	array("HIDE_ICONS" => "Y")
);


$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviews", 
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "={$arParams["LIST_FIELD_CODE"]}",
			2 => "",
		),
		"FILE_404" => "",
		"FILTER_NAME" => "filterReviwes",
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "reviews",
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more_reviews",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "POPULAR_REVIEWS",
			1 => "RATING",
			2 => "USER",
			3 => "",
		),
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"COMPONENT_TEMPLATE" => "reviews"
	),
	$component
);



$APPLICATION->IncludeComponent(
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
);


echo'
	</div>
</div>
';
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>