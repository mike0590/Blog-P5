<?php

namespace App\Table;

class Posts extends Entity
{


	private $idPosts;
	private $title;
	private $chapo;
	private $content;
	private $dateT;
	private $dateUpdate;
	private $categories;
	private $users;
	
	

	public function __construct(array $data)
	{
		parent::__construct($data);
	}


	public function idPosts()
	{
		return $this -> idPosts;
	}

	public function title()
	{
		return $this -> title;
	}

	public function chapo()
	{
		return $this -> chapo;
	}

	public function content()
	{
		return $this -> content;
	}

	public function dateT()
	{
		return $this -> dateT;
	}

	public function dateUpdate()
	{
		return $this -> dateUpdate;
	} 

	public function categories()
	{
		return $this -> categories;
	}

	public function users()
	{
		return $this -> users;
	}



	public function setIdPosts($data)
	{
			$this -> idPosts = $data;
	}

	public function setTitle($data)
	{
		$this -> title = $data;
	}

	public function setChapo($data)
	{
		$this -> chapo = $data;
	}

	public function setContent($data)
	{
		$this -> content = $data;
	}

	public function setDateT($data)
	{
		$this -> dateT = $data;
	}

	public function setDateUpdate($data)
	{
		$this -> dateUpdate = $data;
	}

	public function setCategories($data)
	{
		$this -> categories = $data;
	}

	public function setUsers($data)
	{
		$this -> users = $data;
	}


	
	public function getUrl()
	{
		return 'index.php?p=single&id='. $this -> idPosts();
	}
}

