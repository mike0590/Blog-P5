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



}