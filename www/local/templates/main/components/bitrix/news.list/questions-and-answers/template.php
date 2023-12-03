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
<div class="faq__left">
	<h1 class="faq__title"><?= $arResult["NAME"] ?></h1>
	<div class="faq__accordion">
		<div class="accordion-container js-accordion b-accordion">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="ac b-accordion__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="ac-q b-accordion__head" tabindex="0">
					<span class="b-accordion__icon">
					<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg>
							</span><?=$arItem["NAME"]?><span class="b-accordion__toggle"></span>
					</div>
					<div class="ac-a b-accordion__content">
						<div class="content-style b-accordion__text">
							<p><?=$arItem["PREVIEW_TEXT"]?></p>
						</div>
					</div>
				</div>
			<? endforeach ?>
		</div>
	</div>
	<a class="btn btn--yellow js-link-anchor faq__button" href="#faq-form">Any other questions?</a>
</div>