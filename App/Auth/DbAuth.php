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



}