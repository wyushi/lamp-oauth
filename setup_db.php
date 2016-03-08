<?php

function connect() {
    try {
        $dbhost="localhost";
        $dbuser="example_user";
        $dbpass="Admin2015";
        $dbname="exampleDB";
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully\n";
        return $dbh;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "\n";
    }
}

function db_exec($dbh, $sql) {
    try {
        $dbh->exec($sql);
    } catch(PDOException $e) {
        echo "Create Table failed: " . $e->getMessage() . "\n";
    }
}

function create_account($dbh, $username, $email) {
    $sql = "INSERT INTO account (username, email)
    VALUES ('$username', '$email')";
    db_exec($dbh, $sql);
}

$dbh = connect();

// http://bshaffer.github.io/oauth2-server-php-docs/cookbook/

$sql_client = "CREATE TABLE oauth_clients (
client_id VARCHAR(80) NOT NULL,
client_secret VARCHAR(80),
redirect_uri VARCHAR(2000) NOT NULL,
grant_types VARCHAR(80),
scope VARCHAR(100),
user_id VARCHAR(80),
CONSTRAINT clients_client_id_pk PRIMARY KEY (client_id)
)";


$sql_access_token = "CREATE TABLE oauth_access_tokens (
access_token VARCHAR(40) NOT NULL,
client_id VARCHAR(80) NOT NULL,
user_id VARCHAR(255),
expires TIMESTAMP NOT NULL,
scope VARCHAR(2000),
CONSTRAINT access_token_pk PRIMARY KEY (access_token)
)";

$sql_auth_code = "CREATE TABLE oauth_authorization_codes (
authorization_code VARCHAR(40) NOT NULL,
client_id VARCHAR(80) NOT NULL,
user_id VARCHAR(255),
redirect_uri VARCHAR(2000),
expires TIMESTAMP NOT NULL,
scope VARCHAR(2000),
CONSTRAINT auth_code_pk PRIMARY KEY (authorization_code)
)";

$sql_user = "CREATE TABLE oauth_users (
username VARCHAR(255) NOT NULL,
password VARCHAR(2000),
first_name VARCHAR(255),
last_name VARCHAR(255),
CONSTRAINT username_pk PRIMARY KEY (username)
)";

$sql_scopes = "CREATE TABLE oauth_scopes (
scope TEXT,
is_default BOOLEAN
)";

$sql_jwt = "CREATE TABLE oauth_jwt (
client_id VARCHAR(80) NOT NULL,
subject VARCHAR(80),
public_key VARCHAR(2000),
CONSTRAINT jwt_client_id_pk PRIMARY KEY (client_id)
)";

$sql_refresh_token = "CREATE TABLE oauth_refresh_tokens (
refresh_token VARCHAR(40) NOT NULL,
client_id VARCHAR(80) NOT NULL,
user_id VARCHAR(255),
expires TIMESTAMP NOT NULL,
scope VARCHAR(2000),
CONSTRAINT refresh_token_pk PRIMARY KEY (refresh_token)
)";

db_exec($dbh, $sql_client);
db_exec($dbh, $sql_access_token);
db_exec($dbh, $sql_auth_code);
db_exec($dbh, $sql_user);
db_exec($dbh, $sql_scopes);
db_exec($dbh, $sql_jwt);
db_exec($dbh, $sql_refresh_token);

// create_account($dbh, "yushi", "yushi@fm.com");


$dbh =  null;
