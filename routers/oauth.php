<?php

$app->get('/oauth', function ($request, $response, $args) use ($app) {
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();

    var_dump($oauthReq);
    return $response;
});

$app->post('/token', function ($request, $response, $args) use ($app) {
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $server->handleTokenRequest($oauthReq)->send();
});


$app->post('/resource', function ($request, $response, $args) use ($app){
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    if (!$server->verifyResourceRequest($oauthReq)) {
        $server->getResponse()->send();
        die;
    }
    return $response->write('success');
});


$app->get('/authorize', function ($request, $response, $args) use ($app){
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $oauthRes = new OAuth2\Response();

    if (!$server->validateAuthorizeRequest($oauthReq, $oauthRes)) {
        $response->send();
        die;
    }

    if (empty($_POST)) {
      exit('
    <form method="post">
      <label>Do You Authorize TestClient?</label><br />
      <input type="submit" name="authorized" value="yes">
      <input type="submit" name="authorized" value="no">
    </form>');
    }

    $is_authorized = ($_POST['authorized'] === 'yes');
    $server->handleAuthorizeRequest($oauthReq, $oauthRes, $is_authorized);
    if ($is_authorized) {
      // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
      $code = substr($oauthRes->getHttpHeader('Location'), strpos($oauthRes->getHttpHeader('Location'), 'code=')+5, 40);
      exit("SUCCESS! Authorization Code: $code");
    }
    $oauthRes->send();
});

$app->post('/authorize', function ($request, $response, $args) use ($app){
    $server = $app->oauthServer;
    $oauthReq = OAuth2\Request::createFromGlobals();
    $oauthRes = new OAuth2\Response();

    if (!$server->validateAuthorizeRequest($oauthReq, $oauthRes)) {
        $response->send();
        die;
    }

    if (empty($_POST)) {
      exit('
    <form method="post">
      <label>Do You Authorize TestClient?</label><br />
      <input type="submit" name="authorized" value="yes">
      <input type="submit" name="authorized" value="no">
    </form>');
    }

    $is_authorized = ($_POST['authorized'] === 'yes');
    $server->handleAuthorizeRequest($oauthReq, $oauthRes, $is_authorized);
    if ($is_authorized) {
      // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
      $code = substr($oauthRes->getHttpHeader('Location'), strpos($oauthRes->getHttpHeader('Location'), 'code=')+5, 40);
      exit("SUCCESS! Authorization Code: $code");
    }
    $oauthRes->send();
});

