<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \App\Core\Application(dirname(__DIR__));

$app->router->get('/', [\App\Controllers\SiteController::class, 'home']);
$app->router->post('/race', [\App\Controllers\SiteController::class, 'race']);

$app->run();
