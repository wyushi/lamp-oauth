<?php
namespace lib;

use PDO;

class Core {
    public $dbh; // handle of the db connexion
    private static $instance;
    private function __construct() {
        // building data source name from config
        try {
            $dbhost="localhost";
            $dbuser="example_user";
            $dbpass="Admin2015";
            $dbname="exampleDB";

            $this->dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Connection failed: " . $e->getMessage() . "\n");
        }
    }
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}
