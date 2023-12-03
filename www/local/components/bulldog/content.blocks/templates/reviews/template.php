<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
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

<h1 class="reviews__title"><?= $APPLICATION->GetTitle() ?></h1>
<div class="reviews__values b-values">
	<div class="b-values__item">
		<div class="b-values__value"><span class="b-values__number"><?=$arParams["real_user_reviews"]?></span><span class="b-values__plus">+</span>
		</div>
		<p class="b-values__text">Real user Reviews</p>
	</div>
	<div class="b-values__item">
		<div class="b-values__value">
		<span class="b-values__number"><?=$arResult["AVERAGE_RATING"]?></span>
		<span class="b-values__stars">
			<?for( $i=1; $i <= round($arResult["AVERAGE_RATING"],0, PHP_ROUND_HALF_DOWN); $i++):?>
				<span class="star star--yellow"><i class="fas fa-star"></i></span>
			<?endfor?>
		</span>
		</div>
		<p class="b-values__text">Average rating of our service</p>
	</div>
</div>