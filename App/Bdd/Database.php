<?php

namespace App\Bdd;
use \PDO;

class Database
{

private $db;

private $settings = [];

public function __construct()
{
	$this -> settings = require 'App/Bdd/bdd.ini';
}

private function getPdo()
{
	if ($this -> db == null) {
		$this -> db = new PDO('mysql:dbname=' .$this -> settings['dbName']. ';host=' .$this -> settings['host'].'', $this -> settings['user'], $this -> settings['pass']);
		$this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	return $this -> db;
}


public function query($statement, $one = true)
{
	$res = $this -> getPdo() -> query($statement);
	
	if ($one) {
		$data = $res -> fetch(PDO::FETCH_ASSOC);
	}
	else{
		$data = $res -> fetchAll(PDO::FETCH_ASSOC);
	}
	return $data;
}

public function prepare($statement, $attributes, $one = true)
{
	$res = $this -> getPdo() -> prepare($statement);
	$req = $res -> execute($attributes);
	if (strpos($statement, 'UPDATE') === 0 ||
		strpos($statement, 'INSERT') === 0 ||
		strpos($statement, 'DELETE') === 0) 
	{
		return $req;
	}
	
	if ($one) {
		$data = $res -> fetch(PDO::FETCH_ASSOC);
	}
	else{
		$data = $res -> fetchAll(PDO::FETCH_ASSOC);
	}
	return $data;

}

}

