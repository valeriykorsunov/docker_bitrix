<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
$this->setFrameMode(true);

?>

<div class="b-personal-service__content b-personal-service__content--mod">
	<div class="b-personal-service__top">

<h2 class="h1 b-articles__title">My subscriptions</h2>
		<span class="b-personal-service__price"><span class="b-personal-service__value"></span></span>
	</div>

	<div class="b-personal-service__description">
		<div class="b-personal-test-list">
			<? foreach ($arResult["ITEMS"] as $arItem) : ?>
				<form action="https://secure-test.worldpay.com/wcc/purchase" method="POST" class="b-personal-test-list__item b-personal-test-list__item--mod">
					<input type="hidden" name="testMode" value="100">
					<!-- These first four elements are mandatory. -->
					<input type="hidden" name="instId" value="1470833">
					<input type="hidden" name="currency" value="GBP">
					<input type="hidden" name="amount" value="0">
					<input type="hidden" name="cartId" value="">

					<!-- These elements below are optional. -->
					<input type="hidden" name="desc" value="<?= $arItem["NAME"] ?>">
					<!-- <input type="hidden" name="name" value="CAPTURED"> -->

					<span class="h6 b-personal-test-list__name"><?= $arItem["NAME"] ?></span>
					<div class="b-personal-test-list__text">
						<p><?= $arItem["~PREVIEW_TEXT"] ?></p>
					</div>
					<div class="b-personal-test-list__item-bottom">
						<div class="b-personal-test-list__top b-personal-test-list__top--mod">
							<span class="b-personal-test-list__status">

								<span class="b-personal-test-list__results">Price</span>
							</span>
							<span class="b-personal-test-list__results">£<?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?> / month</span>
						</div>
						<? if($USER->IsAuthorized()): ?>
							<button class="btn btn--yellow b-personal-test-list__button js-bay-tariffs" data-idTariffs="<?= $arItem["ID"]?>" href="#">Buy</button>
						<? else: ?>
							<a class="btn btn--yellow b-personal-test-list__button" href="/login/">Buy</a>
						<? endif; ?>
					</div>
				</form>
			<? endforeach; ?>
		</div>
	</div>

</div>