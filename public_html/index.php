<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

function getConnection() {
    $dbhost="localhost";
    $dbuser="example_user";
    $dbpass="Admin2015";
    $dbname="exampleDB";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

$conn = getConnection();

$app = new \Slim\App();

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello Wrold");
    return $response;
});

$app->get('/api', function ($request, $response, $args) {
    $response->getBody()->write("Hello API");
    return $response;
});
$app->run();