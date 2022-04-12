<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\SiteController;
use App\Core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/race', [SiteController::class, 'race']);

$app->run();
