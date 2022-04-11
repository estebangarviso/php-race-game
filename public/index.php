<?php

use App\Core\Application;

require Application::$ROOT_DIR . '/vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', function () {
    return 'Hello World';
});


$app->run();
