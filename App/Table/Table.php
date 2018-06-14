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
		return App::getDb() -> query("SELECT posts.id AS post, posts.title, posts.content, posts.author, 
									 posts.date, posts.category_id, categories.id, categories.name
									 FROM {$this -> table}
									 JOIN categories ON categories.id = posts.category_id"
									 , get_called_class(), $one = false);
	}

	public function update($id, $modifs)
    {
    		
    	foreach ($modifs as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    	    $parts[] = "date = ?";
    		$attributes[] = 'NOW()';
    		$attributes[] = $id;
    		$sql_parts = (implode(',', $parts));
    	return App::getDb() -> prepare("UPDATE {$this -> table} SET $sql_parts WHERE id = ?", $attributes, null, true);
	}

}