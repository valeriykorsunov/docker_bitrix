<?

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

use Account\UserInfo;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>


<div class="personal-area__content personal-area__content--pr">
	<h1 class="h5 personal-area__title"><?= $arParams["TITLE"]?></h1>
	<div class="js-scroll-block personal-area__scroll-block personal-area__scroll-block--pr-40">
		<form class="form js-notification-form" method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			
			<div class="b-notification-table">
				<div class="b-notification-table__header">
					<div class="b-notification-table__row">
						<div class="b-notification-table__cell b-notification-table__cell--header">alert</div>
						<div class="b-notification-table__cell b-notification-table__cell--header">e-mail</div>
						<?/*?><div class="b-notification-table__cell b-notification-table__cell--header">sms</div><?*/?>
					</div>
				</div>
				<div class="b-notification-table__body">

					<div class="b-notification-table__row">
						<div class="b-notification-table__cell">Receipt of a new application</div>
						<div class="b-notification-table__cell b-notification-table__cell--control">
							<label class="ui-checkbox ui-checkbox--dimmed">
								<input class="fields boolean" type="hidden" value="0" name="UF_NEW_APLICATION_EMAIL">
								<input value="1" class="visuallyhidden ui-checkbox__input" type="checkbox" name="UF_NEW_APLICATION_EMAIL"
									<?if($arResult["arUser"]["UF_NEW_APLICATION_EMAIL"] == 1) echo "checked";?> >
								<i class="ui-checkbox__icon">
									<svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg>
								</i>
							</label>
						</div>
						<?/*
						<div class="b-notification-table__cell b-notification-table__cell--control">
							<label class="ui-checkbox ui-checkbox--dimmed">
								<input class="visuallyhidden ui-checkbox__input" type="checkbox" name="notification-2-sms" checked="checked"><i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i>
							</label>
						</div>
						*/?>
					</div>

					<div class="b-notification-table__row">
						<div class="b-notification-table__cell">New posts in online chat</div>
						<div class="b-notification-table__cell b-notification-table__cell--control">
							<label class="ui-checkbox ui-checkbox--dimmed">
								<input class="fields boolean" type="hidden" value="0" name="UF_NEW_MES_ONLINE_EMAIL">
								<input value="1" class="visuallyhidden ui-checkbox__input" type="checkbox" name="UF_NEW_MES_ONLINE_EMAIL" <?if($arResult["arUser"]["UF_NEW_MES_ONLINE_EMAIL"] == 1) echo "checked";?>>
								<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i>
							</label>
						</div>
					</div>

					<div class="b-notification-table__row">
						<div class="b-notification-table__cell">Newsletter and articles</div>
						<div class="b-notification-table__cell b-notification-table__cell--control">
							<label class="ui-checkbox ui-checkbox--dimmed">
								<input class="fields boolean" type="hidden" value="0" name="UF_NEWS_ARTICL_EMAIL">
								<input value="1" class="visuallyhidden ui-checkbox__input" type="checkbox" name="UF_NEWS_ARTICL_EMAIL" <?if($arResult["arUser"]["UF_NEWS_ARTICL_EMAIL"] == 1) echo "checked";?>> 
								<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i>
							</label>
						</div>
					</div>

					<div class="b-notification-table__row">
						<div class="b-notification-table__cell">The emergence of new materials and tests</div>
						<div class="b-notification-table__cell b-notification-table__cell--control">
							<label class="ui-checkbox ui-checkbox--dimmed">
								<input class="fields boolean" type="hidden" value="0" name="UF_NEW_MATERIAL_TEST_EMAIL">
								<input value="1" class="visuallyhidden ui-checkbox__input" type="checkbox" name="UF_NEW_MATERIAL_TEST_EMAIL" <?if($arResult["arUser"]["UF_NEW_MATERIAL_TEST_EMAIL"] == 1) echo "checked";?>> 
								<i class="ui-checkbox__icon"><svg role="img" width="1em" height="1em">
										<use xlink:href="#si-icon-check" />
									</svg></i>
							</label>
						</div>
					</div>
 
				</div>
			</div>
			<input class="btn btn--yellow" type="submit" name="save" value="Save settings">
		</form>
	</div>
</div>