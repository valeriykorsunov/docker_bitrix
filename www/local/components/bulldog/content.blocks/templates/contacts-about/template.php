<?php

use Bitrix\Main\Config\Option;
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

<div class="b-contacts__bottom-right">
	<h3><?= $arParams["header"] ?></h3>
	<div class="b-contacts__list" itemscope itemtype="https://schema.org/Organization">
		<div class="b-contacts__list-left">
			<div class="b-contacts__item"><span class="b-contacts__icon b-contacts__icon--phone">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-mobile" />
					</svg>
				</span>
				<a class="b-contacts__link b-contacts__link--phone" href="tel:<?= BulldogUtils::numbersOnly(Option::get("askaron.settings", "UF_PHONE")) ?>" itemprop="telephone"><?= Option::get("askaron.settings", "UF_PHONE"); ?></a>
				<!-- UF_ADDITONAL_PHONE -->
				<a class="b-contacts__link b-contacts__link--phone" href="tel:<?= BulldogUtils::numbersOnly(Option::get("askaron.settings", "UF_ADDITONAL_PHONE")) ?>">
					<?= Option::get("askaron.settings", "UF_ADDITONAL_PHONE"); ?>
				</a>
			</div>
		</div>
		<div class="b-contacts__list-right">
			<div class="b-contacts__item"><span class="b-contacts__icon b-contacts__icon--mail"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-mail" />
					</svg></span>
					<a class="b-contacts__link b-contacts__link--mail" href="mailto:<?= Option::get("askaron.settings", "UF_MAIL"); ?>" itemprop="email"><?= Option::get("askaron.settings", "UF_MAIL"); ?></a>
			</div>
			<div class="b-contacts__item"><span class="b-contacts__icon b-contacts__icon--skype"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-skype" />
					</svg></span><a class="b-contacts__link" href="skype:<?= Option::get("askaron.settings", "UF_SKYPE"); ?>?call"><?= Option::get("askaron.settings", "UF_SKYPE"); ?></a>
			</div>
			<div class="b-contacts__item"><span class="b-contacts__icon b-contacts__icon--inst"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-soc-inst" />
					</svg></span><a class="b-contacts__link" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_INST"); ?>"><?=$arParams["inst_name_link"]?></a>
			</div>
		</div>
	</div>
</div>