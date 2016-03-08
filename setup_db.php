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

$sql = "CREATE TABLE account (
id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(256) NOT NULL UNIQUE,
password VARCHAR(256) NOT NULL,
firstname VARCHAR(256),
lastname VARCHAR(256),
email VARCHAR(256),
create_data TIMESTAMP
)";

db_exec($dbh, $sql);

// create_account($dbh, "yushi", "yushi@fm.com");


$dbh =  null;
