<?php
namespace App\Controllers;

class IndexController
{
    public static function index() {
        include_once dirname(__DIR__, 2)."/resource/index.php";
    }
}