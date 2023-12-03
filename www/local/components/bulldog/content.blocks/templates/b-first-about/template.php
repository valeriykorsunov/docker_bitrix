<?php

use Bitrix\Main\Diag\Debug;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
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
?>

<div class="index__first b-first b-first--about" style="margin-bottom: 0px;">
	<div class="wrap b-first__wrapper">
		<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
			<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--light-green b-first__particle b-first__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--pink b-first__particle b-first__particle--pink"></span>
			</li>
		</ul>
		<div class="b-first__left b-first__left--about">
			<div class="responsive-img b-first__image b-first__image--about">
				<img src="<?=$arResult["src_first_image"]?>" alt data-object-fit="cover">
			</div>
			<span class="decor b-first__hey" aria-hidden="true"><svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-hey" />
				</svg>
			</span>

			<span class="b-first__leaves b-first__leaves--about" aria-hidden="true">
				<img src="<?= SITE_TEMPLATE_PATH?>/img/theme/decor-leaves-about.svg">
			</span>

			<div class="responsive-img b-first__decor-image">
				<img src="<?=$arResult["first_decor_image"]?>" alt data-object-fit="cover">
			</div>
			<div class="responsive-img b-first__decor-image b-first__decor-image--medium">
				<img src="<?=$arResult["decor_image_medium"]?>" alt data-object-fit="cover">
			</div>
			<div class="responsive-img b-first__decor-image b-first__decor-image--large">
				<img src="<?=$arResult["decor_image_large"]?>" alt data-object-fit="cover">
			</div>
		</div>
		<div class="b-first__right b-first__right--about">
			<h1 class="b-first__title"><?= $arResult["fields"]["NAME"]?></h1>
			<div class="content-style b-first__text b-first__text--about">
				<?= $arResult["fields"]["PREVIEW_TEXT"]?>
				<blockquote class="b-blockquote b-blockquote--light">
					<? if($arResult["fields"]["DETAIL_TEXT"]): ?>
					<div class="b-blockquote__content">
						<p>“<?= $arResult["fields"]["DETAIL_TEXT"]?>“</p>
					</div>
					<? endif; ?>
					<footer class="b-blockquote__footer">
						<p><?=$arResult["props"]["TEXT_1"]["VALUE"]?></p>
						<p><?=$arResult["props"]["TEXT_2"]["VALUE"]?></p>
						<p><?=$arResult["props"]["TEXT_3"]["VALUE"]?></p>
						<? if($arResult["props"]["TEXT_4"]["VALUE"]): ?>
							<p><?=$arResult["props"]["TEXT_4"]["VALUE"]?></p>
						<? endif; ?>
						<? if($arResult["props"]["TEXT_5"]["VALUE"]): ?>
							<p><?=$arResult["props"]["TEXT_5"]["VALUE"]?></p>						
						<? endif; ?>
					</footer>
				</blockquote>
			</div>
		</div>
	</div>
</div>