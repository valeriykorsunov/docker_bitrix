<?

use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>


<div class="b-personal-active-test">
	<div class="h2 b-personal-active-test__name">Тест: <?= $arResult["TEST_NAME"] ?></div><span class="b-personal-active-test__progress">Question <span class="b-personal-active-test__progress-value"><?= $arResult['CURRENT']["Nomer"] ?></span> из <span class="b-personal-active-test__progress-value"><?= $arResult['Count'] ?></span></span>
	<div class="h6 b-personal-active-test__question"><?= $arResult['CURRENT']["NAME"] ?></div>
	<div class="b-personal-active-test__answers">
		<? foreach ($arResult['CURRENT']["PROP"]["VALUE"] as $key => $value) : ?>
			<? 
				$i++;
				$selectAns = false;
				if($arResult['CURRENT']["PROP"]["PROPERTY_VALUE_ID"][$key] === $arResult["idSelectAnsver"]["ID_ANSWER"])
				{
					$selectAns = true;
				}
					
			?>
			<label class="b-personal-active-test__answer">
				<input <?if($selectAns) echo "checked";?>
				class="visuallyhidden" type="radio" name="answer" data-valueID="<?= $arResult['CURRENT']["PROP"]["PROPERTY_VALUE_ID"][$key] ?>" data-value="<?= $value ?>" >
				<span class="b-personal-active-test__answer-toggle"><?= $i ?>. <?= $value ?></span>
			</label>
		<? endforeach ?>
	</div>
	<div class="b-personal-active-test__actions">
		<? if (isset($arResult['PREV']["ID"])) : ?>
			<button 
				data-prev="Y"
				data-questionID="<?= $arResult['CURRENT']["ID"] ?>" 
				data-questionIDnew="<?= $arResult['PREV']["ID"] ?>" 
				onclick="newQuestion(this)" 
				class="btn js-test-prev-question b-personal-active-test__button b-personal-active-test__button--prev">Previous question</button>
		<? endif ?>
		<? if (isset($arResult['NEXT']["ID"])) : ?>
			<button 
				data-questionID="<?= $arResult['CURRENT']["ID"] ?>" 
				data-question="<?= $arResult['CURRENT']["NAME"] ?>" 
				data-questionIDnew="<?= $arResult['NEXT']["ID"] ?>" 
				onclick="newQuestion(this)" 
				class="btn btn--yellow js-test-next-question b-personal-active-test__button b-personal-active-test__button--next">The next question</button>
		<?else:?>
			<button 
				data-questionID="<?= $arResult['CURRENT']["ID"] ?>" 
				data-question="<?= $arResult['CURRENT']["NAME"] ?>" 
				data-questionEnd="Y" 
				onclick="newQuestion(this)" 
				class="btn btn--yellow js-test-next-question b-personal-active-test__button b-personal-active-test__button--next">Last question</button>
		<?endif?>
	</div>
</div>