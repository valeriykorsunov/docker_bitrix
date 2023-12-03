<?
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Application::getInstance()->getContext()->getRequest();
if ($request->getQuery("forgot_password") == "yes")
{
	$APPLICATION->IncludeComponent(
		"bitrix:system.auth.forgotpasswd",
		".default",
		array("AUTH_RESULT" => $APPLICATION->arAuthResult)
	);
	exit;
}

if ($USER->isAuthorized())
{
	LocalRedirect('/account/');
}

if ($request->getQuery("change_password") == "yes")
{
LocalRedirect("/login/changepasswd.php?".$_SERVER['QUERY_STRING']);
}

global $loginPage;
$loginPage = true;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");

$APPLICATION->SetTitle("Авторизация");
?>


<div style="margin-top:70px;" class="auth form_for_registration">
	<div class="wrap wrap--limited auth__wrapper">

		<ul class="parallax-scene js-scene" data-relative-input="true">
			<li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--light-green auth__particle auth__particle--light-green"></span>
			</li>
			<li class="parallax-layer" data-depth="0.2"><span class="parallax-particle parallax-particle--pink auth__particle auth__particle--pink"></span>
			</li>
		</ul>
			<? 
			$APPLICATION->IncludeComponent(
				"bitrix:system.auth.authorize",
				"",
				array(
					// "REGISTER_URL" => "register.php",
					"REGISTER_URL" => "",
					"FORGOT_PASSWORD_URL" => "",
					// "PROFILE_URL" => "profile.php",
					"PROFILE_URL" => "",
					"SHOW_ERRORS" => "Y"
				)
			); 
			?>


			<? $APPLICATION->IncludeComponent(
				"bitrix:main.register",
				"register",
				array(
					"USER_PROPERTY_NAME" => "",
					"SEF_MODE" => "Y",
					"SHOW_FIELDS" => array(
						"EMAIL",
						"NAME",
						"LAST_NAME",
						"LOGIN",
						"PASSWORD",
						"CONFIRM_PASSWORD",
						"GROUP_ID"
					),
					"REQUIRED_FIELDS" => array(),
					"AUTH" => "Y",
					"USE_BACKURL" => "Y",
					"SUCCESS_PAGE" => "",
					"SET_TITLE" => "Y",
					"USER_PROPERTY" => array(),
					"SEF_FOLDER" => "/",
					"VARIABLE_ALIASES" => array()
				)
			); ?>

	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>