<?php

namespace App;
use \PDO;

class DataBase
{


private $db;

private function getPdo()
{
	$pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', 'root');
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	return $pdo;
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

