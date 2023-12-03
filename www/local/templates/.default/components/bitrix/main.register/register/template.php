<?

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

use Bitrix\Main\Diag\Debug;

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();


if ($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>

<div class="auth__item">
	<h2 class="auth__title">Sigh up</h2>

	<? if ($USER->IsAuthorized()) : ?>

		<? LocalRedirect('/account/'); ?>
		<p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>

	<? else : ?>
		<?
		if (count($arResult["ERRORS"]) > 0) :
			foreach ($arResult["ERRORS"] as $key => $error)
				if (intval($key) == 0 && $key !== 0)
					$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

			ShowError(implode("<br />", $arResult["ERRORS"]));

		elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y") :
		?>
			<p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
		<? endif ?>

		<? if ($arResult["SHOW_SMS_FIELD"] == true) : // SMS регистрация
		?>

			<form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
				<?
				if ($arResult["BACKURL"] <> '') :
				?>
					<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
				<?
				endif;
				?>
				<input type="hidden" name="SIGNED_DATA" value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>" />
				<table>
					<tbody>
						<tr>
							<td><? echo GetMessage("main_register_sms") ?><span class="starrequired">*</span></td>
							<td><input size="30" type="text" name="SMS_CODE" value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off" /></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td><input type="submit" name="code_submit_button" value="<? echo GetMessage("main_register_sms_send") ?>" /></td>
						</tr>
					</tfoot>
				</table>
			</form>

			<script>
				new BX.PhoneAuth({
					containerId: 'bx_register_resend',
					errorContainerId: 'bx_register_error',
					interval: <?= $arResult["PHONE_CODE_RESEND_INTERVAL"] ?>,
					data: <?= CUtil::PhpToJSObject([
								'signedData' => $arResult["SIGNED_DATA"],
							]) ?>,
					onError: function(response) {
						var errorDiv = BX('bx_register_error');
						var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
						errorNode.innerHTML = '';
						for (var i = 0; i < response.errors.length; i++) {
							errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
						}
						errorDiv.style.display = '';
					}
				});
			</script>

			<div id="bx_register_error" style="display:none"><? ShowError("error") ?></div>

			<div id="bx_register_resend"></div>

		<? else : ?>

			<form class="form auth__form" method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
				<? if ($arResult["BACKURL"] <> '') : ?>
					<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
				<? endif; ?>
				<input type="hidden" name="REGISTER[LOGIN]" value="testUser">

				<div class="form-row">
					<div class="form-group form-group--mb2 form-group--half">
						<label class="visuallyhidden" for="firstName">First name</label>
						<input class="form-control form-control--dimmed" type="text" name="REGISTER[NAME]" id="firstName" placeholder="First name" required>
						<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>

					<div class="form-group form-group--mb2 form-group--half">
						<label class="visuallyhidden" for="LastName">Last name</label>
						<input class="form-control form-control--dimmed" type="text" name="REGISTER[LAST_NAME]" id="LastName" placeholder="Last name" data-compare-name="password" required>
						<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
				</div>

				<!-- <div class="form-group">
					<label class="visuallyhidden" for="reg-name">Name and Last name</label>
					<input class="form-control form-control--dimmed" type="text" name="REGISTER[LOGIN]" value="<?= $arResult["VALUES"]["LOGIN"] ?>" id="reg-name" placeholder="Name and Last name" required>
					<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
				</div> -->

				<div class="form-group">
					<label class="visuallyhidden" for="reg-email">e-mail</label>
					<input class="form-control form-control--dimmed" type="text" name="REGISTER[EMAIL]" value="<?= $arResult["VALUES"]["EMAIL"] ?>" id="reg-email" placeholder="e-mail" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
				</div>
				<div class="form-row">
					<div class="form-group form-group--mb2 form-group--half">
						<label class="visuallyhidden" for="reg-pass">Password</label>
						<input class="form-control form-control--dimmed" type="password" name="REGISTER[PASSWORD]" id="reg-pass" placeholder="Password" required>
						<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
					<div class="form-group form-group--mb2 form-group--half">
						<label class="visuallyhidden" for="reg-pass-repeat">Password confirmation</label>
						<input class="form-control form-control--dimmed" type="password" name="REGISTER[CONFIRM_PASSWORD]" id="reg-pass-repeat" placeholder="Password confirmation" data-compare-name="password" required>
						<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
				</div>
				<div class="form-group">
					<div class="select-style select-style--fix">
						<select class="js-select" name="GROUP_ID" data-placeholder="Pet carer">
							<option value="5">Pet carer </option>
							<option value="6">Pet owner</option>
						</select>
					</div>
				</div>
				<div class="form-group" style="text-align: center;">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="personal-data-agreements" checked>
						<i class="ui-checkbox__icon">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg>
						</i>
						<a href="/documents/personal-data-agreements/" target="_blank" class="ui-checkbox__text">Consent to personal data processing</a>
					</label>
				</div>
				<!-- <input type="submit" name="register_submit_button" class="btn btn--yellow" value="Registration"/> -->
				<input type="hidden" name="register_submit_button" value="Registration">
				<button name="register_button" class="btn btn--yellow">Sigh up</button>
			</form>

		<? endif ?>
	<? endif ?>


	<? if ($arResult["AUTH_SERVICES"] && false) :?>
		<div class="auth__social">
			<div class="h6 auth__social-title">Or register through social networks</div>
			<ul class="b-social-list b-social-list--small b-social-list--dimmed-item">
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

	<span class="decor auth__cube" aria-hidden="true">
		<svg role="img" width="1em" height="1em">
			<use xlink:href="#si-decor-cube-auth" />
		</svg>
	</span>
</div>