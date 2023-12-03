<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

global $loginPage;
$loginPage = true;

// $APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
// 	"LEVEL"	=>	"3",
// 	"COL_NUM"	=>	"2",
// 	"SHOW_DESCRIPTION"	=>	"Y",
// 	"SET_TITLE"	=>	"Y",
// 	"CACHE_TIME"	=>	"36000000"
// 	)
// );
?>
      <div class="not-found">
        <div class="wrap wrap--limited wrap--relative">
          <ul class="parallax-scene js-scene" data-relative-input="true" aria-hidden="true">
            <li class="parallax-layer" data-depth="-0.2"><span class="parallax-particle parallax-particle--light-green not-found__particle not-found__particle--light-green"></span>
            </li>
            <li class="parallax-layer" data-depth="0.3"><span class="parallax-particle parallax-particle--pink not-found__particle not-found__particle--pink"></span>
            </li>
            <li class="parallax-layer" data-depth="-0.1"><span class="parallax-particle parallax-particle--steelblue not-found__particle not-found__particle--steelblue"></span>
            </li>
          </ul>
          <div class="not-found__wrapper">
            <h1 class="not-found__title">Error</h1>
            <div class="not-found__error"><span class="not-found__number">4</span><span class="not-found__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/theme/404.png" alt><span class="decor not-found__decor" aria-hidden="true"><img src="img/theme/decor-404.svg" alt></span></span><span class="not-found__number">4</span>
            </div><a class="btn btn--yellow not-found__link" href="/">Home</a><span class="decor not-found__waves" aria-hidden="true"><svg role="img" width="1em" height="1em"><use xlink:href="#si-decor-waves-gray"/></svg></span>
          </div>
        </div>
      </div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>