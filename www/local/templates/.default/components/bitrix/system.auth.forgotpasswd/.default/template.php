<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

ShowMessage($arParams["~AUTH_RESULT"]);

?>
<section class="pass modal">
	<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Close"></button>
	<div class="modal__content">
		<div class="h2 modal__title"><? echo GetMessage("sys_forgot_pass_label") ?></div>

		<form class="js-validate modal__form validation" name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
			<?
			if ($arResult["BACKURL"] <> '')
			{
			?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
			<?
			}
			?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="SEND_PWD">

			<div class="form-group form-group--mb2">
				<label class="visuallyhidden" for="email"><?= GetMessage("sys_forgot_pass_login1") ?></label>
				<input class="form-control" type="text" id="email" name="USER_LOGIN" value="<?= $arResult["USER_LOGIN"] ?>" placeholder="<?= GetMessage("sys_forgot_pass_login1") ?>" required="required" /><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
				<input type="hidden" name="USER_EMAIL" />
			</div>

			<? if ($arResult["PHONE_REGISTRATION"]) : ?>
				<div style="margin-top: 16px">
					<div><b><?= GetMessage("sys_forgot_pass_phone") ?></b></div>
					<div><input type="text" name="USER_PHONE_NUMBER" value="<?= $arResult["USER_PHONE_NUMBER"] ?>" /></div>
					<div><? echo GetMessage("sys_forgot_pass_note_phone") ?></div>
				</div>
			<? endif; ?>

			<? if ($arResult["USE_CAPTCHA"]) : ?>
				<div style="margin-top: 16px">
					<div>
						<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA" />
					</div>
					<div><? echo GetMessage("system_auth_captcha") ?></div>
					<div><input type="text" name="captcha_word" maxlength="50" value="" /></div>
				</div>
			<? endif ?>

			<div class="modal__actions">
				<input class="btn btn--yellow" type="submit" name="send_account_info" value="<?= GetMessage("AUTH_SEND") ?>" />
			</div>
		</form>
		<span class="decor modal__triangle" aria-hidden="true">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-triangle" />
			</svg>
		</span>
		<span class="decor modal__zig-line" aria-hidden="true"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-zigline-small" />
			</svg>
		</span>
	</div>
</section>

<script type="text/javascript">
	document.bform.onsubmit = function() {
		document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
	};
	document.bform.USER_LOGIN.focus();
</script>