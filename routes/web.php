<?php

use WalnutBread\Routing\Route;

Route::add('get', '/', '\App\Controllers\IndexController::index');

Route::add('post', '/keyword/list', '\App\Controllers\KeywordController::list');
Route::add('post', '/keyword/search', '\App\Controllers\KeywordController::search');

Route::run();