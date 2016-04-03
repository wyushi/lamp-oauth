<?php
require '../vendor/autoload.php';
require 'server.php';
use \Slim\Middleware\HttpBasicAuthentication\AuthenticatorInterface;
use \lib\Core;
use \models\User;

$app = new \Slim\App(array(
    'debug' => true,
));

$container = $app->getContainer();
// Register logger
$container['logger'] = function ($c) {
    $logger = new Monolog\Logger('slim');
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler('../log/error.log', Monolog\Logger::DEBUG));
    return $logger;
};

// Register view engine
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates');
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    return $view;
};

// oauth server
$app->oauthServer = $server;

// db connection
$core = Core::getInstance();

class UserAuthenticator implements AuthenticatorInterface {
    public function __invoke(array $arguments) {
        $username = $arguments["user"];
        $password = $arguments["password"];
        $password = hash("sha1", $password);
        $model = new User();
        $user = $model->getUserByLogin($username, $password);
        return $user !== 0 && count($user) > 0;
    }
}

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/oauth2/authorize",
    "secure" => false,
    "authenticator" => new UserAuthenticator(),
    "error" => function ($request, $response, $arguments) {
        $data = [];
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response->write(json_encode($response, JSON_UNESCAPED_SLASHES));
    }
]));

// routes
$routers = glob('../routers/*.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();
