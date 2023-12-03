<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>


<div class="b-profile-info__item b-profile-info__item--column">
	<?if($arResult["IS_ONLINE"] == "Y"):?>
		<span class="b-profile-info__status">online</span>
	<?endif?>
	<div class="b-profile-info__photo b-profile-info__photo--online">
		<span class="decor b-profile-info__hello" aria-hidden="true">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-profile-hello" />
			</svg>
		</span>
		<div class="responsive-img b-profile-info__image">
			<img src="<?= $arResult["PERSONAL_PHOTO"]?>" alt data-object-fit="cover">
		</div>
	</div>
	<span class="b-profile-info__name"><?= $arResult["NAME"]?> <?= $arResult["LAST_NAME"]?></span>
	<div class="b-profile-info__line">
		<span class="b-profile-info__age"><?= $arResult["PERSONAL_AGE"]?></span>
		<span class="b-profile-info__place"><i class="fas fa-map-marker-alt"></i><?= $arResult["PERSONAL_CITY"]?></span>
	</div>
	<div class="b-profile-info__line">
		<div class="b-profile-info__appraisal">
			<? for ($i = 1; $i <= 5; $i++) : ?>
				<span class="star <?= ($arResult["STARS"]["AVERAGE"] >= $i ? "star--yellow" : "") ?>"><i class="fas fa-star"></i></span>
			<? endfor ?>
		</div>
		<a class="js-link-anchor b-profile-info__link" href="#personal-reviews"><?= $arResult["STARS"]["VOTE"]?> <?=($arResult["STARS"]["VOTE"]>1 ? "reviews" : "review")?></a>
	</div>
</div>