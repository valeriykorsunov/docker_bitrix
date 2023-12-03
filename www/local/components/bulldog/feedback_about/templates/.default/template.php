<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];
?>

<div class="b-contacts__bottom-left">
	<h3 class="h2">Write to us</h3>
	<form class="js-validate" action>
		<div class="form-row">
			<div class="form-group form-group--half">
				<label class="visuallyhidden" for="name">What is your name</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="What is your name" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group form-group--half">
				<label class="visuallyhidden" for="city">Your city</label>
				<input class="form-control" type="text" name="city" id="city" placeholder="Your city" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group form-group--half">
				<label class="visuallyhidden" for="phone">Phone number</label>
				<input class="form-control js-tel" type="tel" name="phone" id="phone" placeholder="Phone number" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group form-group--half">
				<label class="visuallyhidden" for="email">Email</label>
				<input class="form-control" type="email" name="email" id="email" placeholder="Email">
			</div>
		</div>
		<div class="form-group form-group--mb2">
			<label class="visuallyhidden" for="message">Message text</label>
			<textarea class="form-control" name="message" placeholder="Message text" required></textarea><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
		</div>
		<div class="b-contacts__form-actions">
			<button class="btn btn--pink btn--small">Send</button>
		</div>
	</form>
</div>