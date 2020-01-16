<?php
// 環境設定ファイルのロード
require_once("init.php");
//楽天APIのインスタンス生成
$client = new RakutenRws_Client();
//dbクラスインスタンス生成
$db = new database();
// アプリID (デベロッパーID) をセット
$client->setApplicationId(_RAKUTEN_APP_ID);
//アフィリエイトIDをセット						  
$client->setAffiliateId(_RAKUTEN_APP_AFFILITE_ID);

$genreId = "101287";
 
for($i=1; $i<6; $i++) {
	// 楽天商品ランキングAPIでは operation として 'IchibaItemRanking' を指定する
	$response = $client->execute('IchibaItemRanking', array(
	  'genreId' => $genreId,
		'page' => $i
	));

	// レスポンスが正常かどうかを isOk() で確認することができる
	if ($response->isOk()) {

		// foreach で商品情報を順次取得することができる。
		foreach ($response as $item) {

			//中身が空がどうか確認し、空の場合は指定されていない引数として考え、デフォルトIDに設定する
			if(empty($item['age'])){
				$item['age'] = 0;
			}
			if(empty($item['sex'])){
				$item['sex'] = 2;
			}

			//ランキングデータを連想配列で格納
			$rankData = array( 'age_id'=>$item['age'], 'genre_id'=>$genreId, 'item_id'=>$item['itemCode'], 'sex_id'=>$item['sex'], 'lastBuildDate'=>date('Y/m/d H:i',strtotime($response['lastBuildDate'])), 'rank'=>$item['rank'], 'affiliateRate'=>$item['affiliateRate'], 'reviewCount'=>$item['reviewCount'], 'reviewAverage'=>$item['reviewAverage']);

			if($db->checkRank($rankData)==NULL){
				//ランキングデータの追加
				$db->addData($rankData);
				echo 'INSERT RANKING<br>';
				print_r($rankData);
				echo '<br>';
			}

			//取得したアイテムがテーブルitemに登録されているかをitem_id(itemCode)を用いて確認、されていなければ新規登録する
			if($db->getItem($item['itemCode'])==NULL) {

				//アイテムデータを連想配列で格納
				$itemData = array( 'item_name'=>$item['itemName'],'item_price'=>$item['itemPrice'],'item_id'=>$item['itemCode'],'taxFlag'=>$item['taxFlag'],'itemUrl'=>$item['itemUrl'],'imageFlag'=>$item['imageFlag'],'imageUrl'=>$item['mediumImageUrls'][0]['imageUrl']);

				//アイテムを追加
				$db->addItem($itemData);
				echo 'INSERT ITEM<br>';
				print_r($itemData);
				echo '<br>';
			}

		}
	} else {
		// getMessage() でレスポンスメッセージを取得することができます
		echo 'Error:'.$response->getMessage();
	}
	
	sleep(2);
}
echo 'END'.date("Y/m/d H:i:s");
