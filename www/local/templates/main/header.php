<?

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use Account\UserInfo;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

$mainPage = ($APPLICATION->GetCurPage(true) == SITE_DIR . "index.php");
global $loginPage;

$personalPhotoPath = UserInfo::getUserPhoto();
if (!$personalPhotoPath)
{
	$personalPhotoPath = "/local/templates/main/img/theme/logo.svg";
}

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css" integrity="sha384-OLYO0LymqQ+uHXELyx93kblK5YIS3B2ZfLGBmsJaUyor7CpMTBsahDHByqSuWW+q" crossorigin="anonymous">

	<title><? $APPLICATION->ShowTitle(); ?></title>
	<? $APPLICATION->ShowHead(); ?>
	<?
	if($APPLICATION->GetProperty("keywords") == "Keywords"){
		$APPLICATION->SetPageProperty("keywords", "");
	}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<link rel="apple-touch-icon" size="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" size="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" size="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ff8d76">

	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<?
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/vendors.css");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css?1604899873915");
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/update.css");
	?>

	<!-- Яндекс Вебмастер -->
	<meta name="yandex-verification" content="c399617a2ceaf494" />
	<!-- Google Search Console -->
	<meta name="google-site-verification" content="NcbyphnpTb_HdhWDEcO7kNo6RL47EpZRxIsoPAZLB-8" />

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function(m, e, t, r, i, k, a) {
			m[i] = m[i] || function() {
				(m[i].a = m[i].a || []).push(arguments)
			};
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) {
				if (document.scripts[j].src === r) {
					return;
				}
			}
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(94835867, "init", {
			clickmap: true,
			trackLinks: true,
			accurateTrackBounce: true,
			webvisor: true,
			ecommerce: "dataLayer"
		});
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/94835867" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>
	<!-- /Yandex.Metrika counter -->

	<!-- Google Analytics -->
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-V0SG911QB7"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-V0SG911QB7');
	</script>

	<?
	if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443)
	{
		$protocol = 'https://';
	}
	else
	{
		$protocol = 'http://';
	}

	$url = $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	$urlend = strrpos($url, '?', -1); // Находим и удаляем все параметры (номер страницы, параметры фильтра и тд.)
	if ($urlend != false)
	{
		$url = substr($url, 0, $urlend);
	}


	// if (mb_substr($url, -1) == '/')
	// { // Тут оставляем, если ссылки на сайте не заканчиваются на /, либо удаляем, если заканчиваются на /.
	// 	$url = substr($url, 0, -1);
	// }
	echo '<link rel="canonical" href="' . $url . '"/>';
	?>

</head>

<body>
<?if($mainPage):?>
<script type="application/ld+json">
{
"@context": "https://schema.org/", 
"@type": "Organization",
"name": "Bobby the Bulldog",
}
</script>
<?else:?>

	<?
	$APPLICATION->IncludeComponent(
		"bitrix:breadcrumb",
		"json-ld",
		array(
			"START_FROM" => "0",
			"PATH" => "",
			"SITE_ID" => "s1"
		)
	);
	?>
<?endif?>

	<div id="panel">
		<? $APPLICATION->ShowPanel(); ?>
	</div>
	<? if ($loginPage === true) : ?>
		<div class="portrait-sceen">
			<svg xmlns="http://www.w3.org/2000/svg" width="229.716" height="199.207" viewbox="0 0 229.716 199.207">
				<g id="Group_1863" data-name="Group 1863" transform="translate(-269 -347.793)">
					<path id="Path_9334" data-name="Path 9334" d="M364.21,89.852a4.487,4.487,0,0,0-6.345,0l-2.782,2.783V60.176A4.487,4.487,0,0,0,350.6,55.69H318.169l2.774-2.771a4.487,4.487,0,1,0-6.343-6.348L304.159,57a4.535,4.535,0,0,0,0,6.346L314.6,73.793a4.487,4.487,0,1,0,6.346-6.344l-2.785-2.786h27.95V92.626l-2.767-2.771a4.487,4.487,0,0,0-6.35,6.34l10.428,10.445c1.776,1.332,4.671,2.1,6.348,0L364.21,96.2a4.486,4.486,0,0,0,0-6.345Z" transform="translate(102.021 307.586)" fill="#fff" />
					<path id="Path_9335" data-name="Path 9335" d="M215.22,116.363H116.808V48.5a14.514,14.514,0,0,0-14.5-14.5H14.5A14.514,14.514,0,0,0,0,48.5V218.721a14.507,14.507,0,0,0,14.5,14.486H138.685a4.487,4.487,0,0,0,0-8.973H115.714a14.4,14.4,0,0,0,1.093-5.513V125.336H215.22a5.53,5.53,0,0,1,5.523,5.525v16.161h-7.964a10.655,10.655,0,0,0-10.642,10.644v34.248a10.655,10.655,0,0,0,10.642,10.644h7.964v16.161a5.524,5.524,0,0,1-5.523,5.513H178.988a4.487,4.487,0,0,0,0,8.973H215.22a14.507,14.507,0,0,0,14.5-14.486V130.862a14.513,14.513,0,0,0-14.5-14.5ZM39.61,42.973H77.2v7.968a1.7,1.7,0,0,1-1.682,1.671H41.279a1.692,1.692,0,0,1-1.669-1.671Zm-25.114,0H30.638v7.968A10.655,10.655,0,0,0,41.28,61.586H75.516A10.662,10.662,0,0,0,86.171,50.942V42.973h16.142a5.53,5.53,0,0,1,5.522,5.526V204.387H8.973V48.5A5.53,5.53,0,0,1,14.5,42.973Zm30.548,181.26H14.5a5.524,5.524,0,0,1-5.523-5.513v-5.36h98.861v5.36a5.524,5.524,0,0,1-5.522,5.513Zm167.735-30.648a1.692,1.692,0,0,1-1.669-1.671V157.667A1.692,1.692,0,0,1,212.779,156h7.964v37.59Z" transform="translate(269 313.793)" fill="#fff" />
					<path id="Path_9339" data-name="Path 9339" d="M116.808,116.363V48.5a14.514,14.514,0,0,0-14.5-14.5H14.5A14.514,14.514,0,0,0,0,48.5V218.721a14.507,14.507,0,0,0,14.5,14.486h87.816c1.938,0,10.841-1.006,13.4-8.973a14.4,14.4,0,0,0,1.093-5.513V116.363Zm-77.2-73.39H77.2v7.968a1.7,1.7,0,0,1-1.682,1.671H41.279a1.692,1.692,0,0,1-1.669-1.671Zm-25.114,0H30.638v7.968A10.655,10.655,0,0,0,41.28,61.586H75.516A10.662,10.662,0,0,0,86.171,50.942V42.973h16.142a5.53,5.53,0,0,1,5.522,5.526V204.387H8.973V48.5A5.53,5.53,0,0,1,14.5,42.973Zm30.548,181.26H14.5a5.524,5.524,0,0,1-5.523-5.513v-5.36h98.861v5.36a5.524,5.524,0,0,1-5.522,5.513Z" transform="translate(269 313.793)" fill="#6e6e6e" />
					<path id="Path_9338" data-name="Path 9338" d="M348.5,458h-.026a4.5,4.5,0,1,0,.026,0Z" transform="translate(79.338 80.026)" fill="#fff" />
				</g>
			</svg><span>Turn your device</span>
		</div>
	<? endif ?>
	<!-- [if lte IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
	<div class="wrap-site">
		<header class="header <? if ($mainPage) : ?>header--whiteLogo<? endif ?>">
			<div class="wrap header__wrapper">
				<div class="header__logo">
					<a class="b-logo <? if ($mainPage) : ?>b-logo--white<? endif ?> b-logo--small" href="<?= SITE_DIR ?>">
						<div class="b-logo__image">
							<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/logo.svg" alt>
						</div>
						<div class="b-logo__content">
							<span class="b-logo__name"><?= Option::get("askaron.settings", "UF_LOGO_TOP"); ?></span>
							<span class="b-logo__sub-name"><?= Option::get("askaron.settings", "UF_LOGO_BOTTOM"); ?></span>
						</div>
						<? if ($mainPage) : ?>
							<span class="decor b-logo__decor">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-decor-cube-2" />
								</svg></span>
						<? endif ?>
					</a>
				</div>

				<nav style="left:46%;" class="header__navigation site-nav">
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"top",
						array(
							"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
							"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
							"DELAY" => "N",	// Откладывать выполнение шаблона меню
							"MAX_LEVEL" => "1",	// Уровень вложенности меню
							"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
								0 => "",
							),
							"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
							"MENU_CACHE_TYPE" => "N",	// Тип кеширования
							"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
							"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
							"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						),
						false
					); ?>
				</nav>
				<nav class="user-nav">
					<? if (!$USER->IsAuthorized()) : ?>
						<a style="color:#40234c; font-weight:bold; margin-right:15px;" class="underline user-nav__login-link" href="/login/">Sigh up/Login</a>

						<a class="btn btn--pink user-nav__find-button" href="/executors/"><?= GetMessage("find_a_performer") ?></a>
						<a class="btn btn--circle btn--green btn--call user-nav__call-button js-ajax-modal" href="?popup=y" title="Order a call">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-phone" />
							</svg>
						</a>
						<?
						$APPLICATION->IncludeComponent(
							"bulldog:feedback_call",
							"",
							array(
								"COMPONENT_TEMPLATE" => "",
								"IBLOCK_ID" => "12",
								"ID_FORM" => "feedback_call",
								"MESSAGE_ID" => "33"
							),
							false,
							array("HIDE_ICONS" => "Y")
						);
						?>
					<? endif ?>

					<? if ($USER->IsAuthorized()) : ?>
						<div class="user-nav__item user-nav__item--notification">
							<button class="user-nav__button user-nav__button--notification">
								<svg role="img" width="1em" height="1em">
									<use xlink:href="#si-bell" />
								</svg>
							</button>
							<span class="notification user-nav__notification-value" style="visibility: hidden;">0</span>
							<div class="dropdown user-nav__dropdown">
								<div class="user-nav__header">
									<svg role="img" width="1em" height="1em">
										<use xlink:href="#si-bell" />
									</svg>Notifications
								</div>
								<ul class="user-nav__list b-notification-list" data-empty-mess="Уведомлений нет">
								</ul>
							</div>
						</div>
						<!-- personal menu -->
						<div class="user-nav__item user-nav__item--personal">
							<button class="user-nav__button user-nav__button--personal">
								<div class="responsive-img user-nav__photo">
									<img src="<?= $personalPhotoPath ?>" alt data-object-fit="cover">
								</div>
							</button>
							<div class="dropdown user-nav__dropdown">
								<div class="user-nav__header">
									<span class="user-nav__user-name"><?= $USER->GetFullName() ?></span>
									<a class="user-nav__logout-link" href="<? echo $APPLICATION->GetCurPageParam("logout=yes", array("login", "logout", "register", "forgot_password", "change_password")); ?>" title="Logout">
										<svg role="img" width="1em" height="1em">
											<use xlink:href="#si-logout" />
										</svg>
									</a>
								</div>
								<? $APPLICATION->IncludeComponent(
									"bitrix:menu",
									"personal-top",
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "",
										"DELAY" => "N",
										"MAX_LEVEL" => "1",
										"MENU_CACHE_GET_VARS" => array(),
										"MENU_CACHE_TIME" => "36000",
										"MENU_CACHE_TYPE" => "Y",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "",
										"USE_EXT" => "N",
										"COMPONENT_TEMPLATE" => "personal-left",
										"MENU_CACHE_USE_USERS" => "Y"
									),
									false
								); ?>
							</div>
						</div>
						<a class="btn btn--circle btn--green btn--call user-nav__call-button js-ajax-modal" href="?popup=y" title="Order a call">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-phone" />
							</svg>
						</a>
						<?
						$APPLICATION->IncludeComponent(
							"bulldog:feedback_call",
							"",
							array(
								"COMPONENT_TEMPLATE" => "",
								"IBLOCK_ID" => "12",
								"ID_FORM" => "feedback_call",
								"MESSAGE_ID" => "33"
							),
							false,
							array("HIDE_ICONS" => "Y")
						);
						?>
					<? endif ?>
				</nav>
				<div class="header__menu-button">
					<button class="btn btn--circle btn--menu js-mobile-menu-button" aria-label="<?= GetMessage("menu") ?>"></button>
				</div>
				<div class="mobile-menu">
					<a class="mobile-menu__logo b-logo" href="<?= SITE_DIR ?>">
						<div class="b-logo__image">
							<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/logo.svg" alt>
						</div>
						<div class="b-logo__content">
							<span class="b-logo__name"><?= Option::get("askaron.settings", "UF_LOGO_TOP"); ?></span>
							<span class="b-logo__sub-name"><?= Option::get("askaron.settings", "UF_LOGO_BOTTOM"); ?></span>
						</div>
					</a>

					<nav class="mobile-menu__navigation site-nav site-nav--column site-nav--mobile">
						<? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top",
							array(
								"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
								"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
								"DELAY" => "N",	// Откладывать выполнение шаблона меню
								"MAX_LEVEL" => "1",	// Уровень вложенности меню
								"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
									0 => "",
								),
								"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
								"MENU_CACHE_TYPE" => "N",	// Тип кеширования
								"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
								"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
								"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
							),
							false
						); ?>
					</nav>

					<a class="btn btn--pink mobile-menu__find-button" href="/executors/"><?= GetMessage("find_a_performer") ?></a>

					<!-- выводится только на ширине 768+ -->
					<?
					$APPLICATION->IncludeComponent(
						"bulldog:content.blocks",
						"social-link-for-mobile",
						array(
							"COMPONENT_TEMPLATE" => "social-link-for-mobile",
							"IBLOCK_ID" => "",
							"ID_ELEM" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3000"
						),
						false
					);
					?>

				</div>
			</div>
		</header>

		<main class="main">
			<div class="other_screens" style="z-index:99999;left: 8%;position: absolute;top: 150px;"><?
if($APPLICATION->GetCurPage() != '/'){
$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
		"START_FROM" => "0", 
		"PATH" => "", 
		"SITE_ID" => "s1" 
	)
);
}?>
			</div>