<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="b-profile-info__item">
	<div class="b-verification">
		<? if ($arResult["UF_VERIFICATION_COMPLETED"] == "1") : ?>
			<div class="b-verification__status">
				<span class="b-verification__icon b-verification__icon--succes">
					<svg role="img" width="1em" height="1em">
						<use xlink:href="#si-sale" />
					</svg>
					<i class="fa fa-check"></i>
				</span>
				Verification passed
			</div>
		<? endif ?>
		<?if($arResult["passedTests"]):?>
		<ul class="b-verification__list">
			<?foreach($arResult["passedTests"] as $name):?>
				<li class="b-verification__item"><i class="fa fa-check b-verification__item-icon b-verification__item-icon--succes"></i><?= $name?></li>
			<?endforeach?>
		</ul>
		<?endif?>
	</div>
</div>