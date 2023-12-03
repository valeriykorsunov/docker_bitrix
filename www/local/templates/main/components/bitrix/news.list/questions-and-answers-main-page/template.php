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

<?if($arResult["ITEMS"]):?>
<section class="index__faq b-faq">
	<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
		<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--yellow b-faq__particle b-faq__particle--yellow"></span>
		</li>
		<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--steelblue b-faq__particle b-faq__particle--steelblue"></span>
		</li>
	</ul>
	<div class="b-faq__left">
		<h2 class="h1 b-faq__title">Questions and answers</h2>
		<div class="accordion-container js-accordion b-accordion">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="ac b-accordion__item">
					<div class="ac-q b-accordion__head" tabindex="0"><span class="b-accordion__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></span><?= $arItem["NAME"] ?><span class="b-accordion__toggle"></span>
					</div>
					<div class="ac-a b-accordion__content">
						<div class="content-style b-accordion__text">
							<p><?= $arItem["PREVIEW_TEXT"] ?></p>
						</div>
					</div>
				</div>
			<? endforeach ?>
		</div>
	</div>
	<div class="b-faq__right">
		<div class="responsive-img b-faq__image">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/media/index/b-faq.png" alt data-object-fit="contain"><span class="decor b-faq__cube"><svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-cube-2" />
				</svg></span><span class="decor b-faq__question"><svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-question-left" />
				</svg></span>
			<span class="decor b-faq__leaves">
				<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/faq-leaves.svg" alt>
			</span>
		</div>
	</div>
	<span class="decor b-faq__lightning">
		<svg role="img" width="1em" height="1em">
			<use xlink:href="#si-decor-lightning" />
		</svg>
	</span>
</section>
<?endif?>