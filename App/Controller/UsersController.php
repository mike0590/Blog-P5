<?php

namespace App\Controller;

class UsersController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [methode login qui traite la connexion de l utilisateur en faisant le pont entre modele et vue)
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
	 * [methode restartPass qui fait le pont entre modele et vue et qui envoie un mail avec le mot de passe oublié par un utilisateur)
	 */
	public function restartPass()
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager(); 

		if (!empty($_POST['mail'])) {
			$mail = htmlspecialchars($_POST['mail']);
			if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)){
				$token = \App\Functions\Functions::str_aleatory('30');
				$user = $auth -> userExists($mail, $token);
				if ($user) {
					$sendMail = \App\Mail\Mail::sendRestartMail($user->idUsers(), $mail, $token);
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

	public function newPass($id, $token)
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();
		$form = new \App\HTML\Form();
		$userPass = $auth -> getUser($id);

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

		if (!empty($token)) {
			if ($userPass) {
				if ($userPass -> reset_token() == $token) {
					$this -> page('posts/newPass', compact('form', 'url'));
				} else{
					$_SESSION['message'] = 'wrong token';
				}
			} else{
				$_SESSION['message'] = 'unavailable id';
			}
		} else{
			header('Location: ' .$url. 'connexion');
		}
	}
	
	/**
	 * [methode login qui traite l inscription d un nouvel utilisateur en faisant le pont entre modele et vue)
	 */
	public function inscription()
	{
		$this -> template = 'default_2';
		$url = $this -> basepath();
		$auth = new \App\Auth\DbAuthManager();

		if (!empty($_POST)) {
			if (!empty($_POST['username']) AND !empty($_POST['password'])) {
				$user = $auth -> inscription(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
				if($user) {
					$_SESSION['message'] = 'account create';
				} else{
					$_SESSION['message'] = 'unavailable id';
				}
			} else{
				$_SESSION['message'] = 'obligatory';
			}
		}
		$form = new \App\HTML\Form();
		$this -> page('posts/inscription', compact('form', 'url'));
	}

	/**
	 * [methode destroy qui detruit une session)
	 */
	public function destroy()
	{
		session_destroy();
		header('Location: index.php');
	}
}