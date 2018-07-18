<?php


namespace App;

class App
{

	private static $db;
	private static $instance;

	public static function getDb()
	{
		if (self::$db == null) {
			self::$db = new \App\Database();
		}
		return self::$db;
	}

	public static function getInstance()
	{
		if(self::$instance == null){
			self::$instance = new App();
		}
		return self::$instance;

	}

	public function getTable($tableName)
	{
		$class_name = 'App\\Table\\' .ucfirst($tableName);
		return new $class_name();
	}


	
	public function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		die('Acces Interdit');
	}




}