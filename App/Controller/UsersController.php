<?php

namespace App\Controller;

class UsersController extends Controller
{
	public function __construct()
	{
		$this -> viewPath = ROOT . '/App/Views/';
	}

	public function login()
	{
		$this -> template = 'default_2';
		$auth = new \App\Auth\DbAuth();

		if (!empty($_POST))
		{
			if($auth -> userLogin($_POST['username'], $_POST['password']))
			{
				header('Location: index.php');
			}
			else
				?>
			<div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
			<?php
		}
		$form = new \App\Html\Form();
		$p = 'userLogin';
		$this -> page('posts/userLogin', compact('form', 'p'));

	}

	public function destroy()
	{
		session_start();
		session_destroy();
		header('Location: index.php');
	}

	
	public function inscription()
	{
		$this -> template = 'default_2';
		$auth = new \App\Auth\DbAuth();

		if (!empty($_POST))
		{
			if($auth -> userExists($_POST['username'], $_POST['password']))
			{
				?><div class=" lol alert alert-danger align" role="alert">Vous êtes déjà inscrit.</div><?php
			}
			elseif($auth -> userNameExists($_POST['username']))
			{
				?><div class=" lol alert alert-danger align" role="alert">Username Indisponible.</div><?php
			}
			else{
					$user = $auth -> inscription($_POST['username'], $_POST['password']);
					?><div class=" lol alert alert-success align" role="alert">Compte validé.</div><?php
			}
		}

		$form = new \App\Html\Form();
		$p = 'inscription';
		$this -> page('posts/inscription', compact('form', 'p'));
	}



}