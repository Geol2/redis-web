<?php

use WalnutBread\Routing\Route;

Route::add('get', '/', '\App\Controllers\IndexController::index');

Route::add('get', '/keyword/list', '\App\Controllers\KeywordController::viewList');
Route::add('post', '/keyword/list', '\App\Controllers\KeywordController::list');
Route::add('post', '/keyword/search', '\App\Controllers\KeywordController::search');

Route::add('post', '/run', '\App\Controllers\RunController::run');
Route::add('get', '/run/time', '\App\Controllers\RunController::time');

Route::run();