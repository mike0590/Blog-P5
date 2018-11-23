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

	 /**
	 * [propriete email de la table users en BDD]
	 * @var string
	 */
	 private $email;

	 /**
	 * [propriete token de la table users en BDD]
	 * @var string
	 */
	 private $token;

	 /**
	 * [propriete token_time de la table users en BDD]
	 * @var date
	 */
	 private $token_time;

	 /**
	 * [propriete reset_token de la table users en BDD]
	 * @var string
	 */
	 private $reset_token;

	 /**
	 * [propriete reset_time de la table users en BDD]
	 * @var date
	 */
	 private $reset_time;
	 

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

	  /**
	  * [retourne l email]
	  * @return [string] 
	  */
	 public function email()
	 {
	 	return $this -> email;
	 }

	  /**
	  * [retourne le token]
	  * @return [string] 
	  */
	 public function token()
	 {
	 	return $this -> token;
	 }

	  /**
	  * [retourne le token_time]
	  * @return [date] 
	  */
	 public function token_time()
	 {
	 	return $this -> token_time;
	 }

	  /**
	  * [retourne le reset_token]
	  * @return [string] 
	  */
	 public function reset_token()
	 {
	 	return $this -> reset_token;
	 }

	  /**
	  * [retourne le reset_time]
	  * @return [date] 
	  */
	 public function reset_time()
	 {
	 	return $this -> reset_time;
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