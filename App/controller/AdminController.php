<?php

namespace App\Controller;

class AdminController extends Controller
{

	public function __construct()
	{
		$this -> viewPath = ROOT . '/App/Views/';
		$this -> template = 'default_2';
	}

	public function login()
	{
		$auth = new \App\Auth\DbAuth();
		if ($auth -> logged()) {
			header('Location: admin.php');
		}
		if (!empty($_POST))
		{
			if($auth -> login($_POST['username'], $_POST['password']))
			{
				header('Location: admin.php');
			}
			else
				?>
			<div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
			<?php
		}
		$form = new \App\Html\Form();
		$p = 'login';
		$this -> page('admin/users/login', compact('form', 'p'));
	}

	public function destroy()
	{
		session_start();
		session_destroy();
		header('Location: index.php?p=login');
	}

	public function dashbord()
	{

		$app = \App\App::getInstance();
		$auth = new \App\Auth\DbAuth();
		if (!$auth -> logged()) {
		$app -> forbidden();
		}
	}

	public function index()
	{
		if (isset($_GET['sup'])) {  ?>
		<div class="align alert alert-success" role="alert">Article Effacé</div>
		<?php }

		$posts = \App\App::getInstance() -> getTable('posts') -> getAll();
		$p = 'admin';
		$this -> page('admin/posts/index', compact('posts', 'p'));
	}

	}















