<?

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

use Account\UserInfo;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?>

<div class="personal-area__right personal-area__right--pink personal-area__right--pass">
	<div class="b-change-password">
		<form class="form b-change-password__form" method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />

			<div class="form-title h5">Change your password</div>
			<div class="form-title"><?ShowError($arResult["strProfileError"]);?></div>
			<div class="form-group">
				<label class="visuallyhidden" for="new-pass">New password</label>
				<input class="form-control" type="password" name="NEW_PASSWORD" id="new-pass" placeholder="New password" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group form-group--mb2">
				<label class="visuallyhidden" for="repeat-new-pass">Repeat the password</label>
				<input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" id="repeat-new-pass" placeholder="Repeat the password" data-compare-name="new-pass" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<input class="btn btn--dark-purple" type="submit" name="save" value="Save Password">
		</form>
	</div>
</div>