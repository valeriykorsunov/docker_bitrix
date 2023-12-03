<?

use Account\AccountAccess;
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
$isExecutor = AccountAccess::$typeUser == "EXECUTOR";
?>

<div class="js-scroll-block b-personal-orders">
	<div class="b-personal-orders__list">
		<? if ($arParams["HISTORY"] != "Y") $first = true; ?>
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?
			$state = $arItem["PROPERTIES"]["CURRENT_STATE"]["VALUE_XML_ID"];
			$isWeekend = $state == "weekend";
			$recipientID = $arItem["recipientID"];
			$activeApplication = $arItem["activeApplication"];
			if ($isWeekend) {
				$activeApplication = FormatDate($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem["ACTIVE_FROM"]));
			}
			?>
			<div class="b-personal-orders__item">
				<div class="b-personal-order <?= ($first ? "active" : "") ?> <?= (empty($state) ? "new-order" : "") ?>">

					<div class="b-personal-order__left">
						<div class="b-personal-order__wrapper">
							<span class="h6 b-personal-order__name"><?=$arItem["CONTACT_NAME"]; //$arItem["NAME"] ?></span>
							<span class="b-personal-order__mail" data-recipientID="<?= $recipientID ?>">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-ic-email" />
								</svg>
							</span>
						</div>
						<div class="b-personal-order__status"><?= $activeApplication ?></div>
					</div>

					<? // TODO Вывод услуги в список 
					?>

					<div class="b-personal-order__right">
						<!-- Название услуги -->
						<div class="h6 b-personal-order__service"><?= $arItem["SERVICE"]["NAME"] ?></div>
						<? if ($state != "weekend") : ?>
							<ul class="b-personal-order__list">
								<? if ($arItem["PET"]["PROP"]["TYPE_PET"]["VALUE"]) : ?>
									<li class="b-personal-order__item"><span class="b-personal-order__type-name">
											Type of pet:</span><span class="b-personal-order__value"><?= $arItem["PET"]["TYPE"]["UF_NAME"] ?></span>
									</li>
								<? endif; ?>
								<? if ($arItem["PET"]["PROP"]["PET_BREED"]["VALUE"]) : ?>
									<li class="b-personal-order__item"><span class="b-personal-order__type-name">
											The breed of the pet:</span><span class="b-personal-order__value"><?= $arItem["PET"]["PROP"]["PET_BREED"]["VALUE"] ?></span>
									</li>
								<? endif; ?>
							</ul>
						<? endif; ?>

						<div class="account-personal__controls" data-request-id="<?= $arItem["ID"] ?>">
							<? if (AccountAccess::$typeUser == "EXECUTOR" && \Site\App\UserLicense::getStatus()) : ?>
								<? if ($state == "in_work") : ?>
									<button class="btn js-requestEnd">Finish</button>
								<?elseif($state == "weekend"):?>
									<button class="btn js-refuse">Refuse</button>
								<? elseif(empty($state)) : ?>
									<button class="btn btn--pink js-requestConfirm">Confirm</button>
									<button class="btn js-refuse">Refuse</button>
								<? endif; ?>

							<? else : ?>
								<? if (!$isExecutor && empty($state)) : ?>
									<button class="btn js-refuse">Refuse</button>
								<? endif ?>
							<? endif ?>
						</div>

					</div>

					<?/* старый вид кнопок ?>
					<div  class="b-personal-order--button" data-request-id="<?= $arItem["ID"] ?>">
						<? if (AccountAccess::$typeUser == "EXECUTOR" && \Site\App\UserLicense::getStatus()) : ?>
							<? if (empty($state) || $state == "weekend") : ?>
								<? if ($isExecutor && $state != "weekend") : ?>
									<div class="button--pg">
										<button class="btn btn--dimmed btn--circle-small js-requestStart">
											<svg role="img" width="1em" height="1em">
												<use xlink:href="#si-play" />
											</svg>
										</button>
									</div>
								<? endif; ?>

								<div class="button--pg">
									<div class="js-delete b-personal-service__delete b-delete">
										<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
											<svg role="img" width="1em" height="1em">
												<use xlink:href="#si-ic-trash" />
											</svg>
										</button>

										<div class="dropdown js-delete-dropdown b-delete__dropdown">
											<div class="b-delete__header">Delete service "<?= $arItem["NAME"] ?>"?</div>
											<div class="b-delete__actions">
												<button class="btn btn--clear b-delete__button js-delete-yes b-delete__button--yes js-requestDelete">Yes</button>

												<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">No</button>
											</div>
										</div>

									</div>
								</div>

							<? elseif ($state == "in_work") : ?>
								<div class="button--pg">
									<button class="btn btn--dimmed btn--circle-small js-requestEnd">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-ic-test" />
										</svg>
									</button>
								</div>
							<? endif ?>
						<? endif ?>
					</div>
					<?*/?>

				</div>
			</div>
			<? $first = false; ?>
		<? endforeach ?>
	</div>
</div>