<?php

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello Wrold");
    $logger = $this->logger;
    $logger->addDebug('hello world !!!');
    return $response;
});

$app->get('/api', function ($request, $response, $args) {
    $response->getBody()->write("Hello API");
    return $response;
});
