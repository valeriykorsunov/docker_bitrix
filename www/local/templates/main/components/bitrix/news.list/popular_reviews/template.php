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

<? if ($arResult["ITEMS"]) : ?>
	<div class="reviews__slider <?= $arParams["dop_css_class"] ?>">
		<section class="b-reviews">
			<h2 class="h1 b-reviews__title"><?= $arParams["TITLE_BLOCK"] ?></h2>
			<div class="b-reviews__photo-slider">
				<div class="swiper-container js-thumb-reviews-slider">
					<div class="swiper-wrapper">

						<? foreach ($arResult["ITEMS"] as $arItem) : ?>
							<div class="swiper-slide">
								<div class="responsive-img b-reviews__image">
									<img src="<?= $arItem["USER"]["PERSONAL_PHOTO"] ?>" alt="<? echo $arItem["USER"]["NAME"] ?>" data-object-fit="cover">
								</div>
							</div>
						<? endforeach ?>

					</div>
				</div>

				<span class="decor b-reviews__decor b-reviews__decor--hello" aria-hidden="true">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-decor-hello" />
					</svg>
				</span>
			</div>
			<div class="swiper-container js-reviews-slider b-reviews__slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem) : ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide b-reviews__slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="b-reviews__text">
								<p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
							</div>
							<div class="h6 b-reviews__author-info">
								<span><?= $arItem["USER"]["NAME"] ?></span>
								<span><?= $arItem["USER"]["PERSONAL_CITY"] ?></span>
								<span class="decor b-reviews__decor b-reviews__decor--quote" aria-hidden="true">
									<svg role="img" width="1em" height="1em">
										<use xlink:href="#si-left-quote" />
									</svg>
								</span>
							</div>
						</div>
					<? endforeach ?>
				</div>
			</div>
			<div class="b-reviews__actions b-slider-actions">
				<button class="btn btn--slider js-reviews-prev-button b-slider-actions__prev-button" aria-label="Previous slide">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-prev-arrow" />
					</svg>
				</button>
				<div class="js-reviews-pagination b-slider-actions__pagination"></div>
				<button class="btn btn--slider js-reviews-next-button b-slider-actions__prev-button" aria-label="Next slide">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-next-arrow" />
					</svg>
				</button>
			</div>
			<span class="decor b-reviews__decor b-reviews__decor--heart" aria-hidden="true">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-heart" />
				</svg>
			</span>
		</section>
	</div>
<? endif ?>