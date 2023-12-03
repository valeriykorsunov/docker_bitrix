<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var \CMain $APPLICATION */
/** @var \CUser $USER */
/** @var \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
// echo"<pre>"; var_dump($arResult); echo "</pre>"; exit;
?>
    <script type="application/ld+json">
		{
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
		<? foreach($arResult as $key => $value): ?>
			{
			"@type": "ListItem",
			"position": <?= $key+1?>,
			"name": "<?= $value["NAME"]?>",
			"item": "https://bobbythebulldog.com<?= $value["LINK"]?>"
		},
	  <? endforeach; ?>
	  ]
    }
    </script>


	
