<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER; ?>


<?
//$url = $APPLICATION->GetCurPageParam("id=45", array("id", "d"));
?>
<div class="reviews__top-list">
<form class="js-submit-on-change reviews__filter" action="/" method="GET">
	<div class="form-row">
		<div class="form-group form-group--half">
			<div class="select-style">
				<select onchange="reloadReviews(this);" class="js-select" name="time">
					<option <?=(!$_GET["time"] ? "selected" : "")?> value="<?=$APPLICATION->GetCurPageParam("", array("time"))?>">For all time</option>
					<option <?=($_GET["time"] == "week" ? "selected" : "")?> value="<?=$APPLICATION->GetCurPageParam("time=week", array("time"))?>">For a week</option>
					<option <?=($_GET["time"] == "month" ? "selected" : "")?> value="<?=$APPLICATION->GetCurPageParam("time=month", array("time"))?>">For a month</option>
				</select>
			</div>
		</div>
		<div class="form-group form-group--half">
			<div class="select-style">
				<select onchange="reloadReviews(this);" class="js-select-stars" name="appraisal">
					
					<option <?=(!$_GET["stars"] ? "selected" : "")?>
						value="<?=$APPLICATION->GetCurPageParam("", array("stars"))?>" 
						data-stars="0" data-quantity="All reviews">All reviews</option>
					<?for( $i=1; $i <= 5; $i++):?>
						<option 
						<?=($_GET["stars"]==$i ? "selected" : "")?>
						value="<?=$APPLICATION->GetCurPageParam("stars=".$i, array("stars"))?>" 
						data-stars="<?=$i?>" data-quantity="<?=($arResult["STARS"][$i] ? $arResult["STARS"][$i] : "0")?>"><?=$i?> star (<?=($arResult["STARS"][$i] ? $arResult["STARS"][$i] : "0")?>)</option>
					<?endfor?>
				</select>
			</div>
		</div>
	</div>
</form>
<?// if ($USER->IsAuthorized()): ?>
	<a class="btn btn--yellow js-ajax-modal" href="?reviewsPopUp=y">Give feedback</a>
<?//endif?>
</div>