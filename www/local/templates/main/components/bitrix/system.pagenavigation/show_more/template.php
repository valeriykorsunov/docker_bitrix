<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->createFrame()->begin("Загрузка навигации");
?>

<? if ($arResult["NavPageCount"] > 1) : ?>
<div class="articles__bottom load_more_block">
	<? if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]) : ?>
		<?
		$plus = $arResult["NavPageNomer"] + 1;
		$url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;

		?>
		<button data-url="<?= $url ?>" class="btn btn--yellow js-load-more articles__button load_more"><?= GetMessage("next"); ?></button>
		<span class="decor articles__arrow" aria-hidden="true">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-big-arrow" />
			</svg>
		</span>
	<? else : ?>
		<?/*
		<button class="btn btn--yellow js-load-more articles__button"><? echo GetMessage("end"); ?></button>

		<div data-url="<?= $url ?>" class="exercises__more load_more">
			<a href="#" class="exercises__more-button button button--new button--outline-primary button--md"><? echo GetMessage("end"); ?></a>
		</div>
		*/?>
	<? endif ?>
</div>
<? endif ?>
