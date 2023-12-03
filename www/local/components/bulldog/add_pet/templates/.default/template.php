<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];

?>
<div class="personal-area__right">
	<div class="js-add-pet b-add-pet">
		<button class="btn btn--close btn--circle js-add-pet-toggle b-add-pet__toggle-button"></button>
		<form class="form js-validate b-add-pet__form" action method="POST">
			<div class="form-title h5">Добавить питомца</div>
			<div class="form-row">
				<div class="form-group form-group--auto">
					<label class="js-avatar-input avatar-field avatar-field--small">
						<div class="responsive-img js-avatar-image avatar-field__image"></div>
						<input class="visuallyhidden" type="file" name="avatar" accept="image/jpeg, image/png" required><span class="avatar-field__control"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-photocam" />
							</svg></span>
					</label>
				</div>
				<div class="form-wrapper form-wrapper--ml">
					<div class="form-row">
						<div class="form-group form-group--half">
							<div class="select-style select-style--white-br">
								<label class="visuallyhidden" for="pet-type">Тип питомца</label>
								<select class="js-select" name="pet-type" id="pet-type" data-placeholder="Тип питомца" required>
									<option></option>
									<option value="1">Собака</option>
									<option value="2">Кошка</option>
								</select>
							</div>
						</div>
						<div class="form-group form-group--half">
							<label class="visuallyhidden" for="pet-name">Кличка питомца</label>
							<input class="form-control" type="text" name="pet-name" id="pet-name" placeholder="Кличка питомца" required>
						</div>
					</div>
					<div class="form-group">
						<label class="visuallyhidden" for="pet-breed">Порода питомца</label>
						<input class="form-control" type="text" name="pet-breed" id="pet-breed" placeholder="Порода питомца" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="visuallyhidden" for="pet-friendly">Животные, которые могут находится
					вместе с ним</label>
				<input class="form-control" type="text" name="pet-friendly" id="pet-friendly" placeholder="Животные, которые могут находится вместе с ним" required>
			</div>
			<div class="form-row">
				<div class="form-group form-group--third">
					<div class="select-style select-style--white-br">
						<label class="visuallyhidden" for="pet-size">Размер</label>
						<select class="js-select" name="pet-size" id="pet-size" data-placeholder="Размер" required>
							<option></option>
							<option value="1">Маленький</option>
							<option value="2">Средний</option>
							<option value="3">Большой</option>
						</select>
					</div>
				</div>
				<div class="form-group form-group--third">
					<div class="select-style select-style--white-br">
						<label class="visuallyhidden" for="pet-gender">Пол</label>
						<select class="js-select" name="pet-gender" id="pet-gender" data-placeholder="Пол" required>
							<option></option>
							<option value="1">Муж</option>
							<option value="2">Жен</option>
						</select>
					</div>
				</div>
				<div class="form-group form-group--third">
                  <label class="visuallyhidden" for="date">Дата рождения</label>
                  <input class="form-control form-control--calendar js-birthday-calendar" type="text" name="pet-date" id="date" placeholder="Дата рождения" autocomplete="off" readonly required data-position="top right" data-language="ru"
                  data-my-date="2020-11-07">
                </div>
			</div>
			<div class="form-group form-group--grow-1">
				<label class="visuallyhidden" for="pet-features">Особенности питомца</label>
				<textarea class="form-control form-control--medium form-control--100" name="pet-features" id="pet-features" placeholder="Особенности питомца"></textarea>
			</div>
			<div class="form-row form-row--wrap">
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-1"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Стерилизован/кастрирован</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-2"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Остается ли питомец один
							дома</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-3"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Дружелюбен к другим
							животным</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-4"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Имеет необходимые
							вакцинации</span>
					</label>
				</div>
				<div class="form-group form-group--half">
					<label class="ui-checkbox">
						<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="pet-special-5"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-icon-check" />
							</svg></i><span class="ui-checkbox__text">Дружелюбен к детям до 10
							лет</span>
					</label>
				</div>
			</div>
			<button class="btn btn--yellow">Добавить питомца</button>
		</form>
	</div>
</div>