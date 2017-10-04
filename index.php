<?php

//define('BASE_PASS', realpath(__DIR__ . '/..') . '/');
define("TYPE_DB", "mysql");
//define('TYPE_DB', "postgre");

include_once './config/config.php';
include_once './libs/Sql.php';
include_once './libs/DB.php';
include_once './libs/MySql.php';
include_once './libs/Postgres.php';

//$app = new DB($config['DB'][TYPE_DB]);

//$res = $app->select("id, name")->from("MY_TEST")->where(['data = ? ',  'sasha'])->exec();


$app = new DB($config['DB'][TYPE_DB]);
$res = $app->select('*')->from('MY_TEST')->where(['data = ? ', "qwerty"])->exec();
//print_r($this->query);
//$res = $app->insert(["`key`", "`data`"], ["%%%%%%", "qwerty2222"])->from("MY_TEST")->exec();

//$res = $app->update(["`key`", "`data`"], ["$$$$$$$", "!!!!!"])->from("MY_TEST")->where(['id = ? ', 27])->exec();

//$res = $app->delete()->from("MY_TEST")->where(['data = ? ', "www"])->exec();
//var_dump($res);
include_once './templates/index.php';
