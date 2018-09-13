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
		header('Location: index.php?p=login');
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
		$p = 'admin';
		$this -> page('admin/posts/index', compact('posts', 'p', 'message'));
	}


	public function edit()
	{
		$posts = \App\App::getInstance() -> getTable('postsManager');
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
		$categoryPost = $posts -> categoryPost([$_GET['id']]);
		$categories = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$form = new \App\HTML\Form($post);
		$p = 'post.edit';
		$this -> page('admin/posts/edit', compact('form', 'categories', 'p', 'categoryPost', 'message'));
	}


	public function add()
	{
		$post = \App\App::getInstance() -> getTable('postsManager');
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
		$categories = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$p = 'post.add';
		$this -> page('admin/posts/add', compact('form', 'categories', 'p', 'message'));
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
		$p = 'comments';
		$this -> page('admin/posts/comments', compact('commentsWait', 'p'));
	}


	public function viewComment()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$x = [$_GET['id']];
		$comment = $comments -> showComment([$_GET['id']]);
		$p = 'singleComment';
		$this -> page('admin/posts/singleComment', compact('comment', 'p'));
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














