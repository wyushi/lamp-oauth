<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
require 'vendor/autoload.php';

error_log("start!");
// Create and configure Slim app
$app = new \Slim\App;

// Define app routes
$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello world!!!!");
});

// Run app
$app->run();