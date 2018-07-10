<?php


namespace App\Table;
use App\App;

class Table
{

	protected $table;

	public function __construct()
	{
		if ($this -> table === null) {
			$parts = explode( "\\", get_called_class());
			$this -> table = strtolower(end($parts));
		}
		return $this -> table;
	}

	public function getAll()
	{
		return App::getDb() -> query("SELECT posts.id AS post, posts.title, posts.content, 
									 posts.dateT, posts.category_id, categories.id, categories.name, 
									 users.username AS author
									 FROM {$this -> table}
									 JOIN categories ON categories.id = posts.category_id
									 JOIN users ON users.id = posts.user_id"
									 , get_called_class(), $one = false);
	}

	public function update($id, $modifs)
    {
    		
    	foreach ($modifs as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$attributes[] = $id;
    		$sql_parts = (implode(',', $parts));
    	return App::getDb() -> prepare("UPDATE {$this -> table} SET $sql_parts, dateUpdate = NOW() WHERE id = ?", $attributes, null, true);
	}

	public function create($options)
    {
    		
    	foreach ($options as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$sql_parts = (implode(', ', $parts));
    	return App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes, null);
	}


	public function delete($id)
    {
    		
    	return App::getDb() -> prepare("DELETE FROM {$this -> table} WHERE id = ?", $id, null, true);
	}


}