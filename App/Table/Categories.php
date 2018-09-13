<?php

namespace App\Table;

class Categories extends Entity
{


	private $idCategories;
	private $name;
	

	public function __construct(array $data)
	{
		parent::__construct($data);
	}


	public function idCategories()
	{
		return $this -> idCategories;
	}

	public function name()
	{
		return $this -> name;
	}


	public function setIdCategories($data)
	{
		
		$this -> idCategories = $data;
	
	}

	public function setName($data)
	{
		$this -> name = $data;
	}


	public function getUrl()
	{
		return 'index.php?p=categories&id=' .$this -> idCategories();
	}
}