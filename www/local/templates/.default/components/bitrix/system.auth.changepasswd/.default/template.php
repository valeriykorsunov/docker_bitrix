<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<div class="auth">
	<div class="wrap wrap--limited auth__wrapper">

		<ul class="parallax-scene js-scene" data-relative-input="true">
			<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--light-green auth__particle auth__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--pink auth__particle auth__particle--pink"></span>
			</li>
		</ul>

		<div class="auth__item auth__item--dimmed">

			<? if ($arResult["SHOW_FORM"]) : ?>
				<h2 class="auth__title"><?= GetMessage("AUTH_CHANGE_PASSWORD") ?></h2>
				<form class="form auth__form" method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform">
					<? if ($arResult["BACKURL"] <> '') : ?>
						<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>" />
					<? endif ?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="CHANGE_PWD">



					<div class="form-group">
						<label class="visuallyhidden" for="auth-login">*<?= GetMessage("AUTH_LOGIN") ?></label>
						<input class="form-control" type="text" name="USER_LOGIN" id="auth-login" placeholder="*<?= GetMessage("AUTH_LOGIN") ?>" value="<?= $arResult["LAST_LOGIN"] ?>" required disabled><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
					<div class="form-group">
						<label class="visuallyhidden" for="auth-checkword">*<? echo GetMessage("AUTH_CHECKWORD") ?></label>
						<input class="form-control" type="text" name="USER_CHECKWORD" id="auth-checkword" placeholder="*<?= GetMessage("AUTH_CHECKWORD") ?>" value="<?= $arResult["USER_CHECKWORD"] ?>" required disabled><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>

					<div class="form-group">
						<label class="visuallyhidden" for="auth-pass">*<?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?></label>
						<input class="form-control" type="password" name="USER_PASSWORD" id="auth-pass" placeholder="*<?= GetMessage("AUTH_NEW_PASSWORD_REQ") ?>" autocomplete="new-password" value="<?= $arResult["USER_PASSWORD"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
					<div class="form-group">
						<label class="visuallyhidden" for="auth-pass">*<?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?></label>
						<input class="form-control" type="password" name="USER_CONFIRM_PASSWORD" id="auth-pass" placeholder="*<?= GetMessage("AUTH_NEW_PASSWORD_CONFIRM") ?>" autocomplete="new-password" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>

					<input type="submit" class="btn btn--pink" name="change_pwd" value="<?= GetMessage("AUTH_CHANGE") ?>" />

				</form>

				<p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p>
				<?
				ShowMessage($arParams["~AUTH_RESULT"]);
				?>
				<p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>

			<? endif ?>

			<p><a href="<?= $arResult["AUTH_AUTH_URL"] ?>"><b><?= GetMessage("AUTH_AUTH") ?></b></a></p>

		</div>

	</div>
</div>