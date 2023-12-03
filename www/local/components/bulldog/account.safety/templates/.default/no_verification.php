<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>


<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--in-gray">
	<div class="b-personal-safety">
		<div class="b-personal-safety__message b-personal-safety__message--error"><span class="b-personal-safety__icon"><i>!</i></span>
			<div class="h6 b-personal-safety__status">Verification is not passed!</div>
			<div class="b-personal-safety__text">
				<p>The verification sign makes users understand that the page is not fake, but
The answer from such an account is official.</p>
			</div>
		</div>
		<div class="b-personal-safety__files-grid">

			<div class="b-personal-file-form <? if($arResult["USER"]["UF_DOCUMENT_1"]["PATH"]) echo"visually-hidden";?>  addDoc-1">
				<form class="b-personal-file-form__form" action>
					<div class="file-input file-input--single">
						<label class="file-input__control">
							<input data-propertyName="UF_DOCUMENT_1"  onchange='addDoc("1");' class="js-file-input-control" type="file" name="DOCUMENT" accept="application/image" multiple required><span class="fas fa-plus file-input__add"></span>
						</label>
					</div>
				</form>
				<p class="b-personal-file-form__text">Download the document, document 1</p>
			</div>
			<div class="js-personal-file b-personal-file <? if(!$arResult["USER"]["UF_DOCUMENT_1"]["PATH"]) echo"visually-hidden";?> editDoc-1" >
				<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_1"]["PATH"] ?>" target="_blank">
					<img src="<?= $arResult["USER"]["UF_DOCUMENT_1"]["RESIZE_SRC"] ?>" alt data-object-fit="cover"><span class="icon icon--eye b-personal-file__eye" aria-hidden="true"><svg role="img" width="1em" height="1em">
							<use xlink:href="#si-eye" />
						</svg></span>
				</a>
				<div class="b-personal-file__bottom">
					<span class="b-personal-file__name">Document 1</span>
					<div class="js-delete b-personal-file__delete b-delete">
						<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-ic-trash" />
							</svg>
						</button>
						<div class="dropdown js-delete-dropdown b-delete__dropdown b-delete__dropdown--small b-delete__dropdown--top-center">
							<div class="b-delete__header">Delete the document "Diploma"?</div>
							<div class="b-delete__actions">
								<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-personal-file" data-url="/">Yes</button>
								<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">Not</button>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="b-personal-file-form <? if($arResult["USER"]["UF_DOCUMENT_2"]["PATH"]) echo"visually-hidden";?> addDoc-2" >
				<form class="b-personal-file-form__form" action>
					<div class="file-input file-input--single">
						<label class="file-input__control">
							<input data-propertyName="UF_DOCUMENT_2"  onchange='addDoc("2");' class="js-file-input-control" type="file" name="DOCUMENT" accept="application/image" multiple required><span class="fas fa-plus file-input__add"></span>
						</label>
					</div>
				</form>
				<p class="b-personal-file-form__text">Download the document, document2</p>
			</div>
			<div class="js-personal-file b-personal-file <? if(!$arResult["USER"]["UF_DOCUMENT_2"]["PATH"]) echo"visually-hidden";?> editDoc-2" >
				<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_2"]["PATH"] ?>" target="_blank">
					<img src="<?= $arResult["USER"]["UF_DOCUMENT_2"]["RESIZE_SRC"] ?>" alt data-object-fit="cover"><span class="icon icon--eye b-personal-file__eye" aria-hidden="true"><svg role="img" width="1em" height="1em">
							<use xlink:href="#si-eye" />
						</svg></span>
				</a>
				<div class="b-personal-file__bottom">
					<span class="b-personal-file__name">Document 2</span>
					<div class="js-delete b-personal-file__delete b-delete">
						<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-ic-trash" />
							</svg>
						</button>
						<div class="dropdown js-delete-dropdown b-delete__dropdown b-delete__dropdown--small b-delete__dropdown--top-center">
							<div class="b-delete__header">Delete the document "Diploma"?</div>
							<div class="b-delete__actions">
								<button class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-personal-file" data-url="/">Yes</button>
								<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">Not</button>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="b-personal-file-form <? if($arResult["USER"]["UF_DOCUMENT_3"]["PATH"]) echo"visually-hidden";?> addDoc-3">
				<form class="b-personal-file-form__form" action >
					<div class="file-input file-input--single">
						<label class="file-input__control">
							<input data-propertyName="UF_DOCUMENT_3" onchange='addDoc("3");' class="js-file-input-control" type="file" name="DOCUMENT" accept="application/image" multiple required><span class="fas fa-plus file-input__add"></span>
						</label>
					</div>
				</form>
				<p class="b-personal-file-form__text">Download the document, document 3</p>
			</div>
			<div class="js-personal-file b-personal-file <? if(!$arResult["USER"]["UF_DOCUMENT_3"]["PATH"]) echo"visually-hidden";?> editDoc-3">
				<a class="responsive-img b-personal-file__image" href="<?= $arResult["USER"]["UF_DOCUMENT_3"]["PATH"] ?>" target="_blank">
					<img src="<?= $arResult["USER"]["UF_DOCUMENT_3"]["RESIZE_SRC"] ?>" alt data-object-fit="cover"><span class="icon icon--eye b-personal-file__eye" aria-hidden="true"><svg role="img" width="1em" height="1em">
							<use xlink:href="#si-eye" />
						</svg></span>
				</a>
				<div class="b-personal-file__bottom">
					<span class="b-personal-file__name">Document 3</span>
					<div class="js-delete b-personal-file__delete b-delete">
						<button class="btn btn--dimmed btn--circle-small js-delete-toggle b-delete__toggle">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-ic-trash" />
							</svg>
						</button>
						<div class="dropdown js-delete-dropdown b-delete__dropdown b-delete__dropdown--small b-delete__dropdown--top-center">
							<div class="b-delete__header">Delete the document "Diploma"?</div>
							<div class="b-delete__actions">
								<button data-idBlock="3" class="btn btn--clear js-delete-yes b-delete__button b-delete__button--yes" data-class-element="js-personal-file" data-url='?deletFileID=UF_DOCUMENT_3&ID=<?=$arResult["USER"]["UF_DOCUMENT_3_ID"]?>'>Yes</button>
								<button class="btn btn--clear js-delete-no b-delete__button b-delete__button--no">Not</button>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
