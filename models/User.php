<?php
namespace models;
use lib\Core;
use PDO;

class User {
    protected $core;

    function __construct() {
        $this->core = Core::getInstance();
    }

    public function getUsers() {
        $r = array();
        $sql = "SELECT * FROM oauth_users";
        $stmt = $this->core->dbh->prepare($sql);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = 0;
        }
        return $r;
    }

    public function getUserByName($username) {
        $r = array();

        $sql = "SELECT * FROM oauth_users WHERE username=:username";
        $stmt = $this->core->dbh->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = 0;
        }
        return $r;
    }

    public function getUserByLogin($username, $password) {
        $r = array();

        $sql = "SELECT * FROM oauth_users WHERE username=:username AND password=:password";
        $stmt = $this->core->dbh->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = 0;
        }
        return $r;
    }

    public function insertUser($data) {
        try {
            $sql = "INSERT INTO oauth_users (username, password, first_name, last_name, my_words) VALUES (:username, :password, :first_name, :last_name, :my_words)";
            $stmt = $this->core->dbh->prepare($sql);
            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
            $stmt->bindParam(':my_words', $data['my_words'], PDO::PARAM_STR);
            if ($stmt->execute()) {
                $data['id'] = $this->core->dbh->lastInsertId();
                unset($data['password']);
                return $data;
            } else {
                return '0';
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function updateUser($data) {

    }

    public function deleteUser($id) {

    }
}
