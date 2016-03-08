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
}