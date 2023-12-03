<?

use Bitrix\Main\Diag\Debug;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
		<div class="index__personal b-personal">
			<span class="decor b-personal__cube" aria-hidden="true">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-cube-2" />
				</svg>
			</span>
			<div class="b-personal__table">
				<div class="b-personal__header">
					<div class="b-personal__cell b-personal__cell--head">Our Employees</div>
					<div class="b-personal__cell b-personal__cell--head">Post</div>
					<div class="b-personal__cell b-personal__cell--head">Contacts</div>
					<div class="b-personal__cell b-personal__cell--head"></div>
				</div>
				<div class="b-personal__body">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="b-personal__row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="b-personal__cell b-personal__cell--name">
							<div class="responsive-img b-personal__photo">
								<img class="lazyload" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" src alt data-object-fit="cover">
							</div>
							<span class="b-personal__name"><?=$arItem["NAME"]?></span>
						</div>
						<div class="b-personal__cell"><?=$arItem["PROPERTIES"]["POST"]["VALUE"]?></div>
						<div class="b-personal__cell">
							<a class="b-personal__phone" href="tel:<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></a>, 
							<a class="b-personal__email" href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
						</div>
						<div class="b-personal__cell">
							<ul class="b-personal__social">
								<?if($arItem["PROPERTIES"]["VK"]["VALUE"] != ""):?>
									<li class="b-personal__social-item">
										<a class="b-personal__social-link" href="<?=$arItem["PROPERTIES"]["VK"]["VALUE"]?>">
											<svg role="img" width="1em" height="1em">
												<use xlink:href="#si-soc-vk" />
											</svg>
										</a>
									</li>
								<?endif?>
								<?if($arItem["PROPERTIES"]["FACEBOOK"]["VALUE"] != ""):?>
								<li class="b-personal__social-item">
									<a class="b-personal__social-link" href="<?=$arItem["PROPERTIES"]["FACEBOOK"]["VALUE"]?>">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-soc-fb" />
										</svg>
									</a>
								</li>
								<?endif?>
								<?if($arItem["PROPERTIES"]["INSTAGRAM"]["VALUE"] != ""):?>
								<li class="b-personal__social-item">
									<a class="b-personal__social-link" href="<?=$arItem["PROPERTIES"]["INSTAGRAM"]["VALUE"]?>">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-soc-inst" />
										</svg>
									</a>
								</li>
								<?endif?>
							</ul>
						</div>
					</div>
					<?endforeach?>
				</div>
			</div>
		</div>

<?/*
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
*/?>