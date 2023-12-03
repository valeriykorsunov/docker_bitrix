<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); 

?>

<? if (!empty($arResult)) : ?>
	<ul class="personal-area__list b-personal-area-menu">

		<?
		foreach ($arResult as $arItem) :
			if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				continue;
			if($arItem["PERMISSION"] == "D") continue;
		?>
			<? if ($arItem["SELECTED"]) : ?>
				<li class="active b-personal-area-menu__item">
					<a class="b-personal-area-menu__link" href="<?= $arItem["LINK"] ?>">
						<svg class="b-personal-area-menu__icon <?=$arItem["PARAMS"]["CLASS"]?>" role="img" width="1em" height="1em">
							<use xlink:href="<?=$arItem["PARAMS"]["ICON"]?>" />
						</svg><?= $arItem["TEXT"] ?></a>
				</li>
			<? else : ?>
				<li class="b-personal-area-menu__item">
					<a class="b-personal-area-menu__link" href="<?= $arItem["LINK"] ?>">
						<svg class="b-personal-area-menu__icon <?=$arItem["PARAMS"]["CLASS"]?>" role="img" width="1em" height="1em">
							<use xlink:href="<?=$arItem["PARAMS"]["ICON"]?>" />
						</svg><?= $arItem["TEXT"] ?></a>
				</li>
			<? endif ?>

		<? endforeach ?>

	</ul>
<? endif ?>
