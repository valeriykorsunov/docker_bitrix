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

Debug::dumpToFile($arResult, '***' . date('Y-m-d H:i:s') . '***' . __FILE__);
?>
<div class="index__first b-first">
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
					<? if ($arResult["PROPERTIES"]["SHOW_SLIDE_1"]["VALUE"] == "YES") : ?>
						<div class="swiper-slide b-first__slide">
							<div class="h1 b-first__name"><?= $arResult["PROPERTIES"]["TITLE_SLIDE_1"]["VALUE"] ?></div>
							<div class="b-first__text">
								<p><?= $arResult["PROPERTIES"]["TEXT_SLIDE_1"]["VALUE"] ?></p>
							</div>
							<div class="b-first__links">
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_1_1"]["VALUE"] != "") : ?>
									<a class="btn btn--yellow b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_1_1"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_1_1"]["VALUE"] ?>
									</a>
								<? endif ?>
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_1_2"]["VALUE"] != "") : ?>
									<a class="btn b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_1_2"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_1_2"]["VALUE"] ?>
									</a>
								<? endif ?>
							</div>
						</div>
					<? endif ?>

					<? if ($arResult["PROPERTIES"]["SHOW_SLIDE_2"]["VALUE"] == "YES") : ?>
						<div class="swiper-slide b-first__slide">
							<div class="h1 b-first__name"><?= $arResult["PROPERTIES"]["TITLE_SLIDE_2"]["VALUE"] ?></div>
							<div class="b-first__text">
								<p><?= $arResult["PROPERTIES"]["TEXT_SLIDE_2"]["VALUE"] ?></p>
							</div>
							<div class="b-first__links">
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_2_1"]["VALUE"] != "") : ?>
									<a class="btn btn--yellow b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_2_1"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_2_1"]["VALUE"] ?>
									</a>
								<? endif ?>
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_2_2"]["VALUE"] != "") : ?>
									<a class="btn b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_2_2"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_2_2"]["VALUE"] ?>
									</a>
								<? endif ?>
							</div>
						</div>
					<? endif ?>

					<? if ($arResult["PROPERTIES"]["SHOW_SLIDE_3"]["VALUE"] == "YES") : ?>
						<div class="swiper-slide b-first__slide">
							<div class="h1 b-first__name"><?= $arResult["PROPERTIES"]["TITLE_SLIDE_3"]["VALUE"] ?></div>
							<div class="b-first__text">
								<p><?= $arResult["PROPERTIES"]["TEXT_SLIDE_3"]["VALUE"] ?></p>
							</div>
							<div class="b-first__links">
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_3_1"]["VALUE"] != "") : ?>
									<a class="btn btn--yellow b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_3_1"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_3_1"]["VALUE"] ?>
									</a>
								<? endif ?>
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_3_2"]["VALUE"] != "") : ?>
									<a class="btn b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_3_2"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_3_2"]["VALUE"] ?>
									</a>
								<? endif ?>
							</div>
						</div>
					<? endif ?>

					<? if ($arResult["PROPERTIES"]["SHOW_SLIDE_4"]["VALUE"] == "YES") : ?>
						<div class="swiper-slide b-first__slide">
							<div class="h1 b-first__name"><?= $arResult["PROPERTIES"]["TITLE_SLIDE_4"]["VALUE"] ?></div>
							<div class="b-first__text">
								<p><?= $arResult["PROPERTIES"]["TEXT_SLIDE_4"]["VALUE"] ?></p>
							</div>
							<div class="b-first__links">
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_4_1"]["VALUE"] != "") : ?>
									<a class="btn btn--yellow b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_4_1"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_4_1"]["VALUE"] ?>
									</a>
								<? endif ?>
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_4_2"]["VALUE"] != "") : ?>
									<a class="btn b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_4_2"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_4_2"]["VALUE"] ?>
									</a>
								<? endif ?>
							</div>
						</div>
					<? endif ?>

					<? if ($arResult["PROPERTIES"]["SHOW_SLIDE_4"]["VALUE"] == "YES") : ?>
						<div class="swiper-slide b-first__slide">
							<div class="h1 b-first__name"><?= $arResult["PROPERTIES"]["TITLE_SLIDE_5"]["VALUE"] ?></div>
							<div class="b-first__text">
								<p><?= $arResult["PROPERTIES"]["TEXT_SLIDE_5"]["VALUE"] ?></p>
							</div>
							<div class="b-first__links">
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_5_1"]["VALUE"] != "") : ?>
									<a class="btn btn--yellow b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_5_1"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_5_1"]["VALUE"] ?>
									</a>
								<? endif ?>
								<? if ($arResult["PROPERTIES"]["BUTTON_TEXT_5_2"]["VALUE"] != "") : ?>
									<a class="btn b-first__link" href="<?= $arResult["PROPERTIES"]["BUTTON_URL_5_2"]["VALUE"] ?>">
										<?= $arResult["PROPERTIES"]["BUTTON_TEXT_5_2"]["VALUE"] ?>
									</a>
								<? endif ?>
							</div>
						</div>
					<? endif ?>
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

		<div class="b-first__right b-first__right--service">
			<span class="decor b-first__waves" aria-hidden="true">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-waves-gray" />
				</svg>
			</span>
			<div class="responsive-img b-first__image">
				<?if($arResult["PREVIEW_PICTURE"]):?>
					<img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"]?>" alt data-object-fit="contain">
				<?else:?>
				<img src="<?= SITE_TEMPLATE_PATH ?>/img/media/index/service.png" alt data-object-fit="contain">
				<?endif?>
				<span class="b-first__leaves" aria-hidden="true">
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/service-leaves.svg" alt>
				</span>
			</div>
		</div>
		<span class="b-first__mouse-icon" aria-hidden="true">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/mouse.svg" alt>
		</span>
	</div>
