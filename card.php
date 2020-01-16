<?php
require_once('init.php');
$genreId = "101287";
$db = new database();
$rank = $db->getRank($genreId);

foreach($rank as $data) {
	$item = $db->getItem($data['item_id']);
	echo '<div class="card1">';
	echo '<a href="'.$item['itemUrl'].'"></a>';
	echo '<div class="top1">';
	echo $data['rank'].'位';
	echo '</div>';
	echo '<div class="img">';
	echo '<img src="'.$item['imageUrl'].'" class="image1">';
	echo '</div>';
	if(mb_strlen($item['item_name']) <= 60) {
		echo '<p class="title1">'.mb_substr($item['item_name'],0,60).'</p>';
	} else {
		echo '<p class="title1">'.mb_substr($item['item_name'],0,57).'...</p>';
	}
	
	//echo '<p class="content1">'.'sample'.'</p>';
	echo '</div>';
}
