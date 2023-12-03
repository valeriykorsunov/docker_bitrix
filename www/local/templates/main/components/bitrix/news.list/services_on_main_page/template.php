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
//Debug::dump($arResult["ITEMS"]["DETAIL_PAGE_URL"]);
?>

<h2 class="h1 b-advantages__title">Services</h2>
<div class="articles__grid services_row_space">


	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="articles__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<article class="b-article">
				<a class="b-article__link service_pictures" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="responsive-img b-article__image pictures_services_main">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt data-object-fit="cover">
						<!--<span class="tag tag--<?= $arItem["IBLOCK_SECTION_COLOR"]["XML_ID"] ?> b-article__tag"><?= $arItem["IBLOCK_SECTION_NAME"] ?></span>-->
					</div>
					<span class="icon icon--eye b-article__eye" aria-hidden="true">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-eye" />
						</svg>
					</span>
					<h3 class="b-article__title"><?= $arItem["NAME"] ?></h3>
					<div class="js-dot b-article__text">
						<p><?= $arItem["PROPERTIES"]["ANNOUNCEMENT"]["VALUE"] ?></p>
					</div>
				</a>
			</article>
		</div>
	<? endforeach ?>
</div>

<?= $arResult["NAV_STRING"] ?>
