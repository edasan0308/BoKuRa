<meta charset="UTF-8">
<?php
require_once dirname(__FILE__).'/SDK/rws-php-sdk-1.1.0/config.php';
require_once dirname(__FILE__).'/SDK/rws-php-sdk-1.1.0/autoload.php';
 
$client = new RakutenRws_Client();
// アプリID (デベロッパーID) をセットします
$client->setApplicationId('1069767986440472270');
 
// 楽天商品ランキングAPIでは operation として 'IchibaItemRanking' を指定してください。
$response = $client->execute('IchibaItemRanking', array(
  'genreId' => '101287'
));
 
// レスポンスが正常かどうかを isOk() で確認することができます
if ($response->isOk()) {
    // 配列アクセスで情報を取得することができます。
    echo $response['']."ランキングタイトル<br>";
 
    // foreach で商品情報を順次取得することができます。
    foreach ($response as $item) {
        echo "<a href=\"".$item['affiliateUrl']."\">".$item['rank']."位:".$item['itemName']."<br>";
		echo "<a href=\"".$item['itemUrl']."\"><img src=\"".$item['mediumImageUrls'][0][imageUrl]."\" alt=\"".$item['itemName']."\"><br>";
    }
} else {
    // getMessage() でレスポンスメッセージを取得することができます
    echo 'Error:'.$response->getMessage();
}

