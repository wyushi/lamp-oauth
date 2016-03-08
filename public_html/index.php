<?php
require '../vendor/autoload.php';
require '../config.php';

$app = new \Slim\App(array(
    'debug' => true
));

$routers = glob('../routers/*.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();
