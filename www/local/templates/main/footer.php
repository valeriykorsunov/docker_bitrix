<?
use Account\AccountAccess;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

global $loginPage;
?>

</main>
<? if ($loginPage !== true) : ?>
	<footer class="footer">
		<div class="wrap footer__wrapper">
			<div class="footer__top">
				<a class="footer__logo b-logo b-logo--white" href="<?= SITE_DIR ?>">
					<div class="b-logo__image">
						<img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/logo.svg" alt>
					</div>
					<div class="b-logo__content">
						<span class="b-logo__name"> <?= Option::get("askaron.settings", "UF_LOGO_TOP"); ?> </span>
						<span class="b-logo__sub-name"><?= Option::get("askaron.settings", "UF_LOGO_BOTTOM"); ?></span>
					</div>
				</a>
				<nav class="footer__navigation site-nav site-nav--footer">
					<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "top",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "top"
	),
	false
); ?>
				</nav>
				<a class="btn btn--pink footer__find-button" href="/login/"><?= GetMessage("find_a_performer") ?></a>

				<div class="footer__contacts">
					<a class="footer__contacts-phone" href="tel:<?= BulldogUtils::numbersOnly(Option::get("askaron.settings", "UF_PHONE")) ?>"><?= Option::get("askaron.settings", "UF_PHONE"); ?></a>
					<?/*?><a class="footer__contacts-modal" href="javascript:void(0)"><?= GetMessage("order_a_call") ?></a><?*/?>
				</div>
			</div>
			<div class="footer__middle">
				<div class="footer__apps">
					<? if (Option::get("askaron.settings", "UF_APP_STORE_LINK") != "") : ?>
						<a class="footer__apps-item footer__apps-item--apple" href="<?= Option::get("askaron.settings", "UF_APP_STORE_LINK") ?>" target="_blank" title="<?= GetMessage("APP_STORE_LINK") ?>"></a>
					<? endif ?>
					<? if (Option::get("askaron.settings", "UF_GOOGLE_PLAY_LINK") != "") : ?>
						<a class="footer__apps-item footer__apps-item--google" href="<?= Option::get("askaron.settings", "UF_GOOGLE_PLAY_LINK") ?>" target="_blank" title="<?= GetMessage("GOOGLE_PLAY_LINK") ?>"></a>
					<? endif ?>
				</div>

				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom-right",
					array(
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						"CHILD_MENU_TYPE" => "bottom_right",	// Тип меню для остальных уровней
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
							0 => "",
						),
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"ROOT_MENU_TYPE" => "bottom_right",	// Тип меню для первого уровня
						"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
					),
					false
				); ?>
			</div>

			<div class="footer__bottom">
				<span class="footer__copyright"><?= Option::get("askaron.settings", "UF_COPYRIGHT").date('Y') ?></span>
				<a class="footer__email-link" href="mailto:<?= Option::get("askaron.settings", "UF_MAIL") ?>" title="<?= GetMessage("our_mail") ?>">
					<?= Option::get("askaron.settings", "UF_MAIL") ?>
				</a>
				<div class="footer__created">
					<?= GetMessage("magwai_created") ?>
					<a class="magwai-link" href="//magwai.ru" target="_blank" title="<?= GetMessage("magwai_title") ?>">
						<?= GetMessage("magwai") ?>
					</a>
				</div>
			</div>
		</div>
	</footer>
<? endif ?>
</div>


<div class="visuallyhidden" data-svg-path="<?= SITE_TEMPLATE_PATH ?>/img/theme/sprite.symbol.svg"></div>

<? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/vendors.js"); ?>
<? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js?1604899873915"); ?>
<? if ($USER->IsAuthorized()) : ?>
	<? Asset::getInstance()->addJs("/local/templates/main/js/chat/socket.io.min.js"); ?>
	<? Asset::getInstance()->addJs("/local/templates/main/js/chat/client.js"); ?>
	<script>
		var ChatSender = new Object();
		<? $data = Site\App\UserLicense::getLicenseDate(); ?>
		ChatSender.MY_ID = "<?= $USER->GetID() ?>";
		ChatSender.DATA = '<?= $data?>';
		ChatSender.MY_TOKEN = "<?= md5($USER->GetID() . $data . '-bulldog52') ?>";
		ChatSender.TYPE_USER = "<?= AccountAccess::$typeUser?>";
	</script>
<? endif ?>
<? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app-template.js"); ?>
<? Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/update.js"); ?>
</body>

</html>