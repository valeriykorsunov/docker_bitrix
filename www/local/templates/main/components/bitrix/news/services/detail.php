<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

// $APPLICATION->SetPageProperty("TITLE", "123");

?>
<div class="inner-page article">
	<div class="wrap wrap--limited wrap--relative">
		<ul class="parallax-scene js-scene" data-relative-input="true">
			<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--light-green article__particle article__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--steelblue article__particle article__particle--steelblue"></span>
			</li>
			<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--pink article__particle article__particle--pink"></span>
			</li>
		</ul>

		<div class="article__wrapper">
			<div class="article__left">
				<h1 class="h2 article__title"><?= $APPLICATION->ShowTitle(false) ?></h1>

				<? $ElementID = $APPLICATION->IncludeComponent(
					"bitrix:news.detail",
					"",
					array(
						"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
						"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
						"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
						"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
						"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
						"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
						"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
						"META_KEYWORDS" => $arParams["META_KEYWORDS"],
						"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
						"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
						"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
						"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
						"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
						"SET_TITLE" => $arParams["SET_TITLE"],
						"MESSAGE_404" => $arParams["MESSAGE_404"],
						"SET_STATUS_404" => $arParams["SET_STATUS_404"],
						"SHOW_404" => $arParams["SHOW_404"],
						"FILE_404" => $arParams["FILE_404"],
						"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
						"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
						"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
						"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
						"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
						"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
						"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
						"CHECK_DATES" => $arParams["CHECK_DATES"],
						"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
						"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
						"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
						"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
						"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
						"USE_SHARE" => $arParams["USE_SHARE"],
						"SHARE_HIDE" => $arParams["SHARE_HIDE"],
						"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
						"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
						"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
						"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
						"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
						'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
						"SET_BROWSER_TITLE" => "Y",
					),
					$component
				); 
				
				?>

			</div>

			<!--<div class="article__right">
				<? global $arrFilter; ?>
<? /*$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"top_articles",
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
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "NAME",
							1 => "PREVIEW_PICTURE",
							2 => "SHOW_COUNTER",
							3 => "",
						),
						"FILTER_NAME" => "arrFilter",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "5",
						"IBLOCK_TYPE" => "articles",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "Y",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "4",
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
							1 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "SHOW_COUNTER",
						"SORT_BY2" => "ID",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "top_articles"
					),
					false
); */?>

				<?
				// $APPLICATION->IncludeComponent(
				// 	"bitrix:news.list",
				// 	"instagram_list",
				// 	array(
				// 		"INSTA_URL" => 'https://www.instagram.com/valeriykorsunov/',
				// 		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
				// 		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				// 		"AJAX_MODE" => "N",	// Включить режим AJAX
				// 		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
				// 		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
				// 		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
				// 		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
				// 		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
				// 		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				// 		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
				// 		"CACHE_TYPE" => "A",	// Тип кеширования
				// 		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
				// 		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
				// 		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
				// 		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
				// 		"DISPLAY_NAME" => "Y",	// Выводить название элемента
				// 		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
				// 		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
				// 		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
				// 		"FIELD_CODE" => array(	// Поля
				// 			0 => "",
				// 			1 => "",
				// 		),
				// 		"FILTER_NAME" => "",	// Фильтр
				// 		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
				// 		"IBLOCK_ID" => "6",	// Код информационного блока
				// 		"IBLOCK_TYPE" => "information_for_pages",	// Тип информационного блока (используется только для проверки)
				// 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
				// 		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
				// 		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
				// 		"NEWS_COUNT" => "6",	// Количество новостей на странице
				// 		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
				// 		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
				// 		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
				// 		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
				// 		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
				// 		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
				// 		"PAGER_TITLE" => "Новости",	// Название категорий
				// 		"PARENT_SECTION" => "",	// ID раздела
				// 		"PARENT_SECTION_CODE" => "",	// Код раздела
				// 		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
				// 		"PROPERTY_CODE" => array(	// Свойства
				// 			0 => "",
				// 			1 => "",
				// 		),
				// 		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
				// 		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
				// 		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
				// 		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
				// 		"SET_STATUS_404" => "N",	// Устанавливать статус 404
				// 		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				// 		"SHOW_404" => "N",	// Показ специальной страницы
				// 		"SORT_BY1" => "ID",	// Поле для первой сортировки новостей
				// 		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
				// 		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
				// 		"SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
				// 		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
				// 	),
				// 	false
				// );
				?>


			</div>-->

		</div>

		<div class="article__bottom"><a class="btn btn--yellow article__button" href="<?= $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"] ?>"><?/*= GetMessage("T_NEWS_DETAIL_BACK")*/ ?> All services</a>
		</div>

		<span class="decor article__triangle" aria-hidden="true">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-triangle" />
			</svg>
		</span>
	</div>
</div>
