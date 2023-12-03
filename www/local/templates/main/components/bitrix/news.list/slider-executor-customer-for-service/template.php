<?
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
<div class="index__first b-first slider_become_petcare">
	<div class="wrap b-first__wrapper">
		<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
			<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--light-green b-first__particle b-first__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--pink b-first__particle b-first__particle--pink"></span>
			</li>
			<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--steelblue b-first__particle b-first__particle--steelblue"></span>
			</li>
		</ul>

		<div class="b-first__left">
			<span class="decor b-first__zig-line" aria-hidden="true">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-zig-line" />
				</svg>
			</span>

			<div class="swiper-container js-first-slider b-first__slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem) : ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide b-first__slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="h1 b-first__name"><?= $arItem["NAME"] ?></div>
							<div class="b-first__text">
								<p><?= $arItem["PREVIEW_TEXT"] ?></p>
							</div>
							<div class="b-first__links">
								<? foreach ($arItem["PROPERTIES"]["EXECUTOR_CUSTOMER"]["VALUE_XML_ID"] as $key => $value) : ?>
									<?
									if ($value == "executor") $url = $arParams["url_executor"];
									else $url = $arParams["url_customer"];
									?>
									<a class="btn <? if ($value == "executor") echo "btn--yellow"; ?> b-first__link" href="<?= $url ?>">
										<?= $arItem["PROPERTIES"]["EXECUTOR_CUSTOMER"]["VALUE"][$key] ?>
									</a>
								<? endforeach ?>
							</div>
						</div>
					<? endforeach ?>
				</div>
			</div>
			
			<div class="b-first__actions b-slider-actions">
				<button class="btn btn--slider js-first-prev-button b-slider-actions__prev-button" aria-label="<?= GetMessage("prev_button") ?>">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-prev-arrow" />
					</svg>
				</button>
				<div class="js-first-pagination b-slider-actions__pagination"></div>
				<button class="btn btn--slider js-first-next-button b-slider-actions__prev-button" aria-label="<?= GetMessage("next_button") ?>">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-next-arrow" />
					</svg>
				</button>
			</div>
		</div>

		<div class="b-first__right b-first__right--service"><span class="decor b-first__waves" aria-hidden="true"><svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-waves-gray" />
				</svg></span>
			<div class="responsive-img b-first__image">
				<img src="<?= SITE_TEMPLATE_PATH ?>/img/media/index/service.png" alt data-object-fit="contain">
				<span class="b-first__leaves" aria-hidden="true"><img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/service-leaves.svg" alt></span>
			</div>

		</div><span class="b-first__mouse-icon" aria-hidden="true"><img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/mouse.svg" alt></span>
	</div>
</div>