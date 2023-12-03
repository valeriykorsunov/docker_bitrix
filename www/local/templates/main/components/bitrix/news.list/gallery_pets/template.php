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
$this->setFrameMode(true);
?>
<? if ($arResult["ITEMS"]) : ?>
	<section class="index__gallery b-gallery">
		<?if($arParams["TITLE"] != ""):?>
		<h2 class="h1 b-gallery__title">Your satisfied pets</h2>
		<?endif?>
		<div class="js-gallery b-gallery__grid">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<?
			if($arItem["NAME"] == "5")
			Debug::dumpToFile($arItem["PROPERTIES"]["VIDEO"]["VALUE"] ,'***'.date('Y-m-d H:i:s').'***'.__FILE__);
			if($arItem["PROPERTIES"]["VIDEO"]["VALUE"] != "")
			{
				$linck = CFile::GetPath($arItem["PROPERTIES"]["VIDEO"]["VALUE"]);
				$type = "video";
			}
			else
			{
				$linck = $arItem["PREVIEW_PICTURE"]["SRC"];
				$type = "image";
			}
			?>
			<a class="responsive-img b-gallery__item" href="<?=$linck?>" data-type="<?if($type == "image"):?>image<?else:?>iframe<?endif?>">
				<span class="icon <?if($type == "image"):?>icon--eye<?else:?>icon--play<?endif?> b-gallery__icon" aria-hidden="true">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#<?if($type == "image"):?>si-eye<?else:?>si-play<?endif?>" />
					</svg>
				</span>
				<img class="lazyload" data-src="<?=$arItem["PREVIEW_PICTURE"]["RESIZE_SRC"]?>" src alt data-object-fit="cover">
			</a>
			<?endforeach?>
		</div>
	</section>
<? endif ?>
