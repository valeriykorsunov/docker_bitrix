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
	<h1 class="h5 personal-area__title">My services</h1>
	<div class="js-scroll-block personal-area__scroll-block">
		<div class="personal-area__list">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<div class="js-personal-service b-personal-service" id="personal-service-<?= $arItem["ID"] ?>">
					<div class="b-personal-service__controls">
						<label class="ui-checkbox ui-checkbox--dimmed">
							<input onchange="changeServiceAvailable(this);" class="visuallyhidden js-personal-provide-toggle ui-checkbox__input" type="checkbox" name="service-1-provide" <? if ($arItem["PROPERTIES"]["SERVICE_AVAILABLE"]["VALUE_XML_ID"] == "yes") : ?>checked="checked" <? endif ?> data-id="<?= $arItem["ID"] ?>" data-url="">
							<i class="ui-checkbox__icon">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-icon-check" />
								</svg>
							</i>
							<span class="ui-checkbox__text"><?= $arItem["PROPERTIES"]["SERVICE_AVAILABLE"]["NAME"] ?></span>
						</label>

						<div class="b-personal-service__actions">
							<a class="btn btn--yellow btn--circle-small js-inline-modal b-personal-service__edit" href="#service-<?= $arItem["ID"] ?>">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-ic-edit" />
								</svg>
							</a>
							<? if ($arItem["PROPERTIES"]["DOGSITTING"]["VALUE"] != "Yes") : ?>
								<div class="js-delete b-personal-service__delete b-delete">
									<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-ic-trash" />
										</svg>
									</button>
									<div class="dropdown js-delete-dropdown b-delete__dropdown">
										<div class="b-delete__header">Delete a service "<?= $arItem["NAME"] ?>"?</div>
										<div class="b-delete__actions">
											<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-personal-service" data-url="?id=<?= $arItem["ID"] ?>&delete=y">Yes</button>
											<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">No</button>
										</div>
									</div>
								</div>
							<? endif ?>
						</div>
					</div>

					<div class="b-personal-service__content">
						<div class="b-personal-service__top">
							<div class="h3 b-personal-service__name"><?= $arItem["NAME"] ?></div>
							<span class="b-personal-service__price"><span class="b-personal-service__value">£ <?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?></span> / <?= $arItem["PROPERTIES"]["CALCULATION_PERIOD"]["VALUE_XML_ID"] ?></span>
						</div>
						<div class="b-personal-service__description">
							<p><?= $arItem["PREVIEW_TEXT"] ?></p>
						</div>
					</div>

					<section class="mfp-hide service modal" id="service-<?= $arItem["ID"] ?>">
						<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Закрыть"></button>
						<div class="modal__content">
							<div class="h2 modal__title">Changing the service</div>

							<form class="form modal__form js-edit-service" id="form-<?= $arItem["ID"] ?>">
								<input type="hidden" name="formUpdateService" value="Y">
								<input type="hidden" name="id" value="<?= $arItem["ID"] ?>">
								<input type="hidden" name="name_edit" value="<?= $arItem["NAME"] ?>">

								<div class="form-group">
									<label class="visuallyhidden" for="service-1-name">Name of the service</label>
									<input class="form-control" type="text" name="service-1-name" id="service-1-name" value="<?= $arItem["NAME"] ?>" placeholder="Name of the service" required="required" <? if ($arItem["PROPERTIES"]["DOGSITTING"]["VALUE"] == "Yes") : ?>disabled<? endif ?>>
								</div>
								<!-- Type service -->
								<div class="form-group">
									<div class="select-style select-style--white-br">
										<select class="js-select" name="TYPE_SERVICES" data-placeholder="Тип услуги">
											<option value=""></option>
											<? foreach ($arItem["TYPE_SERVICE"] as $key => $value) : ?>
												<option value="<?= $key ?>" <? if ($key == $arItem["PROPERTIES"]["TYPE_SERVICES"]["VALUE"]) : ?> selected="selected" <? endif ?>><?= $value ?></option>
											<? endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="visuallyhidden" for="service-1-description"></label>
									<textarea class="form-control form-control--big" name="service-1-description" id="service-1-description" placeholder="Description of the service" required="required"><?= $arItem["PREVIEW_TEXT"] ?></textarea>
								</div>
								<div class="form-group form-group--mb2">
									<div class="form-price form-price--row">
										<label class="form-label form-price__label" for="service-1-price">The cost of the service</label>
										<div class="form-price__wrapper">
											<div class="form-price__input">
												<input type="text" name="service-1-price" id="service-1-price" value="<?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?>" required="required"><span>£</span>
											</div>
											<div class="select-style select-style--light form-price__select">
												<select class="js-select" name="service-1-price-type" required="required">
													<? foreach ($arItem["CALCULATION_PERIOD"] as $key => $value) : ?>
														<option value="<?= $key ?>" <? if ($arItem["PROPERTIES"]["CALCULATION_PERIOD"]["VALUE"] == $value) : ?> selected="selected" <? endif ?>><?= $value ?></option>
													<? endforeach ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn--yellow">Save changes</button>
							</form>
						</div>
					</section>
				</div>
			<? endforeach ?>
		</div>
	</div>
</div>