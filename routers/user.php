<?php
use models\User;

$app->get('/users', function ($request, $response, $args) {
    $model = new User();
    $users = $model->getUsers();
    $response = $response->withHeader('Content-type', 'application/json');
    $response->getBody()->write(json_encode($users));
    return $response;
});

$app->post('/users', function ($request, $response, $args) {
    $parsed = $request->getParsedBody();
    $model = new User();
    $parsed['password'] = hash("sha1", $parsed['password']);
    $user = $model->insertUser($parsed);
    $response = $response->withHeader('Content-type', 'application/json');
    $response->getBody()->write(json_encode($user));
    return $response;
});
