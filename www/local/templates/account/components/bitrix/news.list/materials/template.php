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

?>

<div class="personal-area__content">
	<h1 class="h5 personal-area__title"><?= $arParams["TITLE"]?></h1>
	<div class="personal-area__gray-wrapper">
		<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--in-gray">
			<div class="personal-area__materials-grid">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<?Debug::dumpToFile($arItem);?>
				<div class="js-personal-material b-personal-material">
					<div class="h6 b-personal-material__name"><?= $arItem["NAME"] ?></div>
					<div class="js-dot b-personal-material__descrition">
						<p><?= $arItem["PREVIEW_TEXT"] ?></p>
					</div>
					<div class="b-personal-material__bottom">
						<div class="b-personal-material__info"><span class="b-personal-material__type"><?= $arItem["PROPERTIES"]["TYPE"]["VALUE"] ?></span><span class="b-personal-material__size"><?= $arItem["PROPERTIES"]["FILE"]["VALUE_FILE"]["SIZE"] ?></span>
						</div>
						<div class="b-personal-material__actions">
							<a class="btn btn--yellow btn--circle-small b-personal-material__download" href="<?= $arItem["PROPERTIES"]["FILE"]["VALUE_FILE"]["PATH"] ?>" dowwnload="dowwnload" title="Download file">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-ic-download" />
								</svg>
							</a>
						</div>
					</div>
				</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>
</div>