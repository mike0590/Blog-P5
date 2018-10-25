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
		$auth = new \App\Auth\DbAuthManager();

		if(!empty($_POST)){
			if($auth -> login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']))) {
				if ($auth -> verify($_POST['username']) == True) {
					header('Location: index.php?p=admin');
				}
				elseif ($auth -> verify($_POST['username']) == False) {
					header('Location: index.php');
				}
			}
			else{
				$_SESSION['message'] = 'wrong id';
			}
		}
		$form = new \App\HTML\Form();
		$p = 'userLogin';
		$this -> page('posts/userLogin', compact('form', 'p'));
	}

	/**
	 * [methode restartPass qui fait le pont entre modele et vue et qui envoie un mail avec le mot de passe oublié par un utilisateur)
	 */
	public function restartPass()
	{
		$this -> template = 'default_2';
		$auth = new \App\Auth\DbAuthManager();

		if (!empty($_POST['username'])) {
			$user = $auth -> userExists(htmlspecialchars($_POST['username']));
			if ($user) {
				\App\Mail\Mail::sendRestartMail($_POST['username'], $user -> password());
				$_SESSION['message'] = 'restart mail sent';
			} else{
				$_SESSION['message'] = 'restart denied';
			}
		}
		$form = new \App\HTML\Form();
		$this -> page('posts/restart', compact('form'));
	}
	
	/**
	 * [methode login qui traite l inscription d un nouvel utilisateur en faisant le pont entre modele et vue)
	 */
	public function inscription()
	{
		$this -> template = 'default_2';
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
		$this -> page('posts/inscription', compact('form'));
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