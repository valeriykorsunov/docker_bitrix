<?php

use Bitrix\Main\Config\Option;

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
<? if ($arParams["HIDE_BLOCK"] != "Y") : ?>
	<div class="mobile-menu__social">
		<ul class="b-social-list b-social-list--mobile-menu">
			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_FB") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--fb" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_FB")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-fb" />
						</svg>
					</a>
				</li>
			<? endif ?>

			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_VK") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--vk" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_VK")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-vk" />
						</svg>
					</a>
				</li>
			<? endif ?>

			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_INST") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--inst" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_INST")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-inst" />
						</svg>
					</a>
				</li>
			<? endif ?>

			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_WT") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--wt" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_WT")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-wt" />
						</svg>
					</a>
				</li>
			<? endif ?>

			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_TG") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--tg" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_TG")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-tg" />
						</svg>
					</a>
				</li>
			<? endif ?>

			<? if (Option::get("askaron.settings", "UF_SOCIAL_LINK_YT") != "") : ?>
				<li class="b-social-list__item">
					<a class="b-social-list__link b-social-list__link--yt" href="<?= Option::get("askaron.settings", "UF_SOCIAL_LINK_YT")?>">
						<svg role="img" width="1em" height="1em">
							<use xlink:href="#si-soc-yt" />
						</svg>
					</a>
				</li>
			<? endif ?>
		</ul>
	</div>
<? endif ?>
