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

$personalPhotoPath = UserInfo::getUserPhoto();
if(!$personalPhotoPath)
{
	$personalPhotoPath = "/local/templates/main/img/theme/logo.svg";
}
?>

<div class="b-personal-data__item b-personal-data__item--dimmed b-personal-data__item--h-100">
	<form class="form" method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
		
		<!-- foto -->
		<div class="form-group form-group--mb2 form-group--center">
			<label class="js-avatar-input avatar-field">
				<div class="responsive-img js-avatar-image avatar-field__image">
					<img src="<?= $personalPhotoPath?>" alt data-object-fit="cover">
				</div>
				<input class="visuallyhidden" type="file" name="PERSONAL_PHOTO" accept="image/jpeg, image/png" ><span class="avatar-field__control"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-photocam" />
					</svg></span>
			</label>
		</div>

		<div class="form-group">
			<label class="visuallyhidden" for="name">Name</label>
			<input class="form-control" type="text" name="NAME" id="name" placeholder="Name" 
				value="<?= $arResult["arUser"]["NAME"] ?>" required>
			<span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="form-group">
			<label class="visuallyhidden" for="name">Last name</label>
			<input class="form-control" type="text" name="LAST_NAME" id="name" placeholder="Last name" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="form-group">
			<label class="visuallyhidden" for="email">e-mail</label>
			<input class="form-control" type="email" name="EMAIL" id="email" placeholder="e-mail" value="<? echo $arResult["arUser"]["EMAIL"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="form-group">
			<label class="visuallyhidden" for="date">Date of birth</label>
			
			<input class="form-control form-control--calendar js-birthday-calendar" type="text" name="PERSONAL_BIRTHDAY" id="date" placeholder="Date of birth" autocomplete="off" readonly required data-position="top left" data-language="ru" data-my-date="<? echo $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>" value="<? echo $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>">
		</div>
		<div class="form-group">
			<label class="visuallyhidden" for="phone">Phone number</label>
			<input class="form-control js-tel" type="tel" name="PERSONAL_MOBILE" id="phone" placeholder="Phone number" value="<? echo $arResult["arUser"]["PERSONAL_MOBILE"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<input class="btn btn--clear" type="submit" name="save" value="Save changes">
	</form>
</div>
