<?php

namespace App\Bdd;

use \PDO;

class Database
{

	/**
	 * [variable qui represente notre connexion a la BD]
	 * @var [obj]
	 */
	private $db;

	/**
	 * [tableau representant les donnes necessaires pour la connexion a la BD ]
	 * @var array
	 */
	private $settings = [];

	/**
	 * constructeur qui transmet au tableau settings les donnes de notre connexion
	 */
	public function __construct()
	{
		$this -> settings = require 'App/Bdd/bdd.ini';
	}

	/**
	 * [connexion a notre BD a travers PDO]
	 * @return [obj] PDO
	 */
	private function getPdo()
	{
		if ($this -> db == null) {
			$this -> db = new PDO('mysql:dbname=' .$this -> settings['dbName']. ';host=' .$this -> settings['host'].'', $this -> settings['user'], $this -> settings['pass']);
			$this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}

		return $this -> db;
	}


	/**
	 * [methode qui s occupe du traitement des donnees de notre BD -> requete query]
	 * @param  [string]  $statement [SQL statement]
	 * @param  boolean $one       [true si on attend une ligne de BD, false si on en attend plusieurs]
	 * @param  [string]  $className [nom de la class de l objet cree]
	 * @return [obj]          
	 */
	public function query($statement, $one = true, $className = null)
	{
		$res = $this -> getPdo() -> query($statement);
		
		if ($className == true) {
			$res -> setFetchMode(PDO::FETCH_CLASS, $className);
		} else {
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

	/**
	 * [methode qui s occupe du traitement des donnees de notre BD -> requete prepare]
	 * @param  [string]  $statement  [SQL statement]
	 * @param  [array]  $attributes [clause SQL where]
	 * @param  boolean $one        [true si on attend une ligne de BD, false si on en attend plusieurs]
	 * @param  [string]  $className  [nom de la class de l objet cree]
	 * @return [tableau d obj]         
	 */
	public function prepare($statement, $attributes, $one = true, $className = null)
	{
		$res = $this -> getPdo() -> prepare($statement);
		$res -> execute($attributes);
		if (strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0) 
		{
			return $res;
		}

		if ($className == true) {
			$res -> setFetchMode(PDO::FETCH_CLASS, $className);
		} else {
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

