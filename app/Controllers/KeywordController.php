<?php

namespace App\Controllers;

use WalnutBread\Redis\RedisAdapter;
use WalnutBread\Time\ExecTime;

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
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit();
    }

    public static function list() {
        $data = [];
        $i = 1;

        $exec_time = new ExecTime(['list']);
        $exec_time->start();
        # connection
        RedisAdapter::setup($_ENV['REDIS_HOST'],$_ENV['REDIS_PORT'], $_ENV['REDIS_AUTH'], 0);

        $redis = new RedisAdapter();
        $arr = $redis->zRange('popular', -100, -1, true);
        $arr = array_reverse($arr);
        foreach($arr as $key => $value) {
            $data['ranking'][] = [
                "rank" => $i,
                "keyword" => $key,
                "score" => $value
            ];
            $i++;
        }
        $exec_time->end();
        $data['spend_time'] = $exec_time->diff("list");

        # data
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}