<?php

namespace App\Table;



class Categories extends Table
{

	protected $table;

	public function getUrl()
	{
		return 'index.php?p=categories&id=' .$this -> id;
	}


	public function getCategory($id)
	{
		$category = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE id = ?", $id, get_called_class());
		return $category;
	}

	public function getCategories()
	{
		return \App\App::getDb() -> query ("SELECT * FROM {$this -> table}", get_called_class(), $one = false);
	}