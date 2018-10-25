<?php

namespace App\Controller;

class AdminController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this -> template = 'default_2';
	}

	/**
	 * renvoie vers la page de connexion si un utilisateur tente d acceder a l administration sans etre connecte
	 */
	public function dashbord()
	{
		$auth = new \App\Auth\DbAuthManager();
		if (!$auth -> logged()) {
			header('Location: index.php?p=userLogin');
		}
	}

	/**
	 * methode qui s ocuppe du traitement de la homePage de l administration en faisant le pont entre modele et vue
	 */
	public function index()
	{
		if (isset($_GET['sup'])) { 
			$_SESSION['message'] = 'post delete';
		 }
		$posts = \App\App::getInstance() -> getTable('postsManager') -> getAll();
		$this -> page('admin/posts/index', compact('posts'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page d edition d un article en faisant le pont entre modele et vue
	 */
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
				$_SESSION['message'] = 'update/add';
			}
		}
		$post = $posts -> getPost([$_GET['id']]);
		$categoryPost = $posts -> categoryPost([$_GET['id']]);
		$categoriesList = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$form = new \App\HTML\Form($post);
		$this -> page('admin/posts/edit', compact('form', 'categoriesList', 'categoryPost'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page d addition d un article en faisant le pont entre modele et vue
	 */
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
			$_SESSION['message'] = 'update/add';
		 	
			 }  else{
			 $_SESSION['message'] = 'every input';
			 }
		}
		$form = new \App\HTML\Form();
		$categories = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$this -> page('admin/posts/add', compact('form', 'categories'));
	}

	/**
	 * methode qui s ocuppe du traitement de suppression d un article en faisant appel au modele
	 */
	public function delete()
	{
		$post = \App\App::getInstance() -> getTable('postsManager');
		$delete = $post -> delete([$_GET['id']]);
		if ($delete) {
			header('Location: index.php?p=admin&sup=1');
		}
	}

	/**
	 * methode qui s ocuppe du traitement de la page comments en faisant le pont entre modele et vue
	 */
	public function comments()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$commentsWait = $comments -> showComments();
		$this -> page('admin/posts/comments', compact('commentsWait'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page singleComment en faisant le pont entre modele et vue
	 */
	public function viewComment()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> showComment([$_GET['id']]);
		$this -> page('admin/posts/singleComment', compact('comment'));
	}

	/**
	 * methode qui s ocuppe du traitement d acceptation d un commentaire en faisant appel au modele
	 */
	public function accept()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentAccepted([$_GET['id']]);
		header('Location: index.php?p=comments');
	}

	/**
	 * methode qui s ocuppe du traitement de suppression d un commentaire en faisant appel au modele
	 */
	public function denied()
	{
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentDenied([$_GET['id']]);
		header('Location: index.php?p=comments');
	}
}














