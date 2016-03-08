<?php

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hello Wrold");
    return $response;
});

$app->get('/api', function ($request, $response, $args) {
    $response->getBody()->write("Hello API");
    return $response;
});
