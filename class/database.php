<?php

class database extends dbinterface
{
	
	public function addData($rankData)
	{
		try 
		{
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO rank (age_id, genre_id, item_id, sex_id, lastBuildDate, rank, affiliateRate, reviewCount, reviewAverage)
            VALUES ( :age_id, :genre_id, :item_id, :sex_id, :lastBuildDate, :rank, :affiliateRate, :reviewCount, :reviewAverage)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':age_id',			$rankData['age_id'],   		PDO::PARAM_INT );
            $stmh->bindValue(':genre_id',		$rankData['genre_id'],  	PDO::PARAM_INT );
            $stmh->bindValue(':item_id',		$rankData['item_id'],		PDO::PARAM_STR );
            $stmh->bindValue(':sex_id',			$rankData['sex_id'],		PDO::PARAM_INT );
            $stmh->bindValue(':lastBuildDate',	$rankData['lastBuildDate'],	PDO::PARAM_STR );
            $stmh->bindValue(':rank',			$rankData['rank'],			PDO::PARAM_INT );
            $stmh->bindValue(':affiliateRate',	$rankData['affiliateRate'],	PDO::PARAM_INT );
            $stmh->bindValue(':reviewCount',	$rankData['reviewCount'],	PDO::PARAM_INT );
            $stmh->bindValue(':reviewAverage',	$rankData['reviewAverage'],	PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
        }
		catch (PDOException $Exception)
		{
            $this->pdo->rollBack();
            print "DBランキング登録エラー：" . $Exception->getMessage();
        }
	}
	
	public function addItem($itemData)
	{
		try 
		{
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO item (item_id, item_name, item_price, taxFlag, itemUrl, imageFlag, imageUrl)
            VALUES ( :item_id, :item_name, :item_price, :taxFlag, :itemUrl, :imageFlag, :imageUrl)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':item_id',		$itemData['item_id'],   	PDO::PARAM_STR );
            $stmh->bindValue(':item_name',		$itemData['item_name'],  	PDO::PARAM_STR );
            $stmh->bindValue(':item_price',		$itemData['item_price'],	PDO::PARAM_INT );
            $stmh->bindValue(':taxFlag',		$itemData['taxFlag'],		PDO::PARAM_INT );
            $stmh->bindValue(':itemUrl',		$itemData['itemUrl'],		PDO::PARAM_STR );
            $stmh->bindValue(':imageFlag',		$itemData['imageFlag'],		PDO::PARAM_INT );
			$stmh->bindValue(':imageUrl',		$itemData['imageUrl'],		PDO::PARAM_STR );
            $stmh->execute();
            $this->pdo->commit();
        }
		catch (PDOException $Exception)
		{
            $this->pdo->rollBack();
            print "DBランキング登録エラー：" . $Exception->getMessage();
        }
	}
	
	public function checkRank($rankData)
	{
		try
		{
			$sql= "SELECT * FROM rank WHERE genre_id = :genre_id AND age_id = :age_id AND sex_id = :sex_id AND lastBuildDate = :lastBuildDate AND item_id = :item_id";
			$stmh = $this->pdo->prepare($sql);
			$stmh->bindValue(':genre_id',  		$rankData['genre_id'], 		PDO::PARAM_INT );
			$stmh->bindValue(':age_id',  		$rankData['age_id'], 		PDO::PARAM_INT );
			$stmh->bindValue(':sex_id',  		$rankData['sex_id'], 		PDO::PARAM_INT );
			$stmh->bindValue(':lastBuildDate',  $rankData['lastBuildDate'], PDO::PARAM_STR );
			$stmh->bindValue(':item_id',  		$rankData['item_id'], 		PDO::PARAM_STR );
			$stmh->execute();
		}
		catch (PDOException $Exception)
		{
			print "DB応答エラー：" . $Exception->getMessage();
			return "";
		}
		return $stmh->fetch();
	}
	
	public function getItem($item_id)
	{
		try
		{
            $sql= "SELECT * FROM item WHERE item_id = :item_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':item_id',  $item_id, PDO::PARAM_STR );
            $stmh->execute();
        }
		catch (PDOException $Exception)
		{
            print "DB応答エラー：" . $Exception->getMessage();
			return "";
        }
		return $stmh->fetch();
	}
	
	public function getRank($genre_id)
	{
		try
		{
			$sql = "SELECT * FROM rank WHERE genre_id = :genre_id ORDER BY lastBuildDate DESC, rank ASC LIMIT 30";
			$stmh = $this->pdo->prepare($sql);
			$stmh->bindValue(':genre_id',	$genre_id,	PDO::PARAM_INT );
			$stmh->execute();
		}
		catch (PDOException $Exception)
		{
			print "DB応答エラー:".$Exception->getMessage();
			return "`
			";
		}
		return $stmh;
	}
}