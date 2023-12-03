`<?

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
if (!$personalPhotoPath)
{
	$personalPhotoPath = "/local/templates/main/img/theme/logo.svg";
}


?>

<div class="personal-area__content">
	<form method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
		<?= $arResult["BX_SESSION_CHECK"] ?>
		<input type="hidden" name="lang" value="<?= LANG ?>" />
		<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
		<div class="personal-area__grid">

			<div class="personal-area__left">
				<h1 class="h5 personal-area__title">My Page</h1>
				<div class="js-scroll-block personal-area__scroll-block">
					<div class="b-personal-data b-personal-data--h-100">
						<div class="b-personal-data__item b-personal-data__item--hollow b-personal-data__item--flex">
							<div class="b-personal-data__ad-form" action>
								<div class="form-group">
									<label class="visuallyhidden" for="ad-title">Headline</label>
									<textarea class="form-control form-control--dimmed form-control--medium" name="UF_HEADLINE" id="ad-title" placeholder="Headline"><?= $arResult["arUser"]["UF_HEADLINE"] ?></textarea>
								</div>

								<div class="form-group form-group--mb0 form-group--grow-1">
									<label class="visuallyhidden" for="ad-text">Announcement text</label>
									<textarea class="form-control form-control--dimmed form-control--100" name="UF_ANNOUNCEMENT_TEXT" id="ad-text" placeholder="Announcement text"><?= $arResult["arUser"]["UF_ANNOUNCEMENT_TEXT"] ?></textarea>
								</div>
							</div>
							<div class="b-personal-data__executor-address">
								<div class="form-group">
									<input name="UF_ADDRESS" value="<?= $arResult["arUser"]["UF_ADDRESS"] ?>" class="form-control form-control--dimmed form-control--address" type="text" placeholder="Residence address">
								</div>
								<div class="b-personal-data__executor-map"></div>
							</div>
						</div>
						<div class="b-personal-data__wrapper">

							<? if ($arResult["img"]) : ?>
								<div class="file-input file-input--big">
									<div class="file-input__list">
										<? foreach ($arResult["img"] as $val) : ?>
											<div class="file-input__item responsive-img js-img-block" data-index="0" style="overflow:visible;">
												<img src="<?= $val["PREVIEW_PICTURE_PATH"] ?>" alt="" data-idpic="<?= $val["ID"] ?>">
												<div class="js-delete b-delete">
													<a class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle" >
														<svg role="img" width="1em" height="1em">
															<use xlink:href="#si-ic-trash" />
														</svg>
													</a>
													<div class="dropdown js-delete-dropdown b-delete__dropdown">
														<div class="b-delete__header">Delete a service "<?= $arItem["NAME"] ?>"?</div>
														<div class="b-delete__actions">
															<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" 
													
															data-class-element="js-img-block" data-url="/local/php_interface/ajax/main.profile.php?id=<?= $val["ID"] ?>&delete-user-img=y">Yes</button>
															<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">No</button>
														</div>
													</div>
												</div>
												<!-- <a onclick="deleteUserPic(this);" class="btn btn--dimmed btn--circle-small b-delete__toggle" style="position: absolute; top: 0; right:0;" href="/local/templates/main/ajax/confirm.html">
														<svg role="img" width="1em" height="1em">
															<use xlink:href="#si-ic-trash" />
														</svg>
													</a> -->
											</div>
										<? endforeach ?>
									</div>
								</div>
							<? endif ?>
							<div class="b-personal-data__file-form" action>
								<div class="js-file-input file-input file-input--big" data-max="4">
									<div class="file-input__wrapper">
										<div class="js-file-input-list file-input__list">
											<div class="hidden js-file-input-dropdown file-input__dropdown">
												<button class="js-file-input-dropdown-button file-input__dropdown-button" type="button"><span class="js-file-input-dropdown-value file-input__dropdown-value">+3</span>
												</button>
												<div class="file-input__dropdown-content file-input__dropdown-content--in-scroll">
													<div class="file-input__dropdown-header">Your photo</div>
													<div class="js-file-input-dropdown-list file-input__list">
													</div>
												</div>
											</div>
										</div>
										<label class="file-input__control">
											<input class="js-file-input-control" type="file" name="PHOTOS[]" accept="image/jpeg, image/png, video/mp4" multiple="multiple"><span class="fas fa-plus file-input__add"></span>
										</label>
									</div>
									<div class="file-input__description">
										<p class="file-input__types">Jpeg, Png, Gif</p>
									</div>
								</div>
							</div>

							<!-- красный блок -->
							<div class="b-personal-data__item b-personal-data__item--pink b-personal-data__item--addit-info" action>
								<div class="form-group">
									<label for="UF_DOGSIT_EXPERIENCE">Experience of pet care</label>
									<input class="form-control form-control--calendar js-birthday-calendar" type="text" name="UF_DOGSIT_EXPERIENCE" placeholder="Experience of pet care" value="<? echo $arResult["arUser"]["UF_DOGSIT_EXPERIENCE"] ?>" data-my-date="<? echo $arResult["arUser"]["UF_DOGSIT_EXPERIENCE"] ?>" id="date" autocomplete="off" readonly data-position="top left" data-language="en">

								</div>
								<div class="form-group">
									<label for="UF_HOUSING_AREA">Housing area</label>
									<input class="form-control" type="number" min="1" name="UF_HOUSING_AREA" placeholder="Housing area" value="<?= $arResult["arUser"]["UF_HOUSING_AREA"] ?>">
								</div>
								<div class="form-group">
									<label for="UF_UF_TYPE_HOUSING">Type of housing</label>
									<div class="select-style select-style--white-br">
										<select class="js-select" name="UF_UF_TYPE_HOUSING" data-placeholder="Type of housing">
											<option value=""></option>

											<?// \Bitrix\Main\Diag\Debug::dumpToFile( $arResult["USER_PROPERTIES"]["DATA"]["UF_UF_TYPE_HOUSING"],'*'.date('Y-m-d H:i:s').'*'. PHP_EOL . __FILE__); ?>

											<? foreach ($arResult["USER_PROPERTIES"]["DATA"]["UF_UF_TYPE_HOUSING"]["FIELDS"] as $key => $val) : ?>
												<option value="<?= $key ?>" <? if ($arResult["arUser"]["UF_UF_TYPE_HOUSING"] == $key) echo "selected"; ?>><?= $val ?></option>
											<? endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="UF_TYPE_PETS">Type of pets: </label>
									<input type="hidden" name="UF_TYPE_PETS[]" value="">

									<? foreach ($arResult["USER_PROPERTIES"]["DATA"]["UF_TYPE_PETS"]["FIELDS"] as $key => $val) : ?>
										<label class="ui-checkbox">
											<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="UF_TYPE_PETS[]" value="<?= $key ?>" <? if (in_array($key, $arResult["arUser"]["UF_TYPE_PETS"]?: [])) echo "checked"; ?>>
											<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
													<use xlink:href="#si-icon-check" />
												</svg></i>
											<span class="ui-checkbox__text"><?= explode(" [", $val )[0]; ?></span>
										</label>
									<? endforeach ?>
								</div>
								<div class="form-group">
									<label class="visuallyhidden" for="ad-title">List of breeds</label>
									<textarea class="form-control form-control--dimmed form-control--medium" name="UF_LIST_BREEDS" placeholder="List of breeds"><?= $arResult["arUser"]["UF_LIST_BREEDS"] ?></textarea>
								</div>
								<div class="form-group">
									<input class="fields boolean" type="hidden" value="0" name="UF_CHILD_10">
									<label class="ui-checkbox">
										<input class="visuallyhidden ui-checkbox__input" type="checkbox" value="1" name="UF_CHILD_10" <? if ($arResult["arUser"]["UF_CHILD_10"] == "1") echo "checked"; ?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i>
										<span class="ui-checkbox__text">Are there any children under 10 years old</span>
									</label>
								</div>
								<div class="form-group">
									<input class="fields boolean" type="hidden" value="0" name="UF_PERMANENT_NOTE">
									<label class="ui-checkbox">
										<input class="visuallyhidden ui-checkbox__input" type="checkbox" value="1" name="UF_PERMANENT_NOTE" <? if ($arResult["arUser"]["UF_PERMANENT_NOTE"] == "1") echo "checked"; ?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i>
										<span class="ui-checkbox__text">The pet will be supervised 24 hours a day</span>
									</label>
								</div>
								<div class="form-group">
									<input class="fields boolean" type="hidden" value="0" name="UF_PERSONAL_TRANSPORT">
									<label class="ui-checkbox">
										<input class="visuallyhidden ui-checkbox__input" type="checkbox" value="1" name="UF_PERSONAL_TRANSPORT" <? if ($arResult["arUser"]["UF_PERSONAL_TRANSPORT"] == "1") echo "checked"; ?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i>
										<span class="ui-checkbox__text">Availability of transport</span>
									</label>
								</div>
								<div class="form-group">
									<input class="fields boolean" type="hidden" value="0" name="UF_NON_SMOKERS">
									<label class="ui-checkbox">
										<input class="visuallyhidden ui-checkbox__input" type="checkbox" value="1" name="UF_NON_SMOKERS" <? if ($arResult["arUser"]["UF_NON_SMOKERS"] == "1") echo "checked"; ?>>
										<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
												<use xlink:href="#si-icon-check" />
											</svg></i>
										<span class="ui-checkbox__text">Non-smokers in the house</span>
									</label>
								</div>

								<!-- <?// $necessarily_service = \Bitrix\Main\Config\Option::get("askaron.settings", "UF_OBLIGATORILY_SER"); ?>
								<div class="form-group <?// if (count($necessarily_service) < 2) echo "visually-hidden"; ?>">
									<label for="UF_MAIN_SERVICE">Основная услуга</label>
									<div class="select-style select-style--white-br">
										<select class="js-select" name="UF_MAIN_SERVICE" data-placeholder="Основная услуга">
											<option value=""></option>
											<? //if (count($necessarily_service) == 1 || $arResult["arUser"]["UF_MAIN_SERVICE"] == "") $deff = $necessarily_service[0]; ?>
											<?// foreach ($necessarily_service as $key => $val) : ?>
												<option value="<?//= $val ?>" <?// if ($arResult["arUser"]["UF_MAIN_SERVICE"] == $val || $deff == $val) echo "selected"; ?>><?//= $val ?></option>
											<?// endforeach ?>
										</select>
									</div>
								</div> -->

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="personal-area__right personal-area__right--dimmed">
				<div class="b-executor-data">
					<div class="form js-validate" action>
						<!-- foto -->
						<div class="form-group form-group--mb2 form-group--center">
							<label class="js-avatar-input avatar-field">
								<div class="responsive-img js-avatar-image avatar-field__image">
									<img src="<?= $personalPhotoPath ?>" alt data-object-fit="cover">
								</div>
								<input class="visuallyhidden" type="file" name="PERSONAL_PHOTO" accept="image/jpeg, image/png"><span class="avatar-field__control"> <svg role="img" width="1em" height="1em">
										<use xlink:href="#si-photocam" />
									</svg></span>
							</label>
						</div>
						<div class="form-group">
							<label class="visuallyhidden" for="name">Name</label>
							<input class="form-control" type="text" name="NAME" id="name" placeholder="Name" value="<?= $arResult["arUser"]["NAME"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
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
							<input class="form-control form-control--calendar js-birthday-calendar" type="text" name="PERSONAL_BIRTHDAY" id="date" placeholder="Date of birth" autocomplete="off" readonly required data-position="top left" data-language="en" data-my-date="<? echo $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>" value="<? echo $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>">
						</div>
						<div class="form-group">
							<label class="visuallyhidden" for="phone">Phone number</label>
							<input class="form-control js-tel" type="tel" name="PERSONAL_MOBILE" id="phone" placeholder="Phone number" value="<? echo $arResult["arUser"]["PERSONAL_MOBILE"] ?>" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
						</div>
						<input class="btn btn--clear" type="submit" name="save" value="Save changes">

						<a href="/account/safety/" class="btn btn--pink btn--long btn--with-margin">Change password</a>
					</div>
				</div>
			</div>

		</div>
	</form>
</div>`