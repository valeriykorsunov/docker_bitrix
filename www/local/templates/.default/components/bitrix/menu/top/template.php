<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
		<ul class="site-nav__list">

			<?
			foreach ($arResult as $arItem) :
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
					continue;
			?>
				<? if ($arItem["SELECTED"]) : ?>
					<li class="active site-nav__item">
						<a class="site-nav__link" href="<?= $arItem["LINK"] ?>">
							<?= $arItem["TEXT"] ?>
						</a>
					</li>
				<? else : ?>
					<li class="site-nav__item">
						<a class="site-nav__link" href="<?= $arItem["LINK"] ?>">
							<?= $arItem["TEXT"] ?>
						</a>
					</li>
				<? endif ?>

			<? endforeach ?>

		</ul>
<? endif ?>