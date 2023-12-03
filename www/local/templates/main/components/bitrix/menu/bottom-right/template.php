<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<div class="footer__links">
		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
		?>
		<a class="footer__links-item" href="<?= $arItem["LINK"] ?>" target="_blank"><?= $arItem["TEXT"] ?></a>
		<? endforeach ?>
	</div>
<? endif ?>