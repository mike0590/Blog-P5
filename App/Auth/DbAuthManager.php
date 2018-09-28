<?php

namespace App\Auth;

class DbAuthManager
{


	 private $table = 'users';
	  
	 public function login($username, $password)
	{
		 $db = \App\App::getDb();
		 $user = $db -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username]);
		
		 if ($user) {
		 	$pass = password_verify($password, $user -> password);
		 	if ($pass){
		 		session_start();
		 		if ($user -> is_admin == 0) {
		 			$_SESSION['auth'] = $user -> idUsers;
		 		}
		 		elseif ($user -> is_admin == 1) {
		 			$_SESSION['visitor'] = $user -> idUsers;
		 			$_SESSION['nameVisitor'] = $user -> username;
		 		}
		 		
		 		return true;
		    }
		 }

		 return false;
	}

	 public function verify($username)
	 {
	 	$db = \App\App::getDb();
		$user = $db -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username]);
		if ($user -> is_admin == 0) {
			return True;
		}
		elseif ($user -> is_admin == 1) {
			return False;
		}
	 }

	 public function userLogged()
	 {
	 	if (isset($_SESSION['visitor'])){
	 		return true;
	 	}
	 	else
	 		return false;
	 }

	 
	 public function logged()
	 {
	 	if (isset($_SESSION['auth']) OR isset($_SESSION['visitor'])){
	 		return true;
	 	}
	 	else
	 		return false;
	 }

	 
	 public function userExists($username, $password)
	 {
	 	 $db = \App\App::getDb();
		 $user = $db -> prepare("SELECT * FROM {$this -> table} WHERE is_admin = 1 AND username = ?", [$username]);
		 if ($user) {
		 	$pass = password_verify($password, $user['password']);
		 	if ([$pass]){
		 		return true;
		    }
		 }

		 return false;
	 }

	 public function inscription($username, $password)
	 {
	 	$db = \App\App::getDb();

	 	$attributes[] = $username;
	 	$attributes[] = password_hash($password, PASSWORD_DEFAULT);

	 	$new = $db -> prepare("INSERT INTO {$this -> table} SET is_admin = 1, username =?, password=?", $attributes);
	 	$user = $db -> prepare("SELECT * FROM {$this -> table} WHERE is_admin = 1 AND username = ?", [$username]);
	 	
		$_SESSION['visitor'] = $user['idUsers'];
		$_SESSION['nameVisitor'] = $user['username'];
	 	return $new;
	 	
	 }

	 public function userNameExists($username)
	 {
	 	 $db = \App\App::getDb();
		 $user = $db -> prepare("SELECT * FROM {$this -> table} WHERE is_admin = 1 AND username = ?", [$username]);
		 if ($user == true) {
		 	return true;
		 }
		 return false;
	 }
}