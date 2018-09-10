<?php

namespace App\Auth;

class DbAuth 
{

 private $idUsers;
 private $username;
 private $password;
 private $is_admin;
 

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



 public function idUsers()
 {
 	return $this -> idUsers;
 }

 public function username()
 {
 	return $this -> username;
 }

 public function password()
 {
 	return $this -> password;
 }

 public function is_admin()
 {
 	return $this -> admin();
 }

 public function setIdUsers($data)
 {
 	$this -> idUsers = $data;
 }

 public function setUsername($data)
 {
 	$this -> username = $data;
 }

 public function setPassword($data)
 {
 	$this -> password = $data;
 }

 public function setIs_admin($data)
 {
 	$this -> is_admin = $data;
 }

 






}