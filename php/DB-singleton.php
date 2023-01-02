<?php
include_once 'config.php';
class DB
{
private static $_instance; 
private $conn;

public static function getInstance() {
	if(!self::$_instance) { 
		self::$_instance = new self();
	}
	return self::$_instance;
}

public function __construct() {

	$this->conn = new PDO('mysql:host='.dbhost.';dbname='.dbname,dbuser,dbpass);		
	$this->conn->query("SET NAMES 'utf8'");
}


public function connect() {
	return $this->conn;
}

public function __destruct(){
	$this->conn=null;
}

}
?>