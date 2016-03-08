<?php
require '../vendor/autoload.php';
require '../config.php';
use \Slim\Middleware\HttpBasicAuthentication\AuthenticatorInterface;
use \lib\Core;
use \models\User;

class UserAuthenticator implements AuthenticatorInterface {
    public function __invoke(array $arguments) {
        $username = $arguments["user"];
        $password = $arguments["password"];
        $password = hash("sha1", $password);
        $model = new User();
        $user = $model->getUserByLogin($username, $password);
        var_dump($user);
        return $user !== 0 && count($user) > 0;
    }
}


$app = new \Slim\App(array(
    'debug' => true
));

$core = Core::getInstance();
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/users",
    "secure" => false,
    "authenticator" => new UserAuthenticator(),
    "error" => function ($request, $response, $arguments) {
        $data = [];
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response->write(json_encode($response, JSON_UNESCAPED_SLASHES));
    }
]));

$routers = glob('../routers/*.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();
