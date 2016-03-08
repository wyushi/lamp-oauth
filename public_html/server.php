<?php
use OAuth2\Server;
use OAuth2\Storage;
use OAuth2\GrantType;

$dsn      = 'mysql:dbname=exampleDB;host=localhost';
$username = 'example_user';
$password = 'Admin2015';

// error reporting (this is a demo, after all!)
ini_set('display_errors',1);error_reporting(E_ALL);

// Autoloading (composer is preferred, but for this example let's just do this)

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new OAuth2\Server($storage,
    [
        'access_lifetime' => 3600,
    ],
    [
        new GrantType\ClientCredentials($storage),
        new GrantType\AuthorizationCode($storage),
    ]
);
