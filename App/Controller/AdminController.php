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

		$auth = new \App\Auth\DbAuthMannager();
		if (!$auth -> logged()) {
			header('Location: index.php?p=userLogin');
		}
	}

	public function index()
	{
		if (isset($_GET['sup'])) { 
			$message = 0;
		 }

		$posts = \App\App::getInstance() -> getTable('postsMannager') -> getAll();
		$p = 'admin';
		$this -> page('admin/posts/index', compact('posts', 'p', 'message'));
	}

	public function edit()
	{
		$posts = \App\App::getInstance() -> getTable('postsMannager');
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

		$categories = \App\App::getInstance() -> getTable('categoriesMannager') -> selectCategories();
		

		$form = new \App\Html\Form($post);
		
		$p = 'post.edit';
		$this -> page('admin/posts/edit', compact('form', 'categories', 'p', 'categoryPost', 'message'));
	}

	public function add()
	{
		$post = \App\App::getInstance() -> getTable('postsMannager');
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
		$form = new \App\Html\Form();
		$categories = \App\App::getInstance() -> getTable('categoriesMannager') -> selectCategories();
		$p = 'post.add';
		$this -> page('admin/posts/add', compact('form', 'categories', 'p', 'message'));
	}

	public function delete()
	{
		$post = \App\App::getInstance() -> getTable('postsMannager');
		$delete = $post -> delete([$_GET['id']]);
		if ($delete) {
			header('Location: index.php?p=admin&sup=1');
		}
	}

	public function comments()
	{
		$comments = \App\App::getInstance() -> getTable('commentsMannager');
		$commentsWait = $comments -> showComments();
		$p = 'comments';

		$this -> page('admin/posts/comments', compact('commentsWait', 'p'));
	}

	public function viewComment()
	{
		$comments = \App\App::getInstance() -> getTable('commentsMannager');
		$x = [$_GET['id']];
		$comment = $comments -> showComment([$_GET['id']]);
		$p = 'singleComment';

		$this -> page('admin/posts/singleComment', compact('comment', 'p'));

	}

	public function accept()
	{
		$comments = \App\App::getInstance() -> getTable('commentsMannager');
		$comment = $comments -> CommentAccepted([$_GET['id']]);
		header('Location: index.php?p=comments');
	}

	public function denied()
	{
		$comments = \App\App::getInstance() -> getTable('commentsMannager');
		$comment = $comments -> CommentDenied([$_GET['id']]);
		header('Location: index.php?p=comments');
	}

	}














