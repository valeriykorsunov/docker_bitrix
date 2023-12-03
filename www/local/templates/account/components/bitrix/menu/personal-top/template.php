<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<? if (!empty($arResult)) : ?>
	<ul class="user-nav__list b-user-links-list">
		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
			if ($arItem["PERMISSION"] == "D") continue;
		?>
			<li class="b-user-links-list__item">
				<a class="b-user-links-list__link" href="<?= $arItem["LINK"] ?>">
					<svg class="b-user-links-list__icon <?= $arItem["PARAMS"]["CLASS"] ?>" role="img" width="1em" height="1em">
						<use xlink:href="<?= $arItem["PARAMS"]["ICON"] ?>" />
					</svg><?= $arItem["TEXT"] ?></a>
			</li>
		<? endforeach ?>
	</ul>
<? endif ?>
