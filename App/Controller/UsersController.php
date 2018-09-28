<?php

namespace App\Controller;

class UsersController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	public function login()
	{
		$this -> template = 'default_2';
		
		$auth = new \App\Auth\DbAuthManager();
		if(!empty($_POST)){
			if($auth -> login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']))) {
				if ($auth -> verify($_POST['username']) == True) {
					header('Location: http://www.passion-php.fr/administration');
				}
				elseif ($auth -> verify($_POST['username']) == False) {
					header('Location: http://www.passion-php.fr/accueil');
				}
			}
			else{
				$message = 0;
			}
		}
		$form = new \App\HTML\Form();
		$p = 'userLogin';
		$this -> page('posts/userLogin', compact('form', 'p', 'message'));
	}


	public function destroy()
	{
		session_start();
		session_destroy();
		header('Location: http://www.passion-php.fr/accueil');
	}

	
	public function inscription()
	{
		$this -> template = 'default_2';
		$auth = new \App\Auth\DbAuthManager();

		if (!empty($_POST)) {
			if (!empty($_POST['username']) AND !empty($_POST['password'])) {
				$user = $auth -> inscription(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
				if($user == true)
				{
					$message = 0;
				} else{
					$message = 1;
				}
			} else{
				$message = 2;
			}
		}
		$form = new \App\HTML\Form();
		$this -> page('posts/inscription', compact('form', 'message'));
	}
}