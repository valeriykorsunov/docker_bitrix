<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$idForm = $arParams["ID_FORM"];

?>
<div class="faq__right">
	<div class="faq__form b-faq-form" id="faq-form">
		<div class="b-faq-form__title">Ask a question</div>
		
		<form class="form js-validate" id="<?= $idForm ?>" action="">
			<input type="hidden" name="check" value="" id="check" />
			<input type="hidden" name="PARAM_MESSAGE_ID" value="<?= $arParams["MESSAGE_ID"] ?>">
			<div class="form-group">
				<label class="visuallyhidden" for="name">Your name</label>
				<input class="form-control" type="text" name="user_name" id="name" placeholder="Your name" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group">
				<label class="visuallyhidden" for="email">e-mail</label>
				<input class="form-control" type="email" name="user_email" id="email" placeholder="e-mail" required><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-group form-group--mb2">
				<label class="visuallyhidden" for="question">Question text</label>
				<textarea class="form-control" name="message" id="question" placeholder="Question text" required></textarea><span class="form-error-icon"><i class="fas fa-exclamation-circle"></i></span>
			</div>
			<div class="form-agreements">
				<label class="ui-checkbox ui-checkbox--white">
					<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="personal" required="required" ><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
							<use xlink:href="#si-icon-check" />
						</svg></i><span class="ui-checkbox__text">I am agree to share my personal data.</span>
				</label>
			</div>
			<button class="btn btn--yellow btn--small faq__button">Send</button>
		</form>
		
		<span class="decor b-faq-form__heart">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-heart" />
			</svg></span><span class="decor b-faq-form__cube">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-cube-2" />
			</svg>
		</span>
	</div>

	<div class="responsive-img faq__image">
		<img src="<?=SITE_TEMPLATE_PATH?>/img/media/faq.png" alt data-object-fit="contain">
		<span class="decor faq__triangle"><svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-triangle" />
			</svg>
		</span>
		<span class="decor faq__question">
			<svg role="img" width="1em" height="1em">
				<use xlink:href="#si-decor-question-right" />
			</svg>
		</span>
	</div>
</div>