<?php

use Bitrix\Main\Diag\Debug;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
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

<div class="b-contacts__top">
	<div class="b-contacts__top-left" style="width: 100%;">
		<h2 class="h1 b-contacts__title"><?= $arResult["fields"]["NAME"]?></h2>
		<div class="content-style b-contacts__text">
			<p><?= $arResult["fields"]["PREVIEW_TEXT"]?></p>
		</div>
	</div>
	<!-- <div class="b-contacts__top-right">
		<?//= $arResult["fields"]["DETAIL_TEXT"]?>
	</div> -->
</div>