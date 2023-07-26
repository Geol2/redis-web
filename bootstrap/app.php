<?php

use App\Providers\RouteServiceProvider;
use WalnutBread\Application;

$app = new Application([
    RouteServiceProvider::class
]);

return $app;