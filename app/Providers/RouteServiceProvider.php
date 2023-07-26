<?php

namespace App\Providers;

use WalnutBread\Routing\Route;
use WalnutBread\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public static function register(): void
    {
        require_once dirname(__DIR__, 2)."/routes/web.php";
    }

    public static function boot(): void
    {
        Route::run();
    }
}