<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];

?>

<section class="modal">
	<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Закрыть"></button>
	<div class="modal__content">
		<div class="h2 modal__title">Leave feedback</div>
		<form class="form js-validate modal__form js-edit-exec" action="/local/components/bulldog/feedback_executor_reviews/ajax.php">
			<input type="hidden" name="executor_id" value="<?= $arResult["EXEC_ID"]?>">
			<div class="form-row">
				<div class="form-group form-group--half">
					<label class="visuallyhidden" for="name">Your name</label>
					<input class="form-control" type="text" name="name" id="name" placeholder="Your name" required="required"><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
				</div>
				<div class="form-group form-group--half">
					<label class="visuallyhidden" for="email">Email</label>
					<input class="form-control" type="email" name="email" id="email" placeholder="Email" required="required"><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
				</div>
			</div>
			<div class="form-group">
				<label class="visuallyhidden" for="review-text">The text of the review</label>
				<textarea class="form-control" name="review-text" id="review-text" placeholder="The text of the review" required="required"></textarea><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>

			<div class="form-group form-group--auto form-group--mb2">
				<div class="appraisal">
					<div class="h6 appraisal__name">General evaluation of the service</div>
					<div class="appraisal__controls">
						<input class="visuallyhidden" type="radio" name="appraisal" id="appraisal-5" value="5" required="required">
						<label class="star appraisal__control" for="appraisal-5"><i class="fas fa-star"></i>
						</label>
						<input class="visuallyhidden" type="radio" name="appraisal" id="appraisal-4" value="4" required="required">
						<label class="star appraisal__control" for="appraisal-4"><i class="fas fa-star"></i>
						</label>
						<input class="visuallyhidden" type="radio" name="appraisal" id="appraisal-3" value="3" required="required">
						<label class="star appraisal__control" for="appraisal-3"><i class="fas fa-star"></i>
						</label>
						<input class="visuallyhidden" type="radio" name="appraisal" id="appraisal-2" value="2" required="required">
						<label class="star appraisal__control" for="appraisal-2"><i class="fas fa-star"></i>
						</label>
						<input class="visuallyhidden" type="radio" name="appraisal" id="appraisal-1" value="1" required="required">
						<label class="star appraisal__control" for="appraisal-1"><i class="fas fa-star"></i>
						</label>
					</div>
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

