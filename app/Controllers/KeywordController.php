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
        $exec_time = new ExecTime(['search']);
        $exec_time->start();

        # connection
        RedisAdapter::setup($_ENV['REDIS_HOST'],$_ENV['REDIS_PORT'], $_ENV['REDIS_AUTH'], 0);

        $redis = new RedisAdapter();
        $redis->zIncrBy("popular", 1, $_POST['keyword']);
        $value = $redis->zScore('popular', $_POST['keyword']);
        $exec_time->end();
        # data
        $data['score'] = $value;
        $data['spend_time'] = $exec_time->diff("search");
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
        $total_keyword_count = count($redis->zRange('popular', 0, -1, false));

        $exec_time->end();
        $data['spend_time'] = $exec_time->diff("list");
        $data['total_keyword_count'] = $total_keyword_count;
        # data
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}