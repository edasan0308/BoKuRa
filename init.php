<?php

//database
// データベース接続ユーザー名
define("_DB_USER", "LAA1067630");

// データベース接続パスワード
define("_DB_PASS", "imaeda0568");

// データベースホスト名
define("_DB_HOST", "mysql137.phy.lolipop.lan");

// データベース名
define("_DB_NAME", "LAA1067630-rakutenrank");

// データベースの種類
define("_DB_TYPE", "mysql");

// データソースネーム
define("_DSN", _DB_TYPE . ":host=" . _DB_HOST . ";dbname=" . _DB_NAME. ";charset=utf8");

//rakutenAPI
define("_RAKUTEN_DIR", dirname(__FILE__)."/SDK/rws-php-sdk-1.1.0/");

//
define("_CLASS_DIR",dirname(__FILE__)."/class/");


define("_ROOT_DIR",dirname(__FILE__));

require_once _RAKUTEN_DIR.'config.php';
require_once _RAKUTEN_DIR.'autoload.php';
require_once _CLASS_DIR.'dbinterface.php';
require_once _CLASS_DIR.'database.php';
