<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];

?>

<section class="modal">
	<button class="btn btn--circle btn--close mfp-close" type="button" aria-label="Close"></button>
	<div class="modal__content">
		<div class="h2 modal__title">Leave feedback</div>
		<form class="form js-validate modal__form" action="">
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
			<div class="form-group form-group--mb2">
				<div class="js-file-input file-input file-input--flex" data-max="3">
					<div class="file-input__wrapper">
						<div class="js-file-input-list file-input__list">
							<div class="hidden js-file-input-dropdown file-input__dropdown">
								<button class="js-file-input-dropdown-button file-input__dropdown-button file-input__dropdown-button--white" type="button"><span class="js-file-input-dropdown-value file-input__dropdown-value">+3</span>
								</button>
								<div class="file-input__dropdown-content">
									<div class="file-input__dropdown-header">Your photos</div>
									<div class="js-file-input-dropdown-list file-input__list"></div>
								</div>
							</div>
						</div>
						<label class="file-input__control">
							<input class="js-file-input-control" type="file" name="files[]" accept="image/jpeg, image/png, video/mp4" multiple="multiple"><span class="fas fa-plus file-input__add"></span>
						</label>
					</div>
					<div class="file-input__description">
						<p>Download the photo so that the review is more complete.Add the photo separately or just drag everything to the gray area on the left.</p>
					</div>
				</div>
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
