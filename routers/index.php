<?php

$app->get('/', function ($request, $response, $args) {
  return $this->view->render($response, 'index.html', [
    'name' => "Yushi Wang"
  ]);
});

$app->get('/api', function ($request, $response, $args) {
    $response->getBody()->write("Hello API");
    return $response;
});

$app->get('/php', function ($request, $response, $args) {
    $response->getBody()->write(php_sapi_name());
    $response->getBody()->write(phpinfo());
    return $response;
});
