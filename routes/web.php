<?php

use WalnutBread\Routing\Route;

Route::add('get', '/', '\App\Controllers\IndexController::index');

Route::run();