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
<?if($arResult):?>
<section class="index__advantages b-advantages">
	<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
		<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--yellow b-advantages__particle b-advantages__particle--yellow"></span>
		</li>
		<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--light-green b-advantages__particle b-advantages__particle--light-green"></span>
		</li>
	</ul>
	<div class="b-advantages__left">
		<h2 class="h1 b-advantages__title"><?=$arResult["fields"]["NAME"]?></h2>
		<div class="js-dot b-advantages__text"><?=$arResult["props"]["TEXT_1"]["VALUE"]?></div>
	</div>
	<div class="b-advantages__right">
		<div class="b-advantages__list">
			<div class="b-advantages__item">
				<?=$arResult["fields"]["PREVIEW_TEXT"]?>
			</div>
			<div class="b-advantages__item">
				<?=$arResult["fields"]["DETAIL_TEXT"]?>
			</div>
		</div><span class="decor b-advantages__decore b-advantages__decore--zig-line" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-zig-line" />
			</svg></span><span class="decor b-advantages__decore b-advantages__decore--cube" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-cube" />
			</svg></span>
	</div>
</section>
<?endif?>