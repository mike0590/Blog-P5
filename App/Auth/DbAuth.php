<?php

namespace App\Auth;

class DbAuth 
{

	 private $idUsers;
	 private $username;
	 private $password;
	 private $is_admin;
	 


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
}