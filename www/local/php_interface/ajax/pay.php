<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

echo"<pre>"; var_dump(date("Y-m-d H:i:s")); echo "</pre>";

$data = [
    "transactionReference" => "T_".md5(date("Y-m-d H:i:s")),
    "merchant" =>
    [
        "entity" => "PO4050873053"
	],
    "narrative" =>
    [
        "line1" => "Bobby The Bulldog"
	],
    "value" =>
    [
        "currency" => "GBP",
        "amount" => 50
	]
];

echo"<pre>"; var_dump($data); echo "</pre>"; 

$ch = curl_init("https://try.access.worldpay.com/payment_pages");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Authorization: Basic '. base64_encode('TATIANASHTYKOVA868' . ":" . 'Barsiksht79.'),
	// 'Authorization: Basic '. 'TATIANASHTYKOVA868' . ":" . 'Barsiksht79.',
	// 'Authorization: Basic '. base64_encode('admin@bobbythebull' . ":" . 'Maksiksht79.'),
	'Content-Type: application/vnd.worldpay.payment_pages-v1.hal+json',
	'Accept: application/vnd.worldpay.payment_pages-v1.hal+json',
]);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // иначе curl_exec() возвращает true в случае успешного выполнения или false в случае возникновения ошибки

$res = curl_exec($ch);
if(curl_error($ch)){
	// \Bitrix\Main\Diag\Debug::dumpToFile(curl_error($ch) ,'*'.date('Y-m-d H:i:s').'*'. PHP_EOL .__FILE__);
	echo"<pre>"; var_dump(curl_error($ch)); echo "</pre>";
}
curl_close($ch);

echo"<pre>"; var_dump($res); echo "</pre>"; exit;