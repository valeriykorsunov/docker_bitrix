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

<? if ($arResult) : ?>
<div class="index__features">
	<section class="b-features"><span class="decor b-features__decor b-features__decor--bg"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1680.256 483.382" preserveaspectratio="none">
				<path id="Path_7412" data-name="Path 7412" d="M3444.633,1884.874s126.471-115.129,354.135-107.6,270.917,151.255,464.351,140.911,354.467-89.023,581.148,41.846,221.667,339.9,81.573,291.036-289.715-259.585-662.721-55.367-591.723-155.109-818.485,0S3444.633,1884.874,3444.633,1884.874Z" transform="translate(-3343.849 -1776.921)" fill="#f5f6f7" />
			</svg></span>
		<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
			<li class="parallax-layer" data-depth="0.1"><span class="parallax-particle parallax-particle--yellow b-features__particle b-features__particle--yellow"></span>
			</li>
			<li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--steelblue b-features__particle b-features__particle--steelblue"></span>
			</li>
		</ul>
		<h2 class="h1 b-features__title"><?= $arResult["fields"]["NAME"] ?></h2>
		<ul class="b-features__list">
			<li class="b-features__item">
				<span class="b-features__icon b-features__icon--loupe"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-feature-loupe" />
					</svg></span><span class="h6 b-features__name"><?= $arResult["props"]["TEXT_1"]["VALUE"] ?></span>
				<div class="js-dot b-features__text">
					<p><?= $arResult["fields"]["PREVIEW_TEXT"] ?></p>
				</div>
			</li>
			<li class="b-features__item b-features__item--leaves"><span class="b-features__icon b-features__icon--contract"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-feature-contract" />
					</svg></span><span class="h6 b-features__name"><?= $arResult["props"]["TEXT_2"]["VALUE"] ?></span>
				<div class="js-dot b-features__text">
					<p><?= $arResult["fields"]["DETAIL_TEXT"] ?></p>
				</div>
			</li>
			<li class="b-features__item"><span class="b-features__icon b-features__icon--service"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-feature-service" />
					</svg></span><span class="h6 b-features__name"><?= $arResult["props"]["TEXT_3"]["VALUE"] ?></span>
				<div class="js-dot b-features__text">
					<p><?= $arResult["props"]["ADDITIONAL_HTML"]["VALUE"]["TEXT"] ?></p>
				</div>
			</li>
		</ul><span class="decor b-features__decor b-features__decor--track-1" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-track-gray" />
			</svg></span><span class="decor b-features__decor b-features__decor--track-2" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-track-gray" />
			</svg></span><span class="decor b-features__decor b-features__decor--track-3" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-track-white" />
			</svg></span>
	</section>
</div>
<? endif ?>