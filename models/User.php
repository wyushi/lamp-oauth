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
        $sql = "SELECT * FROM account";
        $stmt = $this->core->dbh->prepare($sql);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $r = 0;
        }
        return $r;
    }

    public function getUserById($id) {
        $r = array();       
        
        $sql = "SELECT nombre * evnt_usuario WHERE id=$id";
        $stmt = $this->core->dbh->prepare($sql);
        //$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);         
        } else {
            $r = 0;
        }       
        return $r;
    }

    public function getUserByLogin($email, $pass) {
        $r = array();       
        
        $sql = "SELECT * FROM user WHERE email=:email AND password=:pass";      
        $stmt = $this->core->dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);         
        } else {
            $r = 0;
        }       
        return $r;
    }

    public function insertUser($data) {
        try {
            $sql = "INSERT INTO account (username, email) VALUES (:username, :email)";
            $stmt = $this->core->dbh->prepare($sql);
            if ($stmt->execute($data)) {
                $data['id'] = $this->core->dbh->lastInsertId();
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