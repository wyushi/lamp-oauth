<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
require '../vendor/autoload.php';

// Create and configure Slim app
$app = new \Slim\App();

// Define app routes
$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello World");
});

$app->get('/api', function ($request, $response, $args) {
    return $response->write("Hello API");
});

// Run app
$app->run();