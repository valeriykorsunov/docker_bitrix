<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<section class="article__popular b-popular-article">
	<h2 class="h3 b-popular-article__title"><?=GetMessage("TITLE_LIST")?></h2>
	<ul class="b-popular-article__list">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<li class="b-popular-article__item">
			<a class="b-popular-article__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<div class="responsive-image b-popular-article__image">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" data-object-fit="cover">
				</div>
				<div class="h6 b-popular-article__name"><?=$arItem["NAME"]?></div>
			</a>
		</li>
		<?endforeach?>
	</ul>
</section>
