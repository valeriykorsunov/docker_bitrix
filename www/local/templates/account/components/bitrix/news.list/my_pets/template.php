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

<div class="personal-area__left">
	<h1 class="h5 personal-area__title">My pets</h1>
	<div class="js-scroll-block personal-area__scroll-block">
		<div class="personal-area__list">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="js-pet-card b-personal-pet-card" data-cadr-idpet="<?= $arItem["ID"]?>">
					<div class="responsive-img b-personal-pet-card__photo">
						<img data-pet-photo src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt data-object-fit="cover">
					</div>
					<div class="b-personal-pet-card__content">
						<div class="b-personal-pet-card__top">
							<span class="h6 b-personal-pet-card__name" data-pet-name><?=$arItem["NAME"]?></span>
							<div class="b-personal-pet-card__actions">
								<button class="btn btn--yellow btn--small js-pet-card-toggle b-personal-pet-card__toggle-button" data-active-content="Roll up" data-inactive-content="Подробнее">More detailed</button>

								<div class="js-click-edit-pet" data-idpet="<?= $arItem["ID"]?>">
									<button class="btn btn--dimmed btn--circle-small">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-ic-edit" />
										</svg>
									</button>
								</div>
								<!-- галочка -->
								<!-- <button class="btn btn--dimmed btn--circle-small">
									<svg role="img" width="1em" height="1em">
										<use xlink:href="#si-ic-test" />
									</svg>
								</button> -->
								<div class="js-delete b-personal-pet-card__delete b-delete">
									<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-ic-trash" />
										</svg>
									</button>
									<div class="dropdown js-delete-dropdown b-delete__dropdown">
										<div class="b-delete__header">Delete a pet?</div>
										<div class="b-delete__actions">
											<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-pet-card" data-url="?id=<?=$arItem["ID"]?>&delete=y">Yes</button>
											<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">No</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="b-personal-pet-card__description">
							<div class="b-personal-pet-card__description-line">
								<? if(\Pet::getNameTypePet($arItem["PROPERTIES"]["TYPE_PET"]["VALUE"])["UF_NAME"]): ?>
								<div class="b-personal-pet-card__description-item b-personal-pet-card__description-item--30">
									<span class="b-personal-pet-card__description-type">Type of pet:</span>
										<span class="b-personal-pet-card__description-value" data-pet-type><?= \Pet::getNameTypePet($arItem["PROPERTIES"]["TYPE_PET"]["VALUE"])["UF_NAME"] ?></span>
								</div>
								<? endif; ?>

								<div class="b-personal-pet-card__description-item b-personal-pet-card__description-item--70">
									<span class="b-personal-pet-card__description-type">The breed of the pet:</span>
										<span class="b-personal-pet-card__description-value" data-pet-breed><?=$arItem["PROPERTIES"]["PET_BREED"]["VALUE"]?></span>
								</div>
							</div>
						</div>
						<div class="js-pet-card-hide b-personal-pet-card__hide-block">
							<div class="b-personal-pet-card__description">
								<div class="b-personal-pet-card__description-line">
									<div class="b-personal-pet-card__description-item b-personal-pet-card__description-item--30">
										<span class="b-personal-pet-card__description-type">Size:</span>
										<span class="b-personal-pet-card__description-value" data-pet-size><?=$arItem["PROPERTIES"]["SIZE"]["VALUE"]?></span>
									</div>
									<div class="b-personal-pet-card__description-item b-personal-pet-card__description-item--30">
										<span class="b-personal-pet-card__description-type">gender:</span><span class="b-personal-pet-card__description-value" data-pet-gender><?=$arItem["PROPERTIES"]["GENDER"]["VALUE"]?></span>
									</div>
									<div class="b-personal-pet-card__description-item b-personal-pet-card__description-item--30">
										<span class="b-personal-pet-card__description-type">Age:</span>
										<span class="b-personal-pet-card__description-value"><?=$arItem["PROPERTIES"]["AGE"]["VALUE"]?></span>
									</div>
								</div>
								<div class="b-personal-pet-card__description-item"><span class="b-personal-pet-card__description-type">Animals that can be with him:</span>
										<span class="b-personal-pet-card__description-value" data-pet-animals-neardy><?=$arItem["PROPERTIES"]["ANIMALS_NEARDY"]["VALUE"]?></span>
								</div>
								<div class="b-personal-pet-card__description-item"><span class="b-personal-pet-card__description-type">Features of the pet:</span>
								<span class="b-personal-pet-card__description-value" data-pet-features><?=$arItem["PROPERTIES"]["PET_FEATURES"]["VALUE"]?></span>
								</div>
							</div>
							<div class="b-personal-pet-card__specials">
								<div class="b-personal-pet-card__special">
									<label class="ui-checkbox">
										<input disabled data-pet-spay-neut class="visuallyhidden ui-checkbox__input" type="checkbox" readonly="readonly" <? if($arItem["PROPERTIES"]["SPAY_NEUT"]["VALUE"] == "Yes") echo 'checked="checked"';?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i><span class="ui-checkbox__text">Sterilized / neutered</span>
									</label>
								</div>
								<div class="b-personal-pet-card__special">
									<label class="ui-checkbox">
										<input disabled data-pet-stay-home-alone class="visuallyhidden ui-checkbox__input" type="checkbox" readonly="readonly" <? if($arItem["PROPERTIES"]["STAY_HOME_ALONE"]["VALUE"] == "Yes") echo 'checked="checked"';?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i><span class="ui-checkbox__text">Does the pet stay alone at home</span>
									</label>
								</div>
								<div class="b-personal-pet-card__special">
									<label class="ui-checkbox">
										<input disabled data-pet-friend-animals class="visuallyhidden ui-checkbox__input" type="checkbox" readonly="readonly" <? if($arItem["PROPERTIES"]["FREND_ANIMALS"]["VALUE"] == "Yes") echo 'checked="checked"';?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i><span class="ui-checkbox__text">Friendly to other animals</span>
									</label>
								</div>
								<div class="b-personal-pet-card__special">
									<label class="ui-checkbox">
										<input disabled data-pet-vaccinated class="visuallyhidden ui-checkbox__input" type="checkbox" readonly="readonly" <? if($arItem["PROPERTIES"]["VACCINATED"]["VALUE"] == "Yes") echo 'checked="checked"';?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i><span class="ui-checkbox__text">Has the necessary vaccinations</span>
									</label>
								</div>
								<div class="b-personal-pet-card__special">
									<label class="ui-checkbox">
										<input disabled data-pet-friend-children_10 class="visuallyhidden ui-checkbox__input" type="checkbox" readonly="readonly" <? if($arItem["PROPERTIES"]["FRIEND_CHILDREN_10"]["VALUE"] == "Yes") echo 'checked="checked"';?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i><span class="ui-checkbox__text">Friendly to children under 10 years old</span>
									</label>
								</div>
							</div>
							<!-- <div class="b-personal-pet-card__description" style="text-align: right;     margin-top: 20px;">
									<button class="btn btn--yellow btn--small b-personal-pet-card__edit_button js-click-edit-pet" >Edit</button>
							</div> -->
						</div>
					</div>
				</div>
			<? endforeach; ?>
		</div>
	</div>
</div>
