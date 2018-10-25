<?php

namespace App\Table;

class Posts 
{

	/**
	 * [propriete idPosts de la table posts en BDD]
	 * @var int
	 */
	private $idPosts;

	/**
	 * [propriete title de la table posts en BDD]
	 * @var string
	 */
	private $title;

	/**
	 * [propriete chapo de la table posts en BDD]
	 * @var string
	 */
	private $chapo;

	/**
	 * [propriete content de la table posts en BDD]
	 * @var string
	 */
	private $content;

	/**
	 * [propriete dateT de la table posts en BDD]
	 * @var date
	 */
	private $dateT;

	/**
	 * [propriete dateUpdate de la table posts en BDD]
	 * @var date
	 */
	private $dateUpdate;



	/**
	 * [retourne l id d un post]
	 * @return [int] 
	 */
	public function idPosts()
	{
		return $this -> idPosts;
	}

	/**
	 * [retourne le titre d un post]
	 * @return [string] 
	 */
	public function title()
	{
		return $this -> title;
	}

	/**
	 * [retourne le chapo d un article]
	 * @return [string] 
	 */
	public function chapo()
	{
		return $this -> chapo;
	}


	/**
	 * [retourne le contenu d un article]
	 * @return [string] 
	 */
	public function content()
	{
		return $this -> content;
	}

	/**
	 * [retourne la date de creation d un article]
	 * @return [date]
	 */
	public function dateT()
	{
		return $this -> dateT;
	}

	/**
	 * [retourne la date update de l article]
	 * @return [date] 
	 */
	public function dateUpdate()
	{
		return $this -> dateUpdate;
	} 

	/**
	 * [assigne une valeur a la propriete title a travers un parametre]
	 * @param [string] $title 
	 */
	public function setTitle($title)
	{
		$this -> title = $title;
	}

	/**
	 * [instancie la class DbAuth et lui envoie un username comme parametre]
	 * @return [obj] 
	 */
	public function getUsers()
	{
		$users = new \App\Auth\DbAuth();
		if (isset($this -> username)) {
			$users -> setUsername($this -> username);
		}

		return $users;
	}

	/**
	 * [instancie la class categories et lui envoie un nom de categorie et id de categorie en parametre comme parametre]
	 * @return [obj] 
	 */
	public function getCategories()
	{
		$categories = \App\App::getInstance() -> getTable('categories');
		if (isset($this -> name)) {
			$categories -> setName($this -> name);
		}
		if (isset($this -> idCategories)) {
			$categories -> setIdCategories($this -> idCategories);
		}

		return $categories;
	}

	/**
	 * [retourne une url]
	 * @return [url] 
	 */
	public function getUrl()
	{
		return 'index.php?p=single&id='. $this -> idPosts();
	}
}

