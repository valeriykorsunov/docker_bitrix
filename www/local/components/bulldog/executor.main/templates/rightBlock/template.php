<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<!-- 1-й блок -->
<div class="profile__item">
	<div class="profile__sub-item">
		<div class="swiper-container js-profile-slider js-gallery profile__slider b-profile-slider">
			<button class="btn btn--slider js-profile-prev b-profile-slider__button b-profile-slider__button--prev" aria-label="previous slide">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-arrow-right" />
				</svg>
			</button>
			<div class="swiper-wrapper">
				<? foreach ($arResult["USER_GALLERY"] as $img) : ?>
					<div class="swiper-slide b-profile-slider__slide">
						<a class="responsive-img b-profile-slider__image" href="<?= $img["PHOTO_PATH"] ?>" data-type="iframe">
							<img src="<?= $img["PHOTO"] ?>" alt data-object-fit="cover">
							<span class="icon icon--medium icon--eye b-profile-slider__icon" aria-hidden="true">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-eye" />
								</svg>
							</span>
						</a>
					</div>
				<? endforeach ?>
			</div>
			<button class="btn btn--slider js-profile-next b-profile-slider__button b-profile-slider__button--next" aria-label="next slide">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-arrow-right" />
				</svg>
			</button>
		</div>
		<div class="content-style">
			<p><?= $arResult["UF_ANNOUNCEMENT_TEXT"] ?></p>
		</div>
	</div>
	<div class="profile__sub-item">
		<ul class="profile__numbers-list">
			<li class="profile__numbers-item"><span class="profile__numbers-value"><?= $arResult["UF_DOGSIT_EXPERIENCE_AGE"] ?></span>
				<p class="profile__numbers-text">pet care experience</p>
			</li>
			<li class="profile__numbers-item"><span class="profile__numbers-value"><?= $arResult["numberPets"] ?></span>
				<p class="profile__numbers-text">home pets</p>
			</li>
			<li class="profile__numbers-item"><span class="profile__numbers-value"><?= $arResult["UF_HOUSING_AREA"] ?></span>
				<p class="profile__numbers-text">Sq.m. of living space</p>
			</li>
		</ul>
	</div>
</div>

<!-- 2-й блок -->
<div class="profile__item">
	<div class="js-tabs b-tabs" data-hash>
		<ul class="b-tabs__navigation">
			<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#tab1">Details</a>
			</li>
			<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#tab2">Pets</a>
			</li>
			<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#tab3">Skills</a>
			</li>
		</ul>
		<div class="b-tabs__progress-line"><span class="js-tabs-thumb b-tabs__thumb"></span>
		</div>
		<div class="js-tabs-content b-tabs__content" id="tab1">
			<ul class="b-profile-details">
				<li class="b-profile-details__item">
					<div class="h6 b-profile-details__title">Type of dogsitter housing</div>
					<div class="b-profile-details__text">
						<p><?= $arResult["UF_TYPE_HOUSING_VALUE"] ?></p>
					</div>
				</li>
				<? if ($arResult["UF_CHILD_10"] == 1) : ?>
					<li class="b-profile-details__item">
						<div class="h6 b-profile-details__title">There are children under 10 years old</div>
					</li>
				<? endif ?>

				<li class="b-profile-details__item">
					<div class="h6 b-profile-details__title">Types of pets that I take for overexposure</div>
					<div class="b-profile-details__text">
						<p><?= $arResult["UF_TYPE_PETS_VALUE"] ?></p>
					</div>
				</li>
				<? if ($arResult["UF_PERMANENT_NOTE"] == 1) : ?>
					<li class="b-profile-details__item">
						<div class="h6 b-profile-details__title">The pet will be supervised 24 hours a day</div>
					</li>
				<? endif ?>
				<li class="b-profile-details__item">
					<div class="h6 b-profile-details__title">List of breeds that I take for overexposure</div>
					<div class="b-profile-details__text">
						<p><?= $arResult["UF_LIST_BREEDS"] ?></p>
					</div>
				</li>
				<? if ($arResult["UF_PERSONAL_TRANSPORT"] == 1) : ?>
					<li class="b-profile-details__item">
						<div class="h6 b-profile-details__title">There is a private car</div>
					</li>
				<? endif ?>
			</ul>
		</div>
		<div class="js-tabs-content b-tabs__content" id="tab2">Питомцы</div>
		<div class="js-tabs-content b-tabs__content" id="tab3">
			<ul class="profile__skills">
				<li class="profile__skills-item"><span class="tag tag--small tag--purple">Veterinarian</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--aqua">The beach is nearby</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--blue">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--aquagreen">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--yellow">Active life</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--purple">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--yellow">Active life</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--purple">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--aqua">The beach is nearby</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--aquagreen">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--blue">Skill</span>
				</li>
				<li class="profile__skills-item"><span class="tag tag--small tag--purple">Veterinarian</span>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- 3-й блок (прайс) -->
<? if ($arResult["priceList"]) : ?>
	<div class="profile__item profile__item--dimmed" id="personal-price">
		<!-- js-price-list -->
		<div class=" b-profile-price" data-id="price-list">
			<div class="b-profile-price__top">
				<div class="h3 b-profile-price__title">Price list</div>
			</div>
			<div id="price-list">
				<!-- js-list -->
				<div class="list  b-profile-price__content">
					<? foreach ($arResult["priceList"] as $price) : ?>
						<div class="b-profile-price__item" data-type="dogs">
							<div class="b-profile-price__icon b-profile-price__icon--purple">
								<i class="fas fa-dog"></i>
							</div>
							<div class="b-profile-price__wrapper">
								<span class="b-profile-price__price"><span class="b-profile-price__value">$<?= $price["PRICE"] ?></span> / <?= $price["CALCULATION_PERIOD"] ?></span>
								<p class="b-profile-price__name"><?= $price["NAME"] ?></p>
							</div>
						</div>
					<? endforeach ?>
				</div>
			</div>
		</div>
	</div>
<? endif ?>