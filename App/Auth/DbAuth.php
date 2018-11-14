<?php

namespace App\Auth;

class DbAuth 
{

	/**
	 * [propriete idUsers de la table users en BDD]
	 * @var int
	 */
	 private $idUsers;
	 /**
	  * 
	 * [propriete username de la table users en BDD]
	 * @var string
	 */
	 private $username;

	 /**
	 * [propriete password de la table users en BDD]
	 * @var string
	 */
	 private $password;

	 /**
	 * [propriete is_admin de la table users en BDD]
	 * @var int
	 */
	 private $is_admin;

	 private $email;

	 private $reset_token;
	 

	 /**
	  * [retourne l id de l utilisateur]
	  * @return [int] 
	  */
	 public function idUsers()
	 {
	 	return $this -> idUsers;
	 }

	 /**
	  * [retourne l username]
	  * @return [string] 
	  */
	 public function username()
	 {
	 	return $this -> username;
	 }

	 /**
	  * [retourne la password]
	  * @return [string] 
	  */
	 public function password()
	 {
	 	return $this -> password;
	 }

	 /**
	  * [retourne un entier permettant de savoir si un utilisateur est un visiteur ou un administrateur]
	  * @return [int] 
	  */
	 public function is_admin()
	 {
	 	return $this -> is_admin;
	 }

	 public function email()
	 {
	 	return $this -> email;
	 }

	 public function reset_token()
	 {
	 	return $this -> reset_token;
	 }

	 /**
	  * [permet de donner une valeur a username]
	  * @param [string] $username 
	  */
	 public function setUsername($username)
	 {
	 	$this -> username = $username;
	 }
}