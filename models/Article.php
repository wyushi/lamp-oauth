<?php
namespace models;
use lib\Core;
use PDO;


class Article {
    protected $core;

    function __construct() {
        $this->core = Core::getInstance();
    }

    public function getArticle() {

    }

    public function getArticleById($id) {

    }

    public function getArticlesByUser() {

    }

    public function insertArticle($data) {
        try {
            $sql = "INSERT INTO articles (title, content, author) VALUES ()";
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

    public function updateArticle($data) {

    }

    public function deleteArticle($id) {

    }
}
