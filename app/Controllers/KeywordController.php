<?php

namespace App\Controllers;

use WalnutBread\Redis\RedisAdapter;

class KeywordController
{
    public static function index() {
        include_once dirname(__DIR__, 2)."/resource/keyword.php";
    }

    public static function search() {
        $data = [];
        # connection
        RedisAdapter::setup($_ENV['REDIS_HOST'],$_ENV['REDIS_PORT'], $_ENV['REDIS_AUTH'], 0);

        $redis = new RedisAdapter();
        $value = $redis->zScore('popular', 'amet');
        # data
        $data['score'] = $value;
        $data['spend_time'] = 0;
        echo json_encode($data);
        exit();
    }

    public static function list() {

    }
}