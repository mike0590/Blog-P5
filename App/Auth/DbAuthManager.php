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
	 
	 public function db()
	 {
	 	$db = \App\App::getDb();
	 	return $db;
	 }
	 public function login($username, $password)
	{
		 $user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username], true, DbAuth::class);
		 if ($user) {
		 	$pass = password_verify($password, $user -> password());
		 	if ($pass){
		 		if ($user -> is_admin() == 0) {
		 			$_SESSION['auth'] = $user -> idUsers();
		 		} elseif ($user -> is_admin() == 1) {
		 			$_SESSION['visitor'] = $user -> idUsers();
		 			$_SESSION['nameVisitor'] = $user -> username();
		 		}
		 		return true;
		 	}
		 }
		 return false;
	}

	public function userExists($mail, $key = null)
	{
		$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE email = ?", [$mail], true, DbAuth::class);
		if ($user) {
			$attributes[] = $key;
			$attributes[] = $mail;
			$this -> db() -> prepare("UPDATE {$this -> table} SET reset_token = ? WHERE email = ? ", $attributes, true, DbAuth::class);
			return $user;
		} else{
			return false;
		}
	}

	public function getUsername($username)
	{
		$username = $this -> db() -> prepare("SELECT * FROM{$this -> table} WHERE username =?", [$username]);
		if ($username) {
			return true;
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
		$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE username = ?", [$username]);
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

	 public function newInscription($mail, $key)
	 {
	 	$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE email =?", [$mail]);
	 	if ($user) {
	 		return true;
	 	} else{
	 		$attributes[] = $mail;
	 		$attributes[] = $key;
	 		$user = $this -> db() -> prepare("INSERT INTO {$this -> table} SET is_admin =1, email =?, token =?", $attributes);
	 		return false;
	 	}
	 }

	 public function getIdNewUser($mail)
	 {
	 	$newUser = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE email =?", $mail, true, DbAuth::class);
	 	return $newUser;
	 }

	 /**
	  * [permet l inscription d un nouveau visiteur]
	  * @param  [string] $username [username du nouveau visitor]
	  * @param  [string] $password [password du nouveau visiteur]
	  * @return [bool]           [retourne true si l inscription est effectuee et false si des donnees existent deja en BDD]
	  */
	 public function inscription($id, $username, $password)
	 {
	 	$password = password_hash($password, PASSWORD_DEFAULT);

		$attributes[] = $username;
		$attributes[] = $password;
		$attributes[] = $id;
		$newUser = $this -> db() -> prepare("UPDATE {$this -> table} SET token = NULL, username =?, password =? WHERE idUsers =?", $attributes);
		$user = $this -> getUser([$id]);
		$_SESSION['visitor'] = $user -> idUsers();
		$_SESSION['nameVisitor'] = $user -> username();
	}

	public function getUser($id)
	{
		$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE idUsers = ?", $id, true, DbAuth::class);
		if ($user) {
			return $user;
		} else{
			return false;
		}
	}

	public function updateUser($id, $pass)
	{
		$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
		
		$attributes[] = $pass_hash;
		$attributes[] = $id;
		$updateUser = $this -> db() -> prepare("UPDATE {$this -> table} SET reset_token = NULL, password = ? WHERE idUsers = ? ", $attributes);
		$updateUser = $this -> getUser([$id]);
		if ($updateUser -> is_admin() == 0) {
		 	$_SESSION['auth'] = $updateUser -> idUsers();
		} elseif ($updateUser -> is_admin() == 1) {
		 	$_SESSION['visitor'] = $updateUser -> idUsers();
		 	$_SESSION['nameVisitor'] = $updateUser -> username();
		}
	}
}