<?php

namespace App\Auth;

class DbAuth 
{


	 public function userlogin($username, $password)
{
	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM visitor WHERE username = ?', [$username], null, True);
	 if ($user) {
	 	if ($user -> password === $password){
	 		session_start();
	 		$_SESSION['visitor'] = $user -> id;
	 		$_SESSION['nameVisitor'] = $user -> username;
	 		return true;
	    }
	 }

	 return false;
 }

 
  public function userLogged()
 {
 	if (isset($_SESSION['visitor'])){
 		return true;
 	}
 	else
 		return false;
 }

 public function login($username, $password)
{
	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM users WHERE username = ?', [$username], null, True);
	 if ($user) {
	 	if ($user -> password === sha1($password)){
	 		session_start();
	 		$_SESSION['auth'] = $user -> id;
	 		return true;
	    }
	 }

	 return false;
 }

 public function logged()
 {
 	if (isset($_SESSION['auth'])){
 		return true;
 	}
 	else
 		return false;
 }

 
 public function userExists($username, $password)
 {
 	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM visitor WHERE username = ?', [$username], null, True);
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

 	$new = $db -> prepare("INSERT INTO visitor SET username =?, password=?", $attributes, null, True);
 	$user = $db -> prepare('SELECT * FROM visitor WHERE username = ?', [$username], null, True);
 	session_start();
	$_SESSION['visitor'] = $user -> id;
	$_SESSION['nameVisitor'] = $user -> username;
 	return $new;
 	
 }

 public function userNameExists($username)
 {
 	 $db = \App\App::getDb();
	 $user = $db -> prepare('SELECT * FROM visitor WHERE username = ?', [$username], null, True);
	 if ($user == true) {
	 	return true;
	 }
	 return false;
 }




}