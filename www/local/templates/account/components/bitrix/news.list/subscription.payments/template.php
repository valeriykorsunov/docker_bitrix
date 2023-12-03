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

<div class="js-tabs-content b-tabs__content" id="personal-tab2">
	<div class="js-scroll-block b-personal-orders">
		<div class="b-personal-orders__list">
			<? foreach($arResult["ITEMS"] as $arItem): ?>
			<div class="b-personal-orders__item">
				<div class="b-personal-order--mod <?if($arItem["PROPERTIES"]["STATUS"]["VALUE_XML_ID"] == "PAID") echo "new-order";?>">

					<div class="b-personal-order__left">
						<div class="b-personal-order__wrapper">
							<span class="h6">№ <?= $arItem["ID"]?></span>

						</div>
						<div class="b-personal-order__status"><?=  $arItem["PROPERTIES"]["STATUS"]["VALUE"]?></div>
					</div>

					<div class="b-personal-order__right">
						<!-- Название услуги -->
						<div class="h6 b-personal-order__service"><?= $arItem["NAME"]?></div>

						<ul class="b-personal-order__list">
							<li class="b-personal-order__item">
								<span class="b-personal-order__type-name">Date:</span><span class="b-personal-order__value"><?= FormatDate("d/m/Y", MakeTimeStamp($arItem["ACTIVE_FROM"]))?></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<? endforeach; ?>
		</div>
	</div>
</div>
