<?php

namespace App\Controller;

class AdminController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this -> template = 'default_2';
	}


	public function destroy()
	{
		session_start();
		session_destroy();
		header('Location: http://www.passion-php.fr/accueil');
	}


	public function dashbord()
	{
		$auth = new \App\Auth\DbAuthManager();
		if (!$auth -> logged()) {
			header('Location: index.php?p=userLogin');
		}
	}


	public function index()
	{
		if (isset($_GET['sup'])) { 
			$message = 0;
		 }
		$posts = \App\App::getInstance() -> getTable('postsManager') -> getAll();
		$this -> page('admin/posts/index', compact('posts', 'message'));
	}


	public function edit()
	{
		$posts = \App\App::getInstance() -> getTable('postsManager');
		if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
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
		$categoryPost = $posts -> categoryPost([$_GET['id']]);
		$categoriesList = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$form = new \App\HTML\Form($post);
		$this -> page('admin/posts/edit', compact('form', 'categoriesList', 'categoryPost', 'message'));
	}


	public function add()
	{
		$post = \App\App::getInstance() -> getTable('postsManager');
		if (!empty($_POST)) {
			if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
		 	$new = $post -> create([
				'title' => $_POST['title'],
				'chapo' => $_POST['chapo'],
		 		'content' => $_POST['content'],
		 		'category_id' => $_POST['category_id'],
		 		'user_id' => $_SESSION['auth']
				]);
			$message = 0;
		 	
			 }  else{
			 	$message = 1;
			 }
		}
		$form = new \App\HTML\Form();
		$categories = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$this -> page('admin/posts/add', compact('form', 'categories', 'message'));
	}

	public function delete()
	{
		$post = \App\App::getInstance() -> getTable('postsManager');
		$delete = $post -> delete([$_GET['id']]);
		if ($delete) {
			header('Location: index.php?p=admin&sup=1');
		}
	}


	public function comments()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$commentsWait = $comments -> showComments();
		$this -> page('admin/posts/comments', compact('commentsWait'));
	}


	public function viewComment()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$x = [$_GET['id']];
		$comment = $comments -> showComment([$_GET['id']]);
		$this -> page('admin/posts/singleComment', compact('comment'));
	}


	public function accept()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentAccepted([$_GET['id']]);
		header('Location: index.php?p=comments');
	}


	public function denied()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentDenied([$_GET['id']]);
		header('Location: index.php?p=comments');
	}
}














