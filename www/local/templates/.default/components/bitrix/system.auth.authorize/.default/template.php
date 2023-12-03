<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<div class="auth__item auth__item--dimmed">

	<h2 class="auth__title">Login</h2>
	<form class="form auth__form" name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<? if ($arResult["BACKURL"] <> '') : ?>
			<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
		<? endif ?>
		<? foreach ($arResult["POST"] as $key => $value) : ?>
			<input type="hidden" name="<?= $key ?>" value="<?= $value ?>" />
		<? endforeach ?>

		<div class="form-group">
			<label class="visuallyhidden" for="auth-email">e-mail</label>
			<input class="form-control" type="text" name="USER_LOGIN" id="auth-email" placeholder="e-mail" value="<?= $arResult["LAST_LOGIN"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="form-group">
			<label class="visuallyhidden" for="auth-pass">Password</label>
			<input class="form-control" type="password" name="USER_PASSWORD" id="auth-pass" placeholder="Password" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="form-group form-group--mb2 form-group--center "><a class="auth__link js-ajax-modal" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
		</div>
		<input type="submit" class="btn btn--pink" name="Login" value="Login<? //= GetMessage("AUTH_AUTHORIZE") ?>" />
		<!-- <button class="btn btn--pink">Войти</button> -->
	</form>

		<? if ($arResult["AUTH_SERVICES"] && false) : ?>
		<div class="auth__social">
		<div class="h6 auth__social-title">Or enter through social networks</div>
			<ul class="b-social-list b-social-list--small">
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:socserv.auth.form",
				"",
				array(
					"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
					"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
					"AUTH_URL" => $arResult["AUTH_URL"],
					"POST" => $arResult["POST"],
					"SHOW_TITLES" => $arResult["FOR_INTRANET"] ? 'N' : 'Y',
					"FOR_SPLIT" => $arResult["FOR_INTRANET"] ? 'Y' : 'N',
					"AUTH_LINE" => $arResult["FOR_INTRANET"] ? 'N' : 'Y',
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</ul>
	</div>
		<? endif ?>

	<span class="decor auth__zig-line" aria-hidden="true">
		<svg role="img" width="1em" height="1em">
			<use xlink:href="#si-decor-zigline-small" />
		</svg>
	</span>
</div>
