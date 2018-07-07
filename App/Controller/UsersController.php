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
		$auth = new \App\Auth\DbAuth();

		if (!empty($_POST))
		{
			if($auth -> userLogin(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password'])))
			{
				header('Location: index.php');
			}
			else
				$message = 0;
		}

		$form = new \App\Html\Form();
		$p = 'userLogin';
		$this -> page('posts/userLogin', compact('form', 'p', 'message'));

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
			if($auth -> userExists(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password'])))
			{
				$message = 0;
			}
			elseif($auth -> userNameExists(htmlspecialchars($_POST['username'])))
			{
				$message = 1;
			}
			else{
					$user = $auth -> inscription(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
					$message = 2;
			}
		}

		$form = new \App\Html\Form();
		$p = 'inscription';
		$this -> page('posts/inscription', compact('form', 'p', 'message'));
	}



}