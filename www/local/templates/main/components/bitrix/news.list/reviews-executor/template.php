<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Diag\Debug;
use Account\AccountAccess;

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
<div class="profile__item" id="personal-reviews" ">
	<div class="b-profile-reviews">
		<div class="b-profile-reviews__top">
			<div class="h3 b-profile-reviews__title">Reviews</div>

			<?if(AccountAccess::$typeUser == "CUSTOMER"):?>
				<div class="profile__bottom" style="width:250px;">
					<a class="btn btn--yellow js-ajax-modal" href="/local/components/bulldog/feedback_executor_reviews/ajax.php?execid=<?= $arResult["ID_EXECUTOR"]?>">Оставить отзыв</a></div>
			<?elseif(AccountAccess::$typeUser != "EXECUTOR"):?>
				<div class="profile__bottom" style="width:250px;">
					<a class="btn btn--yellow js-ajax-modal" href="/login/">Leave a review</a>
				</div>
			<?endif?>

			<div class="b-profile-reviews__wrapper">
				<div class="b-profile-reviews__appraisal">
				<? for ($i = 1; $i <= 5; $i++) : ?>
					<span class="star <?= ($arResult["STARS"]["AVERAGE"] >= $i ? "star--yellow" : "") ?>"><i class="fas fa-star"></i></span>
				<? endfor ?>
				</div>
				<span class="b-profile-reviews__quantity"><?= $arResult["STARS"]["VOTE"]?> <?=($arResult["STARS"]["VOTE"]>1 ? "reviews" : "review")?></span>
			</div>

		</div>
		<ul class="b-profile-reviews__list">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<li class="b-profile-reviews__item">
					<div class="b-review-card b-review-card--profile">
						<div class="b-review-card__top">
							<div class="b-review-card__author">
								<div class="responsive-img b-review-card__photo">
									<img src="<?= $arItem["USER"]["PERSONAL_PHOTO"]?>" alt data-object-fit="cover">
								</div>
								<div><span class="b-review-card__name"><?= $arItem["USER"]["NAME"] ?></span><span class="b-review-card__position">Customer</span>
								</div>
							</div>
							<div class="b-review-card__appraisal">
								<? for ($i = 1; $i <= 5; $i++) : ?>
									<span class="star <?= ($arItem["PROPERTIES"]["RATING"]["VALUE"] >= $i ? "star--yellow" : "") ?>"><i class="fas fa-star"></i></span>
								<? endfor ?>
								<? $num = number_format($arItem["PROPERTIES"]["RATING"]["VALUE"], 1) ?>
								<span class="b-review-card__value"><?= $num ?></span>
							</div>
							<time class="b-review-card__date" datetime="2020-05-11"><?= FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"])); ?></time>
						</div>

						<div class="b-review-card__content">
							<div class="h3 b-review-card__title"><?= $arItem["NAME"] ?></div>
							<div class="content-style b-review-card__text">
								<p><?= $arItem["PREVIEW_TEXT"] ?></p>
							</div>
						</div>
					</div>
				</li>
			<? endforeach ?>
		</ul>

		<?= $arResult["NAV_STRING"] ?>

		
	</div>
</div>
