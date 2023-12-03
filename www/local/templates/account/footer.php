<?

use Account\AccountAccess;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

</div>
</div>


<div class="visuallyhidden" data-svg-path="/local/templates/main/img/theme/sprite.symbol.svg"></div>
<?
Asset::getInstance()->addJs("/local/templates/main/js/vendors.js");
Asset::getInstance()->addJs("/local/templates/main/js/main.js?1604899873915");?>
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
<?
	Asset::getInstance()->addJs("/local/templates/main/js/app-template.js");
	Asset::getInstance()->addJs("/local/templates/main/js/update.js");
?>
</body>
</html>