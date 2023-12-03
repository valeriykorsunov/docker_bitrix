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
<div class="personal-area__content">
	<h1 class="h5 personal-area__title"><?= $arParams["TITLE"]?></h1>
	<div class="personal-area__gray-wrapper">
		<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--in-gray">
			<div class="b-personal-test-list">
				<? foreach ($arResult['SECTIONS'] as &$arSection) : ?>
					<div class="b-personal-test-list__item <?if($arSection["RES_TEST_TRUE"]):?>b-personal-test-list__item--success<?endif?>">
						<div class="b-personal-test-list__top">
							<span class="b-personal-test-list__status">
								<i class="fa fa-check b-personal-test-list__status-icon"></i>
								<span class="b-personal-test-list__status-text">
								<?if($arSection["RES_TEST_TRUE"]):?>
									The test is completed
								<?else:?>
									The test is not passed
								<?endif?>
								</span>
							</span>
							<?if($arSection["RES_TEST"]):?>
								<span class="b-personal-test-list__results"><?=$arSection["RES_TEST"]["PROPERTY_NUMBER_CORRECT_ANSWERS_VALUE"]?> / <?=$arSection["RES_TEST"]["PROPERTY_NUMBER_QUESTIONS_VALUE"]?></span>
							<?endif?>
						</div>
						<span class="h6 b-personal-test-list__name"><?=$arSection["NAME"]?></span>
						<div class="b-personal-test-list__text">
							<p><?=$arSection["DESCRIPTION"]?></p>
						</div>
						<a class="btn btn--yellow b-personal-test-list__button" href="<?=$arSection["SECTION_PAGE_URL"]?>">Pass the test</a>
					</div>
				<? endforeach ?>
			</div>
		</div>
	</div>
</div>
