<?php

namespace App\Table;

class Categories 
{

	private $idCategories;
	private $name;
	

	public function idCategories()
	{
		return $this -> idCategories;
	}

	public function name()
	{
		return $this -> name;
	}

	public function getUrl()
	{
		return 'index.php?p=categories&id=' .$this -> idCategories();
	}
}