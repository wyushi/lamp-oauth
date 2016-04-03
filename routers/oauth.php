<?php

$app->get('/oauth', function ($request, $response, $args) use ($app) {
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    var_dump($oauthReq);
    return $response;
});

$app->get('/resource', function ($request, $response, $args) use ($app){
    $oauthReq = OAuth2\Request::createFromGlobals();
    $server = $app->oauthServer;
    if (!$server->verifyResourceRequest($oauthReq)) {
        $server->getResponse()->send();
        die;
    }
    return $response->write('success');
});


$app->post('/oauth2/token', function ($request, $response, $args) use ($app) {
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $server->handleTokenRequest($oauthReq)->send();
});

$app->get('/oauth2/authorize', function ($request, $response, $args) use ($app) {
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $oauthRes = new OAuth2\Response();

    if (!$server->validateAuthorizeRequest($oauthReq, $oauthRes)) {
        $oauthRes->send();
        die;
    }

    $username = $_SERVER['PHP_AUTH_USER'];
    $clientName = $request->getQueryParams()['client_id'];
    return $this->view->render($response, 'dialog.html', [
      'username' => $username,
      'client_name' => $clientName
    ]);
});

$app->post('/oauth2/authorize', function ($request, $response, $args) use ($app){
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $oauthRes = new OAuth2\Response();

    if (!$server->validateAuthorizeRequest($oauthReq, $oauthRes)) {
        $oauthRes->send(json_encode([
            "error" => "invalid authorize request"
        ]));
        die;
    }

    $username = $_SERVER['PHP_AUTH_USER'];
    $is_authorized = ($_POST['authorized'] === 'yes');
    $server->handleAuthorizeRequest($oauthReq, $oauthRes, $is_authorized, $username);
    $oauthRes->send();
    die;
});
