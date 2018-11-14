<?php

namespace App\Url;

class Url
{
	private $url = [];


	public function __construct($datas)
	{
		$this -> url = explode('/', $datas);
	}

	public function getPage()
	{
		if (isset($this -> url[0])) {
			return $this -> url[0];
		} 
	}

	public function getId()
	{
		if (isset($this -> url[1])){
			return $this -> url[1];
		} 
	}

	public function getDelete()
	{
		if (isset($this -> url[2])){
			return $this -> url[2];
		} 
	}

	public function getToken()
	{
		if (isset($this -> url[2])) {
			return $this -> url[2];
		}
	}
}