<?php

namespace App\Controller;

class UsersController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [methode login qui traite la connexion de l utilisateur)
	 */
	public function login()
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();

		if (!empty($_POST)) {
			if(!empty($_POST) && !empty($_POST['password'])){
				if($auth -> login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']))) {
					if ($auth -> verify($_POST['username']) == True) {
						header('Location: admin');
					}
					elseif ($auth -> verify($_POST['username']) == False) {
						header('Location: accueil');
					}
				}
				else{
					$_SESSION['message'] = 'wrong id';
				}
			} else {
				$_SESSION['message'] = 'obligatory';
			}
		}
		
		$form = new \App\HTML\Form();
		$p = 'userLogin';
		$this -> page('posts/userLogin', compact('form', 'p', 'url'));
	}

	/**
	 * [methode restartPass, controller qui envoie un lien vers l adresse mail (avec un token) de l utilisateur pour qu'il puisse reinitialiser son mot de pass)
	 */
	public function restartPass()
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager(); 

		if (!empty($_POST['mail'])) {
			$mail = htmlspecialchars($_POST['mail']);
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){
				$key = \App\Functions\Functions::str_aleatory('30');
				$user = $auth -> userExists($mail, $key);
				if ($user) {
					$sendMail = \App\Mail\Mail::sendNewDataMail($user->idUsers(), $mail, $key, $user -> username(), 'restart');
					$_SESSION['message'] = 'mail restart';
				} else{
					$_SESSION['message'] = 'mail not found';
				}
			} else{
				$_SESSION['message'] = 'mail invalid';
			}
		}
		$form = new \App\HTML\Form();
		$this -> page('posts/restart', compact('form', 'url'));
	}

	/**
	 * [newPass, controller qui va mettre a jour le mot de pass de l utilisateur ]
	 * @param  [int] $id  [id de l utilisateur]
	 * @param  [varchar] $key [token]
	 */
	public function newPass($id, $key)
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();
		$form = new \App\HTML\Form();
		$userPass = $auth -> getUser($id, $key, 'reset');
		$timeReset = $auth -> timeReset($id);

		if (!empty($_POST)) {
			if (!empty($_POST['pass']) && !empty($_POST['validate_pass'])) {
				$pass = htmlspecialchars($_POST['pass']);
				$validate_pass = htmlspecialchars($_POST['validate_pass']);
				if ($pass == $validate_pass) {
						$user = $auth -> updateUser($id, $pass);
						header('Location: ' .$url. 'accueil');
						exit();
				} else{
					$_SESSION['message'] = 'not same pass';
				}
			} else{
				$_SESSION['message'] = 'obligatory';
			} 
		} 
		if (!empty($key) && !empty($id)) {
			if ($userPass) {
				if ($timeReset) {
					$this -> page('posts/newPass', compact('form', 'url'));
				} else{
					$_SESSION['message'] = 'time s up';
					header('Location: ' .$url. 'connexion');
				}
			} else{
				header('Location: ' .$url. 'connexion');
			}
		} else{
			header('Location: ' .$url. 'connexion');
		}
	}
	
	/**
	 * [methode newInscription, controller qui envoie un lien vers l adresse mail (avec un token) du nouvel utilisateur pour qu'il puisse s inscrire )
	 */
	public function newInscription()
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();

		if (!empty($_POST)) {
			if (!empty($_POST['mail'])) {
				$mail = htmlspecialchars($_POST['mail']);
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
					$key = \App\Functions\Functions::str_aleatory('30');
					$user = $auth -> newInscription($mail, $key);
					if($user == false) {
						$newUser = $auth -> getIdNewUser([$mail]);
						$title = 'Cher Visiteur';
						$sendMail = \App\Mail\Mail::sendNewDataMail($newUser -> idUsers(), $mail, $key, $title, 'inscription');
						$_SESSION['message'] = 'new inscription';
					} else{
						$_SESSION['message'] = 'mail exists';
					}
				} else{
					$_SESSION['message'] = 'obligatory';
				}
			} else{
				$_SESSION['message'] = 'mail invalid';
			}
		}

		$form = new \App\HTML\Form();
		$this -> page('posts/newInscription', compact('form', 'url'));
	}

	/**
	 * [inscription, controller qui va introduire un nouvel utilisateur en BD ]
	 * @param  [int] $id  [id de l utilisateur]
	 * @param  [varchar] $key [token]
	 */
	public function inscription($id, $key)
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();
		$form = new \App\HTML\Form();
		$newUser = $auth -> getUser($id, $key, 'inscription');
		$timeToken = $auth -> inscriptionTime([$id]);

		if (!empty($_POST)) {
			if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_verify'])) {
				$username = htmlspecialchars($_POST['username']);
				$password = htmlspecialchars($_POST['password']);
				$password_verify = htmlspecialchars($_POST['password_verify']);
				if ($password == $password_verify) {
					$usernameExist = $auth -> getUsername([$username]);
					if ($usernameExist == false) {
						$inscriptionUser = $auth -> inscription($id, $username, $password);
						header('Location: ' .$url. 'accueil');
						exit();
					} else{
						$_SESSION['message'] = 'unavailable id';
					}
				} else{
					$_SESSION['message'] = 'not same pass';
				}
			} else{
				$_SESSION['message'] = 'obligatory';
			}
		}
		if (!empty($key)) {
			if ($newUser) {
				if ($timeToken) {
					$this -> page('posts/inscription', compact('form', 'url'));
				} else{
					$delete = $auth -> deleteUser([$id]);
					$_SESSION['message'] = 'time s up inscription';
					header('Location: ' .$url. 'nouvelle_inscription');
				}
			} else{
					header('Location: ' .$url. 'nouvelle_inscription');
			}
		} else{
			header('Location: ' .$url. 'nouvelle_inscription');
		}
	}

	/**
	 * [methode destroy qui detruit une session)
	 */
	public function destroy()
	{
		$url = $this -> basepath();
		session_destroy();
		header('Location: ' .$url. 'accueil');
	}

	/**
	 * [deleteUser Supprime un utilisateur dans la BD]
	 * @param  [int] $id [id de l utilisateur]
	 */
	public function deleteUser($id)
	{	
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();

		$delete = $auth -> deleteUser([$id]);
		header('Location: ' .$url. 'listUsers');
	}
}