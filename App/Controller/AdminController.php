<?php

namespace App\Controller;

class AdminController extends Controller
{

	public function __construct()
	{
		parent::__construct();
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
			if($auth -> login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password'])))
			{
				header('Location: admin.php');
			}
			else
				$message = 0;
		}

		$form = new \App\HTML\Form();
		$p = 'login';
		$this -> page('admin/users/login', compact('form', 'p', 'message'));
	}

	public function dashbord()
	{
		$auth = new \App\Auth\DbAuth();
		if (!$auth -> logged()) {
			header('Location: index.php?p=login');
		}
	}

	public function index()
	{
		if (isset($_GET['sup'])) { 
			$message = 0;
		 }

		$posts = \App\App::getInstance() -> getTable('posts') -> getAll();
		$p = 'admin';
		$this -> page('admin/posts/index', compact('posts', 'p', 'message'));
	}

	public function edit()
	{
		$posts = \App\App::getInstance() -> getTable('posts');
		if (!empty($_POST)) {
			$new = $posts -> update($_GET['id'],[
				'title' => $_POST['title'],
				'chapo' => $_POST['chapo'],
				'content' => $_POST['content'],
				'category_id' => $_POST['category_id']
				]
			);
			if ($new) { 
				$message = 0;
			}
		}

		$post = $posts -> getPost([$_GET['id']]);
		$categories = \App\App::getInstance() -> getTable('categories') -> selectCategories('id', 'name');
		$categoryPost = $posts -> categoryPost([$_GET['id']]);

		$form = new \App\HTML\Form($post);
		$p = 'post.edit';
		$this -> page('admin/posts/edit', compact('form', 'categories', 'p', 'categoryPost', 'message'));
	}

	public function add()
	{
		$post = \App\App::getInstance() -> getTable('posts');
		if (!empty($_POST)) {
		 	$new = $post -> create([
				'title' => $_POST['title'],
				'chapo' => $_POST['chapo'],
		 		'content' => $_POST['content'],
		 		'category_id' => $_POST['category_id'],
		 		'user_id' => $_SESSION['auth']
				]);

		 	if ($new) { 
		 		$message = 0;
		 	}
		 } 
		$form = new \App\HTML\Form();
		$categories = \App\App::getInstance() -> getTable('categories') -> selectCategories('id', 'name');
		$p = 'post.add';
		$this -> page('admin/posts/add', compact('form', 'categories', 'p', 'message'));
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

	public function accept()
	{
		$comments = \App\App::getInstance() -> getTable('comments');
		$comment = $comments -> CommentAccepted([$_GET['id']]);
		header('Location: admin.php?p=comments');
	}

	public function denied()
	{
		$comments = \App\App::getInstance() -> getTable('comments');
		$comment = $comments -> CommentDenied([$_GET['id']]);
		header('Location: admin.php?p=comments');
	}

	}














