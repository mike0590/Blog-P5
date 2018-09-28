<?php

namespace App\Table;

class Posts 
{


	private $idPosts;
	private $title;
	private $chapo;
	private $content;
	private $dateT;
	private $dateUpdate;
	


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

	public function getUrl()
	{
		return 'index.php?p=single&id='. $this -> idPosts();
	}
}

