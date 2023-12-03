<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->createFrame()->begin("Загрузка навигации");
?>

<? if ($arResult["NavPageCount"] > 1) : ?>

	<div class="reviews__actions load_more_block">
		<? if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]) : ?>
			<?
			$plus = $arResult["NavPageNomer"] + 1;
			$url = $arResult["sUrlPathParams"] . "PAGEN_" . $arResult["NavNum"] . "=" . $plus;
			
			?>
			<button data-url="<?= $url ?>" class="btn btn--yellow js-load-more-review load_more">Download more</button>
			<span class="decor reviews__triangles" aria-hidden="true">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-triangles" />
				</svg>
			</span>
		<? else : ?>

		<? endif ?>
	</div>
<? endif ?>