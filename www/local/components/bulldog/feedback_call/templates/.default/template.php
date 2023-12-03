<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];

?>
<section class="call modal">
	<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Закрыть"></button>
	<div class="modal__content">
		<div class="h2 modal__title">
			<svg class="modal__icon" role="img" width="1em" height="1em">
				<use xlink:href="#si-phone" />
			</svg>Request a call
		</div>
		<form class="form js-validate modal__form" action method="POST">
			<input type="hidden" name="PARAM_MESSAGE_ID" value="<?= $arParams["MESSAGE_ID"]?>"]>
			<input type="hidden" name="feedback_call" value="Y"]>
			<div class="form-group">
				<label class="visuallyhidden" for="name">Your name</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="Your name" required="required"><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group">
				<label class="visuallyhidden" for="phone">Phone number</label>
				<input class="form-control js-tel" type="tel" name="phone" id="phone" placeholder="Phone number" required="required"><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group">
				<div class="select-style select-style--white-br">
					<select class="js-select" name="time">
						<option value="Call back as soon as possible">Call back as soon as possible</option>
						<option value="Call back even faster">Call back even faster</option>
						<option value="Перезвонить">Call back</option>
					</select>
				</div>
			</div>
			<div class="form-group form-group--mb2 form-group--auto">
				<label class="ui-checkbox">
					<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="personal" required="required"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
							<use xlink:href="#si-icon-check" />
						</svg></i><span class="ui-checkbox__text">Consent to personal data processing</span>
				</label>
			</div>
			<button class="btn btn--yellow btn--small modal__button">Send</button>
		</form>
	</div>
</section>