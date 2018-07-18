<?php

namespace App;
use \PDO;

class Database
{


private $db;

private function getPdo()
{
	if ($this -> db == null) {
		$this -> db = new PDO('mysql:dbname=db684174461;host=db684174461.db.1and1.com', 'dbo684174461', 'Castanha_26');
		$this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	return $this -> db;
}


public function query($statement, $class_name = null, $one = true)
{
	$res = $this -> getPdo() -> query($statement);
	if ($class_name) {
		$res -> setFetchMode(PDO::FETCH_CLASS, $class_name);
	}
	else{
		$res -> setFetchMode(PDO::FETCH_OBJ);
	}
	if ($one) {
		$data = $res -> fetch();
	}
	else{
		$data = $res -> fetchAll();
	}
	return $data;
}

public function prepare($statement, $attributes, $class_name = null, $one = true)
{
	$res = $this -> getPdo() -> prepare($statement);
	$req = $res -> execute($attributes);
	if (strpos($statement, 'UPDATE') === 0 ||
		strpos($statement, 'INSERT') === 0 ||
		strpos($statement, 'DELETE') === 0) 
	{
		return $req;
	}
	if ($class_name) {
		$res -> setFetchMode(PDO::FETCH_CLASS, $class_name);
	}
	else{
		$res -> setFetchMode(PDO::FETCH_OBJ);
	}
	if ($one) {
		$data = $res -> fetch();
	}
	else{
		$data = $res -> fetchAll();
	}
	return $data;

}

}

