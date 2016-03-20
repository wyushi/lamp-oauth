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

$mw = function ($request, $response, $next) use ($app) {

    echo "<pre>";
    print_r($request->getAttribute('name'));
    echo "</pre>";


    echo "---token---<br/>";
    $oauthReq = OAuth2\Request::createFromGlobals();
    $server = $app->oauthServer;

    if (!$server->verifyResourceRequest($oauthReq)) {
        $server->getResponse()->send();
        $response->getBody()->write(json_encode([
            "message"=>"not auth"
        ]));
        return $response;
    }
    $tokenData = $server->getAccessTokenData($oauthReq);
    $_SERVER['PHP_AUTH_USER'] = $tokenData['user_id'];

    $response = $next($request, $response);
    return $response;
};

$app->get('/users/{name}', function ($request, $response, $args) {
    $authUser = $_SERVER['PHP_AUTH_USER'];
    echo "<pre>";
    print_r($_SERVER['PHP_AUTH_USER']);
    echo "</pre>";

    $model = new User();
    $username = $request->getAttribute('name');
    print_r($username);
    $user = $model->getUserByName($username);
    $response->getBody()->write(json_encode($user));
    return $response;
})->add($mw);
