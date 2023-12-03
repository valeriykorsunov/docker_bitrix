<?

use Bitrix\Main\Diag\Debug;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Safety and security");
$APPLICATION->SetTitle("Safety and security");


echo'
<div class="personal-area__content">
<h1 class="h5 personal-area__title">'.$APPLICATION->GetTitle().'</h1>
<div class="personal-area__gray-wrapper personal-area__gray-wrapper--no-pr">
  <div class="personal-area__grid">
';


$APPLICATION->IncludeComponent("bulldog:account.safety", "", array());


$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"change_your_password_executor",
	Array(
		"USER_PROPERTY_NAME" => "",
		"SET_TITLE" => "Y", 
		"AJAX_MODE" => "N", 
		"USER_PROPERTY" => Array(), 
		"SEND_INFO" => "Y", 
		"CHECK_RIGHTS" => "Y",  
		"AJAX_OPTION_JUMP" => "N", 
		"AJAX_OPTION_STYLE" => "Y", 
		"AJAX_OPTION_HISTORY" => "N" 
	)
);


echo '
</div>
</div>
</div>
';
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>