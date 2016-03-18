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
}