</div>

<div class="wrap wrap--limited">
	<!-- start short_instructions -->
	<div class="index__steps b-steps">
		<div class="b-steps__wrapper">
		<!-- SHORT_INSTRUCTIONS_1 -->
			<?if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1"]["VALUE"] != ""):?>
				<div class="b-steps__item">
					<div class="b-steps__text">
						<p><? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1"]["VALUE"]; ?></p>
					</div>
					<div class="b-steps__image">
						<?if($arResult["SHORT_INSTRUCTIONS_1_IMG"]):?>
							<img src="<?= $arResult["SHORT_INSTRUCTIONS_1_IMG"]?>" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1"]["VALUE"] ?>">
						<?else:?>
							<img src="<?=SITE_TEMPLATE_PATH?>/img/media/index/steps/step-1.png" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_1"]["VALUE"] ?>">
						<?endif?>
					</div>
				</div>
			<?endif?> 
		<!-- SHORT_INSTRUCTIONS_2 -->
			<?if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2"]["VALUE"] != ""):?>
				<div class="b-steps__item">
					<div class="b-steps__text">
						<p><? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2"]["VALUE"]; ?></p>
					</div>
					<div class="b-steps__image">
						<?if($arResult["SHORT_INSTRUCTIONS_2_IMG"]):?>
							<img src="<?= $arResult["SHORT_INSTRUCTIONS_2_IMG"]?>" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2"]["VALUE"] ?>">
						<?else:?>
							<img src="<?=SITE_TEMPLATE_PATH?>/img/media/index/steps/step-2.png" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_2"]["VALUE"] ?>">
						<?endif?>
					</div>
				</div>
			<?endif?> 
		<!-- SHORT_INSTRUCTIONS_3 -->
			<?if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3"]["VALUE"] != ""):?>
				<div class="b-steps__item">
					<div class="b-steps__text">
						<p><? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3"]["VALUE"]; ?></p>
					</div>
					<div class="b-steps__image">
						<?if($arResult["SHORT_INSTRUCTIONS_3_IMG"]):?>
							<img src="<?= $arResult["SHORT_INSTRUCTIONS_3_IMG"]?>" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3"]["VALUE"] ?>">
						<?else:?>
							<img src="<?=SITE_TEMPLATE_PATH?>/img/media/index/steps/step-3.png" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_3"]["VALUE"] ?>">
						<?endif?>
					</div>
				</div>
			<?endif?> 
		<!-- SHORT_INSTRUCTIONS_4 -->
			<?if($arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4"]["VALUE"] != ""):?>
				<div class="b-steps__item">
					<div class="b-steps__text">
						<p><? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4"]["VALUE"]; ?></p>
					</div>
					<div class="b-steps__image">
						<?if($arResult["SHORT_INSTRUCTIONS_4_IMG"]):?>
							<img src="<?= $arResult["SHORT_INSTRUCTIONS_4_IMG"]?>" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4"]["VALUE"] ?>">
						<?else:?>
							<img src="<?=SITE_TEMPLATE_PATH?>/img/media/index/steps/step-4.png" alt="<? echo $arResult["PROPERTIES"]["SHORT_INSTRUCTIONS_4"]["VALUE"] ?>">
						<?endif?>
					</div>
				</div>
			<?endif?> 
		</div>
	</div>
	<!-- end short_instructions -->

</div>