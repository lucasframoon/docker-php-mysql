<?php

define("URL_BASE", "localhost:45000");

define("SITE", "JUMP");

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "mysql",
    "port" => "3306",
    "dbname" => "myDb",
    "username" => "dba",
    "passwd" => "secret",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

function url($uri = null)
{
    if ($uri) {
        return URL_BASE . "/" . $uri;
    }
    return URL_BASE;
}
