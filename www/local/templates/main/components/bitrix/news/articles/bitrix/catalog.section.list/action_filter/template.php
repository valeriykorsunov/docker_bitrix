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
?>

<form class="js-submit-on-change articles__filter" action="/" method="GET">
	<div class="select-style select-style--row">
		<label for="category-select">Categories:</label>
		<select onchange="reloadSection(this);" class="js-select" name="category" id="category-select">
			<option value="0">All</option>
			<? foreach ($arResult['SECTIONS'] as $section) : ?>
				<?/*
				<option value="<?= $section["ID"] ?>" <?=($section["ID"] == $arParams["GET"] ? "selected": "")?>><?= $section["NAME"] ?></option>
				*/?>
				<option value="<?= $section["CODE"] ?>" <?=($section["CODE"] == $arParams["SECTION_CODE"] ? "selected": "")?>><?= $section["NAME"] ?></option>
			<? endforeach ?>
		</select>
	</div>
</form>