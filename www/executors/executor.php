<?
use Bitrix\Main\Application;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Догситтеры");


$request = Application::getInstance()->getContext()->getRequest();

//filterUserReviews
global $filterUserReviews;
$filterUserReviews["=PROPERTY_ID_EXECUTOR"] = $request->getQuery("ID_EXECUTOR");
?>

<div class="inner-page inner-page--small profile">
	<div class="wrap wrap--limited profile__wrapper">
		<ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
			<li class="parallax-layer" data-depth="0.1"><span class="parallax-particle parallax-particle--yellow profile__particle profile__particle--yellow"></span>
			</li>
			<li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--light-green profile__particle profile__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.1"><span class="parallax-particle parallax-particle--steelblue profile__particle profile__particle--steelblue"></span>
			</li>
		</ul>

		<div class="profile__left">
			<div class="profile__item profile__item--pv2">
				<div class="clearfix b-profile-info">
				<!-- executor.main -->
				<? $APPLICATION->IncludeComponent("bulldog:executor.main","",array()); ?>

				<? $APPLICATION->IncludeComponent("bulldog:executor.main","dogsiService",array()); ?>

					<div class="b-profile-info__item">
						<div class="h6">Выберите даты передержки</div>
						<div class="b-profile-info__calendar">
							<div class="js-calendar b-calendar">
								<div class="b-calendar__row">
									<div class="form-group b-calendar__field">
										<label class="visuallyhidden" for="start-date">Первая дата</label>
										<input class="form-control form-control--dimmed js-start-date" type="text" name="start-date" id="start-date" readonly>
									</div>
									<div class="form-group b-calendar__field">
										<label class="visuallyhidden" for="end-date">Вторая дата</label>
										<input class="form-control form-control--dimmed js-end-date" type="text" name="end-date" id="end-date" readonly>
									</div>
								</div>
								<div class="js-datepicker b-calendar__datepicker b-calendar__datepicker--dimmed" data-language="ru"></div>
							</div>
						</div><a class="btn btn--yellow js-inline-modal b-profile-info__connect-button" href="#profile-modal">Связаться с исполнителем</a>
					</div>

				<? $APPLICATION->IncludeComponent("bulldog:executor.main","verifandtest",array()); ?>

				</div>
			</div>
		</div>
		<div class="profile__right">

			<? $APPLICATION->IncludeComponent("bulldog:executor.main","rightBlock",array()); ?>

			<div class="profile__item">
				<div class="b-profile-map">
					<div class="b-profile-map__top">
						<div class="h3 b-profile-map__title">Местоположение</div><span class="b-profile-map__address"><i class="fas fa-map-marker-alt b-profile-map__map-marker"></i>Волгоград, ул.&nbsp;Комсомольская&nbsp;26а</span>
					</div>
					<div class="b-profile-map__wrapper" id="map"></div>
				</div>
			</div>

			<!-- отзывы исполнителя -->
			<?/*?>
			<div class="profile__item" id="personal-reviews">
				<div class="b-profile-reviews">
					<div class="b-profile-reviews__top">
						<div class="h3 b-profile-reviews__title">Отзывы</div>
						<div class="profile__bottom" style="width:250px;"><a class="btn btn--yellow js-inline-modal" href="#profile-modal">Оставить отзыв </a></div>
						<div class="b-profile-reviews__wrapper">
							<div class="b-profile-reviews__appraisal"><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span>
								<span class="star star--yellow"><i class="fas fa-star"></i>
								</span>
							</div><span class="b-profile-reviews__quantity">13 отзывов</span>
						</div>

					</div>
					<ul class="b-profile-reviews__list">
						<li class="b-profile-reviews__item">
							<div class="b-review-card b-review-card--profile">
								<div class="b-review-card__top">
									<div class="b-review-card__author">
										<div class="responsive-img b-review-card__photo">
											<img src="img/media/reviews/photo/3.jpg" alt data-object-fit="cover">
										</div>
										<div><span class="b-review-card__name">Мария Киселева</span><span class="b-review-card__position">Заказчик</span>
										</div>
									</div>
									<div class="b-review-card__appraisal"><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span>
										<span class="star star--yellow"><i class="fas fa-star"></i>
										</span><span class="b-review-card__value">5.0</span>
									</div>
									<time class="b-review-card__date" datetime="2020-05-11">11 мая 2020</time>
								</div>
								<div class="b-review-card__content">
									<div class="h3 b-review-card__title">Очень полезный ресурс</div>
									<div class="content-style b-review-card__text">
										<p>С нами живет прекрасный пес породы чихуахуа по имени Сэм. Он полноправный член нашей небольшой семью и мы его безумно любим. Для нас - это ребенок, поэтому все что с ним происходит нам очень важно .</p>
									</div>
								</div>
							</div>
						</li>
						<li class="b-profile-reviews__item">
							<div class="b-review-card b-review-card--profile">
								<div class="b-review-card__top">
									<div class="b-review-card__author">
										<div class="responsive-img b-review-card__photo">
											<img src="img/media/reviews/photo/4.jpg" alt data-object-fit="cover">
										</div>
										<div><span class="b-review-card__name">Сергей Денисов</span><span class="b-review-card__position">Заказчик</span>
										</div>
									</div>
									<div class="b-review-card__appraisal"><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span>
										<span class="star"><i class="fas fa-star"></i>
										</span><span class="b-review-card__value">4.0</span>
									</div>
									<time class="b-review-card__date" datetime="2020-05-11">11 мая 2020</time>
								</div>
								<div class="b-review-card__content">
									<div class="h3 b-review-card__title">У Оливы Саша в гостях на ситтинге: хозяева в отпуске.</div>
									<div class="content-style b-review-card__text">
										<p>В комплекте с Оливой — Фасолька, самодостаточная кошечка, которая встречает нас удивленными глазами. Подходить близко не собирается, поглядывает издалека.</p>
									</div>
								</div>
							</div>
						</li>
						<li class="b-profile-reviews__item">
							<div class="b-review-card b-review-card--profile">
								<div class="b-review-card__top">
									<div class="b-review-card__author">
										<div class="responsive-img b-review-card__photo">
											<img src="img/media/reviews/photo/5.jpg" alt data-object-fit="cover">
										</div>
										<div><span class="b-review-card__name">Мария Киселева</span><span class="b-review-card__position">Заказчик</span>
										</div>
									</div>
									<div class="b-review-card__appraisal"><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span><span class="star star--yellow"><i class="fas fa-star"></i></span>
										<span class="star star--yellow"><i class="fas fa-star"></i>
										</span><span class="b-review-card__value">5.0</span>
									</div>
									<time class="b-review-card__date" datetime="2020-05-11">11 мая 2020</time>
								</div>
								<div class="b-review-card__content">
									<div class="h3 b-review-card__title">Очень полезный ресурс</div>
									<div class="content-style b-review-card__text">
										<p>С нами живет прекрасный пес породы чихуахуа по имени Сэм. Он полноправный член нашей небольшой семью и мы его безумно любим. Для нас - это ребенок, поэтому все что с ним происходит нам очень важно .</p>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<div class="b-profile-reviews__actions">
						<button class="btn btn--yellow js-more-profile-review">Загрузить еще</button>
					</div>
				</div>
			</div>
			<?*/?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"reviews-executor",
				array(
					"ACTIVE_DATE_FORMAT" => "d F Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "filterUserReviews",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "22",
					"IBLOCK_TYPE" => "reviews_executor",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "N",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "6",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "Y",
					"PAGER_TEMPLATE" => "show_more_reviews_executor",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "RATING",
						1 => "ID_EXECUTOR",
						2 => "ID_CUSTOMER",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "ID",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "DESC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "reviews-executor",
					"TITLE_BLOCK" => "Popular reviews"
				),
				false
			); ?>

			

		</div>

		<div class="profile__bottom"><a class="btn btn--yellow js-inline-modal" href="#profile-modal">Связаться с исполнителем</a>
			<span class="decor profile__arrow" aria-hidden="true"><svg role="img" width="1em" height="1em">
					<use xlink:href="#si-decor-big-arrow" />
				</svg></span>
		</div>


		<?
		if($USER->IsAuthorized())
		{
			$statusLicense = \Site\App\UserLicense::getStatus();
			\Site\App\Debug::consoleAdd($statusLicense);
			if($statusLicense)
				$APPLICATION->IncludeComponent("bulldog:executor.main","form",array()); 
			if($statusLicense === false) // нет подписки
				$APPLICATION->IncludeComponent("bulldog:executor.main","form_no_subscription",array()); 
		}
		else
		{
			$APPLICATION->IncludeComponent("bulldog:executor.main","form_not_authorized",array()); 
		}
		?>

	</div>
</div>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>