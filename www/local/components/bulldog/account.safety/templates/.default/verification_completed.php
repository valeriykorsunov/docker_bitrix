<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--in-gray">
	<div class="b-personal-safety">
			<div class="b-personal-safety__message b-personal-safety__message--success"><span class="b-personal-safety__icon"><i class="fa fa-check"></i></span>
				<div class="h6 b-personal-safety__status">Verification is passed!</div>
				<div class="b-personal-safety__text">
					<p>You have passed verification, now users understand that the page is not fake, and the answer from your account is official.</p>
				</div>
			</div>
		<div class="b-personal-safety__files-grid">

			<? if ($arResult["USER"]["UF_DOCUMENT_1"]["PATH"]) : ?>
				<div class="js-personal-file b-personal-file">
					<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_1"]["PATH"] ?>" target="_blank">
						<img src="<?= $arResult["USER"]["UF_DOCUMENT_1"]["RESIZE_SRC"] ?>" alt data-object-fit="cover">
						<span class="icon icon--eye b-personal-file__eye" aria-hidden="true">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-eye" />
							</svg>
						</span>
					</a>
					<div class="b-personal-file__bottom">
						<span class="b-personal-file__name">Scand</span>
						<?/*?>
					<div class="js-delete b-personal-file__delete b-delete">
						<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-ic-trash" />
							</svg>
						</button>
						<div class="dropdown js-delete-dropdown b-delete__dropdown b-delete__dropdown--small b-delete__dropdown--top-center">
							<div class="b-delete__header">Удалить документ "Скан паспорта"?</div>
							<div class="b-delete__actions">
								<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-personal-file" data-url="/">Да</button>
								<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">Нет</button>
							</div>
						</div>
					</div>
					<?*/ ?>
					</div>
				</div>
			<? endif ?>

			<? if ($arResult["USER"]["UF_DOCUMENT_2"]["PATH"]) : ?>
				<div class="js-personal-file b-personal-file">
					<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_2"]["PATH"] ?>" target="_blank">
						<img src="<?= $arResult["USER"]["UF_DOCUMENT_2"]["RESIZE_SRC"] ?>" alt data-object-fit="cover"><span class="icon icon--eye b-personal-file__eye" aria-hidden="true"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-eye" />
							</svg></span>
					</a>
					<div class="b-personal-file__bottom"><span class="b-personal-file__name">TIN</span>
					</div>
				</div>
			<? endif ?>

			<? if ($arResult["USER"]["UF_DOCUMENT_3"]["PATH"]) : ?>
				<div class="js-personal-file b-personal-file">
					<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_3"]["PATH"] ?>" target="_blank">
						<img src="<?= $arResult["USER"]["UF_DOCUMENT_3"]["RESIZE_SRC"] ?>" alt data-object-fit="cover"><span class="icon icon--eye b-personal-file__eye" aria-hidden="true"><svg role="img" width="1em" height="1em">
								<use xlink:href="#si-eye" />
							</svg></span>
					</a>
					<div class="b-personal-file__bottom"><span class="b-personal-file__name">Diploma</span>
					</div>
				</div>
			<? endif ?>
			
		</div>
	</div>
</div>