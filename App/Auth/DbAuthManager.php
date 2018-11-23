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
	  * [db permet une connexion a notre BDD]
	  * @return retourne une instance de la classe database
	  */
	 public function db()
	 {
	 	$db = \App\App::getDb();
	 	return $db;
	 }

	 /**
	  * [login verifie si l username et mot de pass introduit par l utilisateur existe en BD]
	  * @param  [string] $username [username de l utilisateur]
	  * @param  [string] $password [mot de pass de l utilisateur]
	  * @return [bool]          
	  */
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

	/**
	 * [userExists determine si un utilisateur existe en BD a travers l adresse mail introduite et si oui, update l utilisateur en introduisant un token en BD]
	 * @param  [string] $mail [adresse mail du visiteur]
	 * @param  [string] $key  [token]
	 * @return [bool]       
	 */
	public function userExists($mail, $key = null)
	{
		$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE email = ?", [$mail], true, DbAuth::class);
		if ($user) {
			$attributes[] = $key;
			$attributes[] = $mail;
			$this -> db() -> prepare("UPDATE {$this -> table} SET reset_token = ?, reset_time = NOW() WHERE email = ? ", $attributes, true, DbAuth::class);
			return $user;
		} else{
			return false;
		}
	}


	/**
	 * [getUsername determine si un certain username existe deja en BD]
	 * @param  [string] $username [username introduit par le visiteur]
	 * @return [bool]  
	 */
	public function getUsername($username)
	{
		$username = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE username =?", $username, true, DbAuth::class);
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

	 /**
	  * [newInscription verifie si un certain email existe en BD, et si non, insere en BD un nouvel email, ainsi qu un token pour un visiteur qui souhaite s inscrire]
	  * @param  [string] $mail [email du visiteur]
	  * @param  [string] $key  [token]
	  * @return [bool]    
	  */
	 public function newInscription($mail, $key)
	 {
	 	$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE email =?", [$mail]);
	 	if ($user) {
	 		return true;
	 	} else{
	 		$attributes[] = $mail;
	 		$attributes[] = $key;
	 		$user = $this -> db() -> prepare("INSERT INTO {$this -> table} SET token_time = NOW(),  is_admin =1, email =?, token =?", $attributes);
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
	  * @param  [int] $id [id du visiteur]
	  * @param  [string] $username [username du nouveau visitor]
	  * @param  [string] $password [password du nouveau visiteur]          
	  */
	 public function inscription($id, $username, $password)
	 {
	 	$password = password_hash($password, PASSWORD_DEFAULT);

		$attributes[] = $username;
		$attributes[] = $password;
		$attributes[] = $id;
		$newUser = $this -> db() -> prepare("UPDATE {$this -> table} SET token = NULL, token_time = NULL, username =?, password =? WHERE idUsers =?", $attributes);
		$user = $this -> getUser($id);
		$_SESSION['visitor'] = $user -> idUsers();
		$_SESSION['nameVisitor'] = $user -> username();
	}

	/**
	 * [timeReset determine si le temps entre l'envoie du lien 'reinitialisation' et la mise a jour du visiteur est ecoulé ]
	 * @param  [int] $id [id du visiteur]
	 * @return [bool]    
	 */
	public function timeReset($id)
	{
		$time = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE idUsers =? AND reset_time > DATE_SUB(NOW(), INTERVAL 4 MINUTE) ", [$id], true, DbAuth::class);
		if ($time) {
			return true;
		} else{
			return false;
		}
	}

	/**
	 * [inscriptionTime determine si le temps entre l'envoie du lien 'inscription' et la mise a jour du visiteur est ecoulé ]
	 * @param  [int] $id [id du visiteur]
	 * @return [bool]    
	 */
	public function inscriptionTime($id)
	{
		$time = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE idUsers =? AND token_time > DATE_SUB(NOW(), INTERVAL 4 MINUTE) ", $id, true, DbAuth::class);
		return $time;
	}

	/**
	 * [getUser detremine si les données id et token pour une reinitialisation ou inscription sont valide]
	 * @param  [int] $id     [id de l utilisateur]
	 * @param  [string] $key    [token]
	 * @param  [string] $option [permet de savoir s il sagit d une inscription ou d une rinitialisation]
	 * @return [obj - bool]         [retourne un objet de DbAuth si la verification est positive ou retoure false si la verification est negative]
	 */
	public function getUser($id, $key = null, $option = null)
	{
		$attributes[] = $key;
		$attributes[] = $id;
		if ($key != null && $option == 'reset') {
			$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE reset_token =? AND idUsers =? ", $attributes, true, DbAuth::class);
		} elseif ($key != null && $option == 'inscription') {
			$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE token =? AND idUsers =? ", $attributes, true, DbAuth::class);
		} else{
			$user = $this -> db() -> prepare("SELECT * FROM {$this -> table} WHERE idUsers =?", [$id], true, DbAuth::class);
		} 
		if ($user) {
			return $user;
		} else{
			return false;
		}
	}

	/**
	 * [updateUser permet de mettre a jour les donnees d un visiteur]
	 * @param  [int] $id   [id du visiteur]
	 * @param  [string] $pass [mot de pass du visiteur]
	 */
	public function updateUser($id, $pass)
	{
		$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
		
		$attributes[] = $pass_hash;
		$attributes[] = $id;
		$updateUser = $this -> db() -> prepare("UPDATE {$this -> table} SET reset_token = NULL, reset_time = NULL, password = ? WHERE idUsers = ?  ", $attributes);
		$updateUser = $this -> getUser($id);
		if ($updateUser -> is_admin() == 0) {
		 	$_SESSION['auth'] = $updateUser -> idUsers();
		} elseif ($updateUser -> is_admin() == 1) {
		 	$_SESSION['visitor'] = $updateUser -> idUsers();
		 	$_SESSION['nameVisitor'] = $updateUser -> username();
		}
	}

	/**
	 * [deleteUser permet de supprimer un utilisateur en BD]
	 * @param  [int] $id [id de l utilisateur]
	 */
	public function deleteUser($id)
	{
		$list = $this -> db() -> prepare("DELETE FROM {$this -> table} WHERE idUsers =? ", $id, true, DbAuth::class);
	}
}