<?php

define('BASE_PASS', realpath(__DIR__ . '/..') . '/');
//define("TYPE_DB", "mysql");
define('TYPE_DB', "postgre");

include_once './config/config.php';
include_once './libs/sql.php';

$pg = new Sql($config['db'][TYPE_DB]);

$res = $pg->select("id, name")->from("my_test")->where('name' . ' = ' . '\'sasha\'')->exec();


//$app = new Sql($config['db'][TYPE_DB]);
//$res = $app->select('*')->from('MY_TEST')->where(['data = ? ', "qwerty"])->exec();

//$res = $app->insert(["`key`", "`data`"], ["%%%%%%", "qwerty2222"])->from("MY_TEST")->exec();

//$res = $app->update(["`key`", "`data`"], ["$$$$$$$", "!!!!!"])->from("MY_TEST")->where(['id = ? ', 27])->exec();

//$res = $app->delete()->from("MY_TEST")->where(['data = ? ', "www"])->exec();
//var_dump($res);
include_once 'templates/index.php';
