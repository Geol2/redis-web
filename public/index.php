<?php

use Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

$minPhp = "7.4";
if(version_compare(PHP_VERSION, $minPhp, '<=')) {
    var_dump("not support PHP version. Please update PHP :)");
    exit();
}

# 불변객체
$dotenv = Dotenv::createUnsafeImmutable(__DIR__."/../");
$dotenv->load();

$app = require __DIR__."/../bootstrap/app.php";
$app->boot();
