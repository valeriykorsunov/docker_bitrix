<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}
?>
<? //if($arAuthServices):
?>


		<? foreach ($arAuthServices as $service) : ?>
			<?
			if (($arParams["~FOR_SPLIT"] == 'Y') && (is_array($service["FORM_HTML"])))
				$onClickEvent = $service["FORM_HTML"]["ON_CLICK"];
			else
				$onClickEvent = "onclick=\"BxShowAuthService('" . $service['ID'] . "', '" . $arParams['SUFFIX'] . "')\"";
			?>
			<? //Debug::dumpToFile($service); ?>

			<? switch ($service["ID"])
			{
				case "Facebook":
			?>
					<li class="b-social-list__item">
						<a title="<?= htmlspecialcharsbx($service["NAME"]) ?>" class="b-social-list__link b-social-list__link--fb" href="javascript:void(0)" <?= $onClickEvent ?> id="bx_auth_href_<?= $arParams["SUFFIX"] ?><?= $service["ID"] ?>">
							<svg role="img" width="1em" height="1em">
								<use xlink:href="#si-soc-fb" />
							</svg>
						</a>
					</li>
			<?
					break;
			};
			?>
		<? endforeach ?>

<? //endif
?>
