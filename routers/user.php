<?php
use models\User;

$app->get('/users', function ($request, $response, $args) {
    $model = new User();
    $users = $model->getUsers();
    return $this->view->render($response, 'demo.html', [
      'users' => $users
    ]);
});

$app->get('/signup', function ($request, $response, $args) {
    return $this->view->render($response, 'signup.html', [
        'title' => "Signup An User"
    ]);
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
    $model = new User();
    $username = $request->getAttribute('name');
    $user = $model->getUserByName($username);
    if (!$user) {
        $response->getBody()->write(json_encode([
            "error" => "No such user"
        ]));
        return $response;
    }
    if ($authUser !== $username) {
        $response->getBody()->write(json_encode([
            "error" => "You don't have access to this user"
        ]));
        return $response;
    }
    $response->getBody()->write(json_encode($user));
    return $response;
})->add($mw);
