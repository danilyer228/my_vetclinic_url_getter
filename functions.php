<?php
require_once 'vendor/autoload.php';

if (!getenv("MYSQL_HOST")) { //is variable not set by docker
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

function db() {
    return new \Danilyer\VmMobilka\DBProvider(
        $dbhost = getenv("MYSQL_HOST"),
        $dbuser = getenv("MYSQL_USER"),
        $dbpass = getenv("MYSQL_PASSWORD"),
        $dbname = getenv("MYSQL_DATABASE")
    );
}

function buildAppUrl($token) {
    return "https://play.google.com/store/apps/details?id=com.danilyer.myvetclinic&hl=ru&ah=kC71M8jgXD5Oi9AcGFFKTEq_0cE&referrer=" . $token;
}