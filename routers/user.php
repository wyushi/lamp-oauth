<?php
use models\User;

$app->get('/users', function ($request, $response, $args) {
	$model = new User();
	$users = $model->getUsers();
    $response->getBody()->write(json_encode($users));
    return $response;
});