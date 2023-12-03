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

?>

<div class="js-review-list reviews__list">

	<? foreach ($arResult["ITEMS"] as $arItem) : ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="reviews__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="b-review-card">
				<div class="b-review-card__top">
					<div class="b-review-card__author">
						<div class="responsive-img b-review-card__photo">
							<img src="<?= $arItem["USER"]["PERSONAL_PHOTO"] ?>" alt="<?= $arItem["USER"]["NAME"] ?>" data-object-fit="cover">
						</div>
						<div><span class="b-review-card__name"><?= $arItem["USER"]["NAME"] ?></span><span class="b-review-card__position"><?= $arItem["USER"]["GROUP"]["NAME"] ?></span>
						</div>
					</div>
					<div class="b-review-card__appraisal">
						<? for ($i = 1; $i <= 5; $i++) : ?>
							<span class="star <?= ($arItem["PROPERTIES"]["RATING"]["VALUE"] >= $i ? "star--yellow" : "") ?>"><i class="fas fa-star"></i></span>
						<? endfor ?>
						<? $num = number_format($arItem["PROPERTIES"]["RATING"]["VALUE"], 1) ?>
						<span class="b-review-card__value"><?= $num ?></span>
					</div>
					<time class="b-review-card__date" datetime="2020-05-11"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></time>
				</div>
				<div class="b-review-card__content">
					<div class="h3 b-review-card__title"><?= $arItem["NAME"] ?></div>
					<div class="content-style b-review-card__text">
						<? echo $arItem["PREVIEW_TEXT"]; ?>
					</div>
					<? if ($arItem["PROPERTIES"]["PHOTO"]["SRC"]) : ?>
						<div class="js-gallery b-review-card__gallery">
							<div class="b-review-card__gallery-wrapper">
								<? 
								$i=1;
								foreach ($arItem["PROPERTIES"]["PHOTO"]["SRC"] as $key => $img) : ?>
									<a class="responsive-img b-review-card__gallery-item" href="<?= $arItem["PROPERTIES"]["PHOTO"]["PATH"][$key] ?>" data-type="image">
										<img src="<?= $img ?>" alt data-object-fit="cover"><span class="icon icon--small icon--eye b-review-card__icon" aria-hidden="true"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-eye" />
											</svg></span>
									</a>
								<?
								if($i>=5)break; $i++;
								endforeach 
								?>
							</div>
						</div>
					<? endif ?>
				</div>
			</div>
		</div>
	<? endforeach ?>

</div>


<?= $arResult["NAV_STRING"] ?>