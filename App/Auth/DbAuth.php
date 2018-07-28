<?php

namespace App\Auth;

class DbAuth 
{


 public function login($username, $password)
{
	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM users WHERE username = ?', [$username], null, True);
	 if ($user) {
	 	if ($user -> password === sha1($password)){
	 		session_start();
	 		if ($user -> is_admin == 0) {
	 			$_SESSION['auth'] = $user -> id;
	 		}
	 		elseif ($user -> is_admin == 1) {
	 			$_SESSION['visitor'] = $user -> id;
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
	$user = $db -> prepare('SELECT * FROM users WHERE username = ?', [$username], null, True);
	if ($user -> is_admin == 0) {
		return True;
	}
	elseif ($user -> is_admin == 1) {
		return False;
	}
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
	 $user = $db -> prepare('SELECT * FROM users WHERE is_admin = 1 AND username = ?', [$username], null, True);
	 if ($user) {
	 	if ($user -> password === sha1($password)){
	 		return true;
	    }
	 }

	 return false;
 }

 public function inscription($username, $password)
 {
 	$db = \App\App::getDb();

 	$attributes[] = $username;
 	$attributes[] = sha1($password);

 	$new = $db -> prepare("INSERT INTO users SET is_admin = 1, username =?, password=?", $attributes, null, True);
 	$user = $db -> prepare('SELECT * FROM users WHERE is_admin = 1 AND username = ?', [$username], null, True);
 	session_start();
	$_SESSION['visitor'] = $user -> id;
	$_SESSION['nameVisitor'] = $user -> username;
 	return $new;
 	
 }

 public function userNameExists($username)
 {
 	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM users WHERE is_admin = 1 AND username = ?', [$username], null, True);
	 if ($user == true) {
	 	return true;
	 }
	 return false;
 }




}