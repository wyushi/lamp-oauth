<?php


$app->get('/tokens', function ($request, $response, $args) {
    // $oauth_request = MessageBridge::newOAuth2Request($request);
    //     MessageBridge::mapResponse(
    //         $server->handleTokenRequest($oauth_request),
    //         $response()
    //     );
    $response = $response->withHeader('Content-type', 'application/json');
    $response->getBody()->write(json_encode(["get"=>"token"]));
    return $response;
});

$app->post('/tokens', function ($request, $response, $args) {
    $response = $response->withHeader('Content-type', 'application/json');
    $response->getBody()->write(json_encode(["post"=>"token"]));
    return $response;
});
