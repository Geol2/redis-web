<?php

namespace App\Controllers;

use WalnutBread\Databases\DatabaseAdaptor;
use WalnutBread\Redis\RedisAdapter;
use WalnutBread\Time\ExecTime;

class RunController
{
    public static function run() {
        @set_time_limit($_POST['time']);
        $time = new ExecTime(['run']);
        $time->start();

        DatabaseAdaptor::setup("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_UID'], $_ENV['DB_PWD']);
        RedisAdapter::setup($_ENV['REDIS_HOST'],$_ENV['REDIS_PORT'], $_ENV['REDIS_AUTH'], 0);
        $redis = new RedisAdapter();

        $keywordRows = DatabaseAdaptor::getAll("SELECT * FROM tb_keyword");
        $memberCount = count($keywordRows);
        $incrCount = 0;
        for($i = 0; $i < $memberCount; $i++) {

            $redis->zIncrBy("popular", 1, $keywordRows[$i]->keyword);
            $data['incr_count'] = ++$incrCount;
        }
        $time->end();
        $run_time = $time->diff("run");
        $data['spend_time'] = $run_time;

        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}