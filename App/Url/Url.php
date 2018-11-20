<?php

namespace App\Url;

class Url
{
	private $url = [];

	private $count;

	private $page;

	private $id;

	private $delete;

	private $token;

	private $key;


	public function __construct($datas = null)
	{
		$this -> url = explode('/', $datas);
		$this -> count = count($this -> url);
		if ($this -> count > 4) {
			return false;
		}
		if (isset($this -> url[0])) {
			$this -> page = $this -> url[0];
		}
		if (isset($this -> url[1])) {
			if (is_numeric($this -> url[1])) {
				$this -> id = $this -> url[1];
			} else{
				$this -> page = 'error';
			}
		}
		if (isset($this -> url[2])) {
			if ($this -> url[2] == 'delete') {
				$this -> delete = $this -> url[2];
			} elseif($this -> url[2] == 'token'){
				$this -> token = $this -> url[2];
			} else{
				$this -> page = 'error';
			}
		}
		if (isset($this -> url[3])) {
			if ($this -> url[2] == 'token') {
				$this -> key = $this -> url[3];
			} else{
			$this -> page = 'error';
			} 
		}
	}


	public function page()
	{
		return $this -> page;
	}

	public function setPage($page)
	{
		$this -> page = $page;
	}

	public function id()
	{
		return $this -> id;
	}

	public function delete()
	{
		return $this -> delete;
	}

	public function token()
	{
		return $this -> token;
	}

	public function key()
	{
		return $this -> key;
	}
}













