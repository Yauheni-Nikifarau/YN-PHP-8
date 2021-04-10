<?php
$curlQuery = curl_init();
$curlOptions = [
    CURLOPT_URL => 'https://fakestoreapi.com/products/category/electronics',
    CURLOPT_RETURNTRANSFER => 1
];
curl_setopt_array($curlQuery, $curlOptions);
$curlResult = curl_exec($curlQuery);
curl_close($curlQuery);
$curlResult = json_decode($curlResult);
$changedArray = [];
foreach ($curlResult as $good) {
    $obj = ['image'=>$good->image, 'title'=>$good->title, 'description'=>$good->description, 'price'=>$good->price];
    $changedArray[$good->id] = (object) $obj;
}

$curlResult = serialize($changedArray);
$fd = fopen($_SERVER['DOCUMENT_ROOT'].'/app/data/goods.txt', 'w+b');
fwrite($fd, $curlResult);
fclose($fd);
