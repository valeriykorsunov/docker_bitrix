<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];
global $DB;
?>

<div class="personal-area__right personal-area__right--yellow js-add-service">
	<div class="b-add-service">
		<div class="h6 b-add-service__title">Add a service</div>
		<?//js-validate?>
		<form class="js-validate b-add-service__form" method="POST" action=""> 
			<!-- <div class="form-group">
				<label class="visuallyhidden" for="name">Name of the service</label>
				<textarea class="form-control form-control--medium" name="name" id="name" placeholder="Name of the service" required="required"></textarea>
			</div> -->

			<div class="form-group">
				<div class="select-style select-style--white-br">
					<select class="js-select" name="name" data-placeholder="Service">
						<? foreach($arResult["SERVICE_NAME_LIST"] as $value): ?>
							<option value="<?= $value["NAME"]?>" ><?= $value["NAME"]?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
			
			<!-- Тип услуги -->
			<div class="form-group">
				<div class="select-style select-style--white-br">
					<select class="js-select" name="TYPE_SERVICES" data-placeholder="Тип услуги">
						<?foreach($arResult["TYPE_SERVICE"] as $key => $value):?>
							<option value="<?= $key?>"><?= $value?></option>
						<?endforeach?>
					</select>
				</div>
			</div>
			
			<div class="form-group form-group--mb2 form-group--grow-1">
				<label class="visuallyhidden" for="description">Description of the service</label>
				<textarea class="form-control form-control--100" name="description" id="description" placeholder="Description of the service" required="required"></textarea>
			</div>
			<div class="form-group form-group--mb2">
				<div class="form-price">
					<label class="form-label form-price__label" for="price">The cost of the service</label>
					<div class="form-price__wrapper">
						<div class="form-price__input">
							<input type="text" name="price" id="price" required="required"><span>£</span>
						</div>
						<div class="select-style select-style--light form-price__select">
							<select class="js-select" name="price-type" required="required">
								<?foreach($arResult["CALCULATION_PERIOD"] as $key => $value):?>
									<option value="<?= $key?>"><?= $value?></option>
								<?endforeach?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn--dark-purple">Add a service</button>
		</form>
	</div>
</div>
