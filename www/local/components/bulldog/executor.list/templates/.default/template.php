<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<div class="wrap performers__wrapper" data-sticky-container>
	<div class="performers__top">
		<h1 class="performers__title">Search for an artist</h1>
		<div class="performers__result"><span class="performers__result-numbers"><?= $arResult["rowsCount"] ?></span> result</div>
	</div>

	<div class="performers__filters">

		<form class="performers__place-filter" action method="GET">
			<div class="form-row">
				<div class="form-group form-group--half">
					<div class="select-style">
						<select onchange="applyFilter(this);" class="js-select" name="country" data-placeholder="Country">
							<option></option>
							<? foreach ($arResult["FILTER_PARAM"]["COUNTRY"] as $country) : ?>
								<? $url = $APPLICATION->GetCurPageParam("country=" . $country["COUNTRY"], array("country")); ?>
								<option value="<?= $url ?>" <? if ($arResult["ACTIVE_FILTER"]["PROPERTY_USER_COUNTRY"] == $country["COUNTRY"]) echo "selected"; ?>><?= $country["COUNTRY_NAME"] ?></option>
							<? endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-group form-group--half">
					<div class="select-style">
						<select onchange="applyFilter(this);" class="js-select" name="city" data-placeholder="City">
							<option></option>
							<? foreach ($arResult["FILTER_PARAM"]["CITY"] as $city) : ?>
								<? $url = $APPLICATION->GetCurPageParam("city=" . $city, array("city")); ?>
								<option value="<?= $url ?>" <? if ($arResult["ACTIVE_FILTER"]["PROPERTY_USER_CITY"] == $city) echo "selected"; ?>><?= $city ?></option>
							<? endforeach ?>
						</select>
					</div>
				</div>
			</div>
		</form>
		<div class="js-performers-filter b-big-filter">
			<button class="btn btn--small js-performers-filter-toggle b-big-filter__toggle">
				<svg role="img" width="1em" height="1em">
					<use xlink:href="#si-filter-icon" />
				</svg>Filter</button>

			<form class="b-big-filter__form" action>
				<div class="b-big-filter__left">
					<div class="form-row">
						<div class="form-group form-group--half">
							<div class="range-style">
								<div class="form-price__wrapper">
									<label class="form-label">Cost </label>
									<div class="select-style select-style--light form__serch">
										<select class="js-select" name="price-type" required="required">
											<? foreach ($arResult["FILTER_PARAM"]["PRICE"]["typePrice"] as $key => $type) : ?>
												<option value="<?= $key ?>" <? if ($arResult["ACTIVE_FILTER"]["UF_FIX_PRICE_TYPE"] == $key) : ?> selected<? endif ?>>
													<?= $type ?>
												</option>
											<? endforeach ?>
										</select>
									</div>
									<label class="form-label"> , £ </label>
								</div>

								<div class="js-range" data-min="<?= $arResult["FILTER_PARAM"]["PRICE"]["minPrice"] ?>" data-start-min="<?= $arResult["FILTER_PARAM"]["PRICE"]["startMinPrice"] ?>" data-max="<?= $arResult["FILTER_PARAM"]["PRICE"]["maxPrice"] ?>" data-start-max="<?= $arResult["FILTER_PARAM"]["PRICE"]["startMaxPrice"] ?>" data-step="1"></div>
								<input class="js-range-value" type="hidden" name="price-min" data-type="min">
								<input class="js-range-value" type="hidden" name="price-max" data-type="max">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group form-group--half">
							<div class="select-style select-style--white-br">
								<select class="js-select" name="serviceType" data-placeholder="Type of service">
									<option></option>
									<? foreach ($arResult["FILTER_PARAM"]["serviceType"] as $key => $val) : ?>
										<option value="<?= $key ?>" <? if ($arResult["ACTIVE_FILTER"]["SERVICE_TYPE"] == $key) : ?> selected<? endif ?>><?= $val ?></option>
									<? endforeach ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group form-group--half">
							<div class="select-style select-style--white-br">
								<select class="js-select" name="pet-type" data-placeholder="Type of pet">
									<option></option>
									<? foreach ($arResult["FILTER_PARAM"]["typePets"] as $key => $val) : ?>
										<option value="<?= $key ?>" <? if ($arResult["ACTIVE_FILTER"]["UF_TYPE_PETS"] == $key) : ?> selected<? endif ?>><?= $val ?></option>
									<? endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group form-group--half">
							<div class="select-style select-style--white-br">
								<select class="js-select" name="house-type" data-placeholder="Type of housing">
									<option></option>
									<? foreach ($arResult["FILTER_PARAM"]["houseType"] as $key => $val) : ?>
										<option value="<?= $key ?>" <? if ($arResult["ACTIVE_FILTER"]["UF_TYPE_HOUSING"] == $key) : ?> selected<? endif ?>><?= $val ?></option>
									<? endforeach ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<!-- <div class="form-group form-group--half">
							<div class="js-select-checkbox b-checkbox-select b-checkbox-select--white-br">
								<button class="js-select-checkbox-toggle b-checkbox-select__toggle" type="button">Спец. пожелания (<span class="js-select-checkbox-value b-checkbox-select__value">0</span>)</button>
								<div class="b-checkbox-select__list">
									<div class="b-checkbox-select__item">
										<label class="ui-checkbox ui-checkbox--dimmed">
											<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="special-1"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
													<use xlink:href="#si-icon-check" />
												</svg></i><span class="ui-checkbox__text">Некурящие в доме</span>
										</label>
									</div>
									<div class="b-checkbox-select__item">
										<label class="ui-checkbox ui-checkbox--dimmed">
											<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="special-2" checked="checked"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
													<use xlink:href="#si-icon-check" />
												</svg></i><span class="ui-checkbox__text">Нет животных</span>
										</label>
									</div>
									<div class="b-checkbox-select__item">
										<label class="ui-checkbox ui-checkbox--dimmed">
											<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="special-3"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
													<use xlink:href="#si-icon-check" />
												</svg></i><span class="ui-checkbox__text">Нет детей</span>
										</label>
									</div>
								</div>
							</div>
						</div> -->
						<div class="form-group form-group--half">
							<label class="ui-checkbox">
								<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="non-smokers" <? if ($arResult["ACTIVE_FILTER"]["UF_NON_SMOKERS"]) : ?>checked<? endif ?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i><span class="ui-checkbox__text">Non-smokers in the house</span>
							</label>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group form-group--half">
							<label class="ui-checkbox">
								<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="no-children" <? if ($arResult["ACTIVE_FILTER"]["UF_CHILD_10"] === false) : ?>checked<? endif ?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i><span class="ui-checkbox__text">No children</span>
							</label>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group form-group--half">
							<label class="ui-checkbox">
								<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="have-pet" <? if ($arResult["ACTIVE_FILTER"]["UF_HAVE_PET"] == 1) : ?>checked<? endif ?>><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i><span class="ui-checkbox__text">Pets at the dogsitter</span>
							</label>
						</div>
					</div>
				</div>
				<div class="b-big-filter__right">
					<label class="form-label">Overexposure dates</label>
					<div class="js-calendar b-calendar">
						<div class="b-calendar__row">
							<div class="form-group b-calendar__field">
								<label class="visuallyhidden" for="start-date">Start</label>
								<input class="form-control js-start-date" type="text" name="start-date" id="start-date" readonly>
							</div>
							<div class="form-group b-calendar__field">
								<label class="visuallyhidden" for="end-date">End</label>
								<input class="form-control js-end-date" type="text" name="end-date" id="end-date" readonly>
							</div>
						</div>
						<div class="js-datepicker b-calendar__datepicker" data-language="ru"></div>
					</div>
				</div>
				<div class="b-big-filter__bottom">
					<button class="btn btn--small btn--pink b-big-filter__submit-button">Send</button>
					<a href="<?= $APPLICATION->GetCurPageParam(
									"",
									array("price-type", "price-min", "price-max", "pet-type", "house-type", "non-smokers", "no-children", "have-pet")
								); ?>" class="btn btn--small btn--white b-big-filter__reset-button" type="reset">Clear</a>
				</div>
			</form>
		</div>
	</div>

	<div class="js-sticky-map performers__map" data-margin-top="135"></div>

	<div class="performers__sorts">
		<div class="performers__sort b-performer-sort"><span class="b-performer-sort__name">Sort</span>
			<div class="select-style b-performer-sort__field">
				<select onchange="applyFilter(this);" class="js-select" name="sort">
					<option value="<?= $APPLICATION->GetCurPageParam("sort=popular", array("sort")); ?>" <? if ($arResult["ACTIVE_SORT"]["PROPERTY_USER_POPULARITY"] == "desc, nulls") : ?> selected <? endif ?>>by popularity</option>
					<option value="<?= $APPLICATION->GetCurPageParam("sort=pr_asc", array("sort")); ?>" <? if ($arResult["ACTIVE_SORT"]["PROPERTY_PRICE"] == "ASC") : ?> selected <? endif ?>>ascending</option>
					<option value="<?= $APPLICATION->GetCurPageParam("sort=pr_desc", array("sort")); ?>" <? if ($arResult["ACTIVE_SORT"]["PROPERTY_PRICE"] == "DESC") : ?> selected <? endif ?>>descending order</option>
				</select>
			</div>
		</div>
		<div class="performers__top-status">
			<label class="ui-checkbox ui-checkbox--hollow">
				<input data-true="<?= $APPLICATION->GetCurPageParam("top=y", array("top")); ?>" data-false="<?= $APPLICATION->GetCurPageParam("", array("top")); ?>" onclick="applyTop(this);" class="visuallyhidden ui-checkbox__input" type="checkbox" <? if (isset($arResult["ACTIVE_FILTER"]["!UF_TOP_100"]) && !$arResult["ACTIVE_FILTER"]["!UF_TOP_100"]) : ?>checked<? endif ?>>
				<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
						<use xlink:href="#si-icon-check" />
					</svg></i>
				<span class="ui-checkbox__text">Top 100<span class="star star--yellow"><i class="fas fa-star"></i></span></span>
			</label>
		</div>
	</div>


	<div class="performers__content">
		<div class="performers__list">
			<? foreach ($arResult["USERS"] as $execut) : ?>
				<div class="performers__item" data-serviceID="<?= $execut["SERVICE_ID"] ?>">
					<a class="b-performer-card" href="<?= $execut["PUBLIC_PAGE"] ?>">
						<div class="responsive-img b-performer-card__photo">
							<img src="<?= $execut["PERSONAL_PHOTO"] ?>" alt data-object-fit="cover">
						</div>
						<div class="b-performer-card__wrapper">
							<div class="b-performer-card__top">
								<span class="h6 b-performer-card__name"><? echo $execut["NAME"] . " " . $execut["LAST_NAME"] ?></span>
								<? if ($execut["UF_TOP_100"]) : ?><span class="b-performer-card__status">Top 100</span><? endif ?>
								<span class="b-performer-card__place"><?= GetCountryByID($execut["PERSONAL_COUNTRY"]) ?>, <?= $execut["PERSONAL_CITY"] ?></span>
								<div class="b-performer-card__reviews">
									<span class="b-performer-card__reviews-stars">
										<? for ($i = 1; $i <= 5; $i++) : ?>
											<span class="star <?= ($execut["STARS"]["AVERAGE"] >= $i ? "star--yellow" : "") ?>"><i class="fas fa-star"></i></span>
										<? endfor ?>
									</span>
									<span class="b-performer-card__reviews-text"><?= $execut["STARS"]["VOTE"] ?> <?= ($execut["STARS"]["VOTE"] > 1 ? "reviews" : "review") ?></span>
								</div>
							</div>
							<div class="b-performer-card__bottom">
								<div class="b-performer-card__content">
									<div class="js-dot b-performer-card__text">
										<p><?= $execut["UF_HEADLINE"] ?></p>
									</div>
								</div>
								<? if ($execut["PRICE_PER"]["PRICE"]) : ?>
									<div class="b-performer-card__price">
										<div class="b-performer-card__price-value">£<?= $execut["PRICE_PER"]["PRICE"] ?></div>
										<span class="b-performer-card__price-text"><?= $execut["PRICE_PER"]["CALCULATION_PERIOD"] ?></span>
									</div>
								<? endif ?>
							</div>
						</div>
					</a>
				</div>
			<? endforeach ?>
		</div>
		<? if ($arResult["NextPage"] !== false) : ?>
			<div class="performers__actions load_more_block">
				<!-- <button class="btn btn--yellow performers__button">Загрузить еще</button> -->
				<a href="<?= $arResult["NextPage"] ?>" class="btn btn--yellow performers__button load_more">Download more</a>
			</div>
		<? endif ?>
	</div>

</div>