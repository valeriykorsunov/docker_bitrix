<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>
<p>You are registered and successfully authorized.</p>
 
<p>Use the administrative panel in the upper part of the screen for quick access to the structural control functions and information filling of the site.The set of the upper panel buttons differs for various sections of the site.So individual sets of actions are provided for managing the static contents of the pages, dynamic publications (news, catalog, photo gallery), etc..</p>
 
<p><a href="<?=SITE_DIR?>">Go back to main page</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>