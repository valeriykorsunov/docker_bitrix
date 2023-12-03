<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<section class="mfp-hide modal" id="profile-modal">
	<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Закрыть"></button>
	<div class="modal__content">
		<div class="h2 modal__title modal__title--small-mb">Contact dogsitter</div>
		<div class="modal__subtitle">Writing a letter <span class="modal__name"><? echo $arResult["NAME"] . ' ' . $arResult["LAST_NAME"] ?></span>
		</div>
		<form class="js-validate modal__form" action="/local/php_interface/ajax/new_order.php">
			<input type="hidden" name="executorID" value="<?= $arResult["ID"] ?>">
			<input type="hidden" name="customerID" value="<?= $USER->GetID() ?>">
			<input type="hidden" name="check" value="">

			<div class="form-group form-group--medium">
				<div class="select-style select-style--white-br">
					<select class="js-select" name="service" data-placeholder="Выберите услугу догситтера" required>
						<option></option>
						<? foreach ($arResult["fullPriceList"] as $item) : ?>
							<option value="<?= $item["ID"] ?>"><?= $item["NAME"] ?> </option>
						<? endforeach ?>
					</select>
				</div>
			</div>
			<div class="js-tabs b-tabs b-tabs--form">
				<ul class="b-tabs__navigation">
					<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#form-tab1">Dates</a>
					</li>
					<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#form-tab2">Pets</a>
					</li>
				</ul>
				<div class="b-tabs__progress-line"><span class="js-tabs-thumb b-tabs__thumb"></span>
				</div>
				<div class="js-tabs-content b-tabs__content" id="form-tab1">
					<div class="form-group form-group--medium form-group--mb2">
						<div class="js-calendar b-calendar">
							<label class="form-label">Overexposure dates</label>
							<div class="b-calendar__row">
								<div class="form-group b-calendar__field">
									<label class="visuallyhidden" for="start-date-modal">Start</label>
									<input class="form-control js-start-date" type="text" name="start-date" id="start-date-modal" readonly required>
								</div>
								<div class="form-group b-calendar__field">
									<label class="visuallyhidden" for="end-date-modal">End</label>
									<input class="form-control js-end-date" type="text" name="end-date" id="end-date-modal" readonly required>
								</div>
							</div>
							<div class="js-datepicker b-calendar__datepicker" data-language="ru"></div>
						</div>
					</div>
					<!-- <div class="modal__actions"><a class="btn btn--yellow js-next-tab" href="javascript:void(0)">Next step</a>
					</div> -->
				</div>
				<div class="js-tabs-content b-tabs__content" id="form-tab2">
					<div class="form-group form-group--mb2">
						<select class="js-select" name="pets" data-placeholder="Choose a pet" required>
							<option></option>
							<? foreach ($arResult["ACTIVE_USER_PETS"] as $item) : ?>
								<option value="<?= $item["ID"] ?>"><?= $item["NAME"] ?> </option>
							<? endforeach ?>
						</select>
					</div>

					<!-- <div class="form-row">
						<div class="form-group form-group--half">
							<label class="visuallyhidden" for="name-1">Кличка питомца</label>
							<input class="form-control" type="text" name="name-1" id="name-1" placeholder="Кличка питомца" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
						</div>
						<div class="form-group form-group--half">
							<label class="visuallyhidden" for="breed-1">Порода</label>
							<input class="form-control" type="text" name="breed-1" id="breed-1" placeholder="Порода" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
						</div>
					</div> -->

					<div class="form-group form-group--mb2">
						<label class="visuallyhidden" for="message">Message text</label>
						<textarea class="form-control form-control--big" name="message" id="message" placeholder="Message text"></textarea><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
					</div>
					<div class="modal__actions">
						<button class="btn btn--pink">Send</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>