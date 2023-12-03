<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");
$APPLICATION->SetTitle("Test");


/************************************************************************************/

?>
<script async
  src="https://js.stripe.com/v3/buy-button.js">
</script>

<stripe-buy-button
  buy-button-id="buy_btn_1OJLtDKCC66m01D0HArMJ8zg"
  publishable-key="pk_test_51OCc31KCC66m01D0qRBXT1ZdNj6cRisrVWlg1nyNAVjPICjBbamCyArsWLAsEG4fSRKE3q8lK8cuQNeCfSnmCaON00baSV9ohB"
>
</stripe-buy-button>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>