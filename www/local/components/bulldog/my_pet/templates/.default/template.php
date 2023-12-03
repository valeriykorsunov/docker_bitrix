<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];
global $DB;
?>

	<div class="js-add-pet b-add-pet">
		<button class="btn btn--close btn--circle js-add-pet-toggle b-add-pet__toggle-button"></button>
		<form class="form js-validate b-add-pet__form" action method="POST">
			<input type="hidden" name="EDIT_PET" value="<?= $arResult["EDIT_PET"]?>">
			<input type="hidden" name="PET_ID" value="<?= $arResult["PET"]["ID"] ?>">
			<div class="form-title h5">
				<?if($arResult["EDIT_PET"] == "Y"):?>
					Изменить данные питомца
				<?else:?>
					Add a pet
				<?endif?>
		</div>
			<div class="form-row">
				<div class="form-group form-group--auto">
					<label class="js-avatar-input avatar-field avatar-field--small">
						<div class="responsive-img js-avatar-image avatar-field__image">
							<?if($arResult["PET"]["PREVIEW_PICTURE"]):?>
								<img data-object-fit="cover" src="<?= $arResult["PET"]["PREVIEW_PICTURE"]["SRC"]?>">
							<?endif?>
						</div>
						<input type="hidden" name="IMG_ID" value="<?= $arResult["PET"]["PREVIEW_PICTURE"]["ID"]?>">
						<input class="visuallyhidden" type="file" name="avatar" accept="image/jpeg, image/png" <?if($arResult["EDIT_PET"] !== "Y"):?> required <?endif?>>
						<span class="avatar-field__control"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-photocam" />
							</svg>
						</span>
					</label>
				</div>
				<div class="form-wrapper form-wrapper--ml">
					<div class="form-row">
						<div class="form-group form-group--half">
							<div class="select-style select-style--white-br">
								<label class="visuallyhidden" for="pet-type">Type of pet</label>
								<select class="js-select" name="pet-type" id="pet-type" data-placeholder="Type of pet" required>
									<option></option>
									<?foreach($arResult["PROP"]["TYPE_PET"] as $key => $value):?>
										<option value="<?=$key?>" <?if($arResult["PET"]["TYPE_PET_ID"] == $key):?> selected="selected"<?endif?>><?=$value?></option>
									<?endforeach?>
								</select>
							</div>
						</div>
						<div class="form-group form-group--half">
							<label class="visuallyhidden" for="pet-name">My pet’s name</label>
							<input class="form-control" type="text" name="pet-name" id="pet-name" value="<?= $arResult["PET"]["NAME"]?>" placeholder="My pet’s name" required>
						</div>
					</div>
					<div class="form-group">
						<label class="visuallyhidden" for="pet-breed">The breed of the pet</label>
						<input class="form-control" type="text" name="pet-breed" id="pet-breed" value="<?= $arResult["PET"]["PET_BREED"]?>" placeholder="The breed of the pet" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="visuallyhidden" for="pet-friendly">My pet is good with</label>
				<input class="form-control" type="text" name="pet-friendly" id="pet-friendly" placeholder="My pet is good with" value="<?= $arResult["PET"]["ANIMALS_NEARDY"]?>" required>
			</div>
			<div class="form-row">
				<div class="form-group form-group--third">
					<div class="select-style select-style--white-br">
						<label class="visuallyhidden" for="pet-size">Size</label>
						<select class="js-select" name="pet-size" id="pet-size" data-placeholder="Size" required>
							<option></option>
							<?foreach($arResult["PROP"]["SIZE"] as $key => $value):?>
								<option value="<?=$key?>" <?if($arResult["PET"]["SIZE"] == $key):?> selected="selected" <?endif?>><?=$value?></option>
							<?endforeach?>
						</select>
					</div>
				</div>
				<div class="form-group form-group--third">
					<div class="select-style select-style--white-br">
						<label class="visuallyhidden" for="pet-gender">Gender</label>
						<select class="js-select" name="pet-gender" id="pet-gender" data-placeholder="Gender" required>
							<option></option>
							<?foreach($arResult["PROP"]["GENDER"] as $key => $value):?>
								<option value="<?=$key?>" <?if($arResult["PET"]["GENDER"] == $key)?> selected="selected"><?=$value?></option>
							<?endforeach?>
						</select>
					</div>
				</div>
				<div class="form-group form-group--third">
                  <label class="visuallyhidden" for="date">Date of birth</label>
                  <input class="form-control form-control--calendar js-birthday-calendar" type="text" name="pet-date" id="date" placeholder="Date of birth" autocomplete="off" readonly required data-position="top right" data-language="en"
                  data-my-date="<?= $arResult["PET"]["BIRTHDAY"]?>" value="<?= $arResult["PET"]["BIRTHDAY"]?>">
                </div>
			</div>
			<div class="form-group form-group--grow-1">
				<label class="visuallyhidden" for="pet-features">Features of the pet</label>
				<textarea class="form-control form-control--medium form-control--100" name="pet-features" id="pet-features" placeholder="Features of the pet"><?= $arResult["PET"]["PET_FEATURES"]?></textarea>
			</div>
			<div class="form-row form-row--wrap">
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-1" <?if($arResult["PET"]["SPAY_NEUT"]):?> checked <?endif?>>
						<i class="ui-checkbox__icon">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg>
						</i>
						<span class="ui-checkbox__text">Sterilized / neutered</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-2" <?if($arResult["PET"]["STAY_HOME_ALONE"]):?> checked <?endif?>>
						<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">My pet can stay alone at home</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-3" <?if($arResult["PET"]["FREND_ANIMALS"]):?> checked <?endif?>>
						<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Friendly to other animals</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-4" <?if($arResult["PET"]["VACCINATED"]):?> checked <?endif?>>
						<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Has the necessary vaccinations</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-5" <?if($arResult["PET"]["FRIEND_CHILDREN_10"]):?> checked <?endif?>>
						<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Friendly to children under 10 years old</span>
					</label>
				</div>
			</div>
			<button class="btn btn--yellow">
				<?if($arResult["EDIT_PET"] == "Y"):?>
					Save
				<?else:?>
					Add
				<?endif?>
			</button>
		</form>
	</div>
</div>