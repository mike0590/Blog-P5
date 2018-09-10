<?php


namespace App\Table;
use App\App;

class Entity
{

	public function __construct(array $data)
	{
		return $this -> hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) {
			$method = 'set' .ucfirst($key);
			if (method_exists($this, $method)) {
				$this -> $method($value);
			}
		}
	}




}