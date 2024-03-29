<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="inner-page articles">
	<div class="wrap wrap--limited wrap--relative">
		<ul class="parallax-scene js-scene" data-relative-input="true">
			<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--light-green articles__particle articles__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--steelblue articles__particle articles__particle--steelblue"></span>
			</li>
			<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--pink articles__particle articles__particle--pink"></span>
			</li>
			<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--yellow articles__particle articles__particle--yellow"></span>
			</li>
		</ul>

		<span class="decor articles__heart" aria-hidden="true">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-heart" />
			</svg>
		</span>

		<div class="articles__top">
			<h1 class="articles__title"><?= $APPLICATION->ShowTitle() ?></h1>

			<? $APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"action_filter",
				array(
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					// "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
					// "CACHE_GROUPS" => "Y",	// Учитывать права доступа
					// "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					// "CACHE_TYPE" => "N",	// Тип кеширования

					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

					"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
					"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
					"FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
					"IBLOCK_ID" => "5",	// Инфоблок
					"IBLOCK_TYPE" => "articles",	// Тип инфоблока
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],	// Код раздела
					"SECTION_FIELDS" => array(	// Поля разделов
						0 => "NAME",
						1 => "",
					),
					"SECTION_ID" => "", //$_REQUEST["SECTION_ID"],	// ID раздела
					"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"], // URL, ведущий на страницу с содержимым раздела
					"SECTION_USER_FIELDS" => array(	// Свойства разделов
						0 => "",
						1 => "",
					),
					"SHOW_PARENT_NAME" => "N",	// Показывать название раздела
					"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
					"VIEW_MODE" => "LINE",	// Вид списка подразделов
					"GET"=>$_GET["SECTION_ID"],
				),
				$component
			); ?>

		</div>


		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NEWS_COUNT" => $arParams["NEWS_COUNT"],
				"SORT_BY1" => $arParams["SORT_BY1"],
				"SORT_ORDER1" => $arParams["SORT_ORDER1"],
				"SORT_BY2" => $arParams["SORT_BY2"],
				"SORT_ORDER2" => $arParams["SORT_ORDER2"],
				"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES" => $arParams["CHECK_DATES"],
				"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

				"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
			),
			$component
		); ?>
		

	</div>
</div>
