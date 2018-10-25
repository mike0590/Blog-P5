<?php


namespace App;

class App
{

	private static $db;
	private static $instance;

	/**
	 * [instancie la class Database]
	 * @return [obj]
	 */
	public static function getDb()
	{
		if (self::$db == null) {
			self::$db = new \App\Bdd\Database();
		}
		return self::$db;
	}

	/**
	 * [instancie la class App]
	 * @return [obj]
	 */
	public static function getInstance()
	{
		if(self::$instance == null){
			self::$instance = new App();
		}
		return self::$instance;
	}

	/**
	 * [instancie une class du dossier table]
	 * @param  [string] $tableName [nom de la class a instancier]
	 * @return [obj]            
	 */
	public function getTable($tableName)
	{
		$class_name = 'App\\Table\\' .ucfirst($tableName);
		return new $class_name();
	}
}