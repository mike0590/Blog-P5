<?php

namespace App\Auth;

class DbAuthManager
{

	/**
	 * [variable representant la table usres en BDD]
	 * @var string
	 */
	 private $table = 'users';
	  
	 /**
	  * [permet la connexion d'un visiteur ou d un administrateur]
	  * @param  [string] $username [username du visiteur ou de l administrateur]
	  * @param  [string] $password [password du visiteur ou de l admiistrateur]
	  * @return [bool]           [true ou false, si les donnes existent en BDD ou non]
	  */
	 public function login($username, $password)
	{
		 $db = \App\App::getDb();
		 $user = $db -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username]);
		 if ($user) {
		 	$pass = password_verify($password, $user -> password);
		 	$passHash = $user -> password;
		 	if ($pass || $passHash){
		 		if ($user -> is_admin == 0) {
		 			$_SESSION['auth'] = $user -> idUsers;
		 		} elseif ($user -> is_admin == 1) {
		 			$_SESSION['visitor'] = $user -> idUsers;
		 			$_SESSION['nameVisitor'] = $user -> username;
		 		}
		 		return true;
		 	}
		 }
		 return false;
	}

	public function userExists($username)
	{
		$db = \App\App::getDb();
		$user = $db -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username], true, DbAuth::class);
		if ($user) {
			return $user;
		} else{
			return false;
		}
	}

	/**
	 * [verifie si l utilisateur qui fait le login est un visiteur ou un administrateur]
	 * @param  [string] $username [$username de l utilisateur]
	 * @return [bool]           [renvoie true s il sagit d un administrateur et false s il sagit d un visiteur]
	 */
	 public function verify($username)
	 {
	 	$db = \App\App::getDb();
		$user = $db -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username]);
		if ($user -> is_admin == 0) {
			return True;
		} elseif ($user -> is_admin == 1) {
			return False;
		}
	 }

	 /**
	  * [verifie si un visiteur ou administrateur a une session d active]
	  * @return [bool] 
	  */
	 public function logged()
	 {
	 	if (isset($_SESSION['auth']) OR isset($_SESSION['visitor'])){
	 		return true;
	 	} else
	 		 return false;
	 }

	 /**
	  * [permet l inscription d un nouveau visiteur]
	  * @param  [string] $username [username du nouveau visitor]
	  * @param  [string] $password [password du nouveau visiteur]
	  * @return [bool]           [retourne true si l inscription est effectuee et false si des donnees existent deja en BDD]
	  */
	 public function inscription($username, $password)
	 {
	 	$db = \App\App::getDb();

	 	$user = $db -> prepare("SELECT * FROM {$this -> table} WHERE is_admin = 1 AND username = ?", [$username]);
	 	if ($user) {
		 	return false;
		 }
		 
		$attributes[] = $username;
	 	$attributes[] = password_hash($password, PASSWORD_DEFAULT);
		$new = $db -> prepare("INSERT INTO {$this -> table} SET is_admin = 1, username =?, password=?", $attributes);
		return true;
	}
}