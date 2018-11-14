<?php

namespace App\Table;

class Categories 
{

	 /**
     * [propriete idCategories de la table categories en BDD]
     * @var int
     */
	private $idCategories;

	 /**
     * [propriete name de la table categories en BDD]
     * @var string
     */
	private $name;
	


    /**
     * [retourne l id d une categorie]
     * @return [int] 
     */
	public function idCategories()
	{
		return $this -> idCategories;
	}

	/**
     * [retourne le nom d une categorie]
     * @return [string] 
     */
	public function name()
	{
		return $this -> name;
	}

	/**
	 * [assigne une valeure a la propriete idCategories]
	 * @param [int] $idCategories 
	 */
	public function setIdCategories($idCategories)
	{
		$this -> idCategories = $idCategories;
	}

	/**
	 * [assigne une valeure a la propriete name]
	 * @param [string] $name
	 */
	public function setName($name)
	{
		$this -> name = $name;
	}

	/**
	 * [retourne une URL avec l id de la categorie]
	 */
	public function getUrl($url)
	{
		return $url. 'categorie/' .$this -> idCategories();
	}
}