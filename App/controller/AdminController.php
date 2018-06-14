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

	public function edit()
	{
		$posts = \App\App::getInstance() -> getTable('posts');
		if (!empty($_POST)) {
			$new = $posts -> update($_GET['id'],[
				'title' => $_POST['title'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
				]
			);
			if ($new) { ?>
				<div class="lol align alert alert-success" role="alert">Article Enregistré</div>
			<?php 
			}
		}

		$post = $posts -> getPost([$_GET['id']]);
		$categories = \App\App::getInstance() -> getTable('categories') -> selectCategories('id', 'name');
		$categoryPost = $posts -> categoryPost([$_GET['id']]);

		$form = new \App\Html\Form($post);
		$p = 'post.edit';
		$this -> page('admin/posts/edit', compact('form', 'categories', 'p', 'categoryPost'));
	}

	public function add()
	{
		$post = \App\App::getInstance() -> getTable('posts');
		if (!empty($_POST)) {
		 	$new = $post -> create([
				'title' => $_POST['title'],
		 		'content' => $_POST['content'],
		 		'category_id' => $_POST['category_id'],
		 		'author' => $_POST['author'],
		 		'date' => 'NOW()'
				]);
		 	if ($new) { ?>
				<div class="lol align alert alert-success" role="alert">Article Enregistré</div>
			<?php }
		 } 
		$form = new \App\Html\Form();
		$categories = \App\App::getInstance() -> getTable('categories') -> selectCategories('id', 'name');
		$p = 'post.add';
		$this -> page('admin/posts/add', compact('form', 'categories', 'p'));
	}

	public function delete()
	{
		$post = \App\App::getInstance() -> getTable('posts');
		$delete = $post -> delete([$_GET['id']]);
		if ($delete) {
			header('Location: admin.php?p=admin&sup=1');
		}
	}

	public function comments()
	{
		$comments = \App\App::getInstance() -> getTable('comments');
		$commentsWait = $comments -> showComments();
		$p = 'comments';

		$this -> page('admin/posts/comments', compact('commentsWait', 'p'));
	}

	public function viewComment()
	{
		$comments = \App\App::getInstance() -> getTable('comments');
		$comment = $comments -> showComment([$_GET['id']]);
		$p = 'singleComment';

		$this -> page('admin/posts/singleComment', compact('comment', 'p'));

	}

	}















