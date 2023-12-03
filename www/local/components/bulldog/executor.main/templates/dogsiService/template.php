<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="b-profile-info__item">
	<div class="h6 b-profile-info__title b-profile-info__title--mb-0">Cost</div>
	<ul class="b-profile-info__cost-list">
		<? foreach ($arResult["dogsiService"] as $serv) : ?>
			<li class="b-profile-info__cost-item">
				<span class="b-profile-info__service"><?= $serv["NAME"] ?></span>
				<span class="b-profile-info__price"><span class="b-profile-info__value">£ <?= $serv["PRICE"] ?></span> / <?= $serv["CALCULATION_PERIOD"] ?></span>
			</li>
		<? endforeach ?>
	</ul>
	<div class="b-profile-info__center-wrapper"><a class="js-link-anchor b-profile-info__link b-profile-info__link--pink" href="#personal-price">More detailed</a>
	</div>
</div>