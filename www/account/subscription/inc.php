<?

?>
<div id="js-applications-page"></div>
<div class="personal-area__content">
	<div class="" style="padding-right: 40px;">
		<div class="js-tabs b-tabs b-tabs--personal" data-hash>
			<ul class="b-tabs__navigation">
				<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#personal-tab1">Managing subscriptions</a>
				</li>
				<li class="b-tabs__navigation-item"><a class="b-tabs__navigation-link" href="#personal-tab2">Payments</a>
				</li>
			</ul>
			<div class="b-tabs__progress-line">
				<span class="js-tabs-thumb b-tabs__thumb"></span>
			</div>

			<div class="js-tabs-content b-tabs__content" id="personal-tab1">
				<div class="b-personal-orders__list">
					<?
					$subscribeInfo = \Site\App\UserLicense::InformationDaysLeft();
					?>
					<? if ($subscribeInfo["RED_PERIOD"]) : ?>
						<div class="b-personal-safety__message b-personal-safety__message--error">
							<span class="b-personal-safety__icon"><i>!</i></span>
							<div class="h6 b-personal-safety__status">Осталось дней по подписке: <?= $subscribeInfo["DAYS_LEFT"] ?></div>
							<div class="b-personal-safety__text">
								<p>Продлите подписку, что бы продолжить пользоваться сервисом.</p>
							</div>
						</div>
					<? else : ?>
						<div class="b-personal-safety__message b-personal-safety__message--success">
							<span class="b-personal-safety__icon"><i class="fa fa-check"></i></span>
							<div class="h6 b-personal-safety__status">Осталось по подсписке: <?= $subscribeInfo["DAYS_LEFT"] ?></div>
							<div class="b-personal-safety__text">
								<p>Не забывайте продлевать подписку ))) </p>
							</div>
						</div>
					<? endif; ?>


					<div class="b-personal-orders__item" style="margin-bottom: 30px;">
						<div class="">
							<div class="">
								<div class="h6"><?= \Bitrix\Main\Config\Option::get("askaron.settings", "UF_SUB_INF_TITLE") ?></div>
								<div style="max-width: 900px;">
									<?= \Bitrix\Main\Config\Option::get("askaron.settings", "UF_SUB_INF_DESC") ?>
								</div>
							</div>
							<div class="b-personal-order--button" data-request-id="310">
							</div>
						</div>
					</div>

					<?
					$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"tariffs",
						Array(
							"IBLOCK_TYPE" => "tariffs",
							"IBLOCK_ID" => "25",
							"NEWS_COUNT" => "10",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "ID",
							"SORT_ORDER2" => "DESC",
							"FIELD_CODE" => Array(),
							"PROPERTY_CODE" => Array("DAYS", "PRICE"),
							"CACHE_TYPE" => "N",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"PAGER_TEMPLATE" => "",
							"SET_TITLE" => "N",
							"ACTIVE"=> "Y"
						)
					);
					?>


				</div>

			</div>

			<?
			global $arFilter;
			$arFilter["PROPERTY_USER"] = $USER->GetID();
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"subscription.payments",
				Array(
					"IBLOCK_TYPE" => "tariffs",
					"IBLOCK_ID" => "26",
					"NEWS_COUNT" => "10",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FIELD_CODE" => Array(),
					"PROPERTY_CODE" => Array("TARIFF","STATUS"),
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "3600",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "Y",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"PAGER_TEMPLATE" => "",
					"SET_TITLE" => "N",
					"ACTIVE"=> "Y",
					"FILTER_NAME" => "arFilter"
				)
			);
			?>
		</div>
	</div>
</div>