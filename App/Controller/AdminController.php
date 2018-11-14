<?php

namespace App\Controller;

class AdminController extends Controller
{

	public function __construct()
	{
		$this -> template = 'default_2';
		parent::__construct();
	}

	/**
	 * renvoie vers la page de connexion si un utilisateur tente d acceder a l administration sans etre connecte
	 */
	public function dashbord()
	{
		$auth = new \App\Auth\DbAuthManager();
		if (!$auth -> logged()) {
			header('Location: connexion');
		}
	}

	/**
	 * methode qui s ocuppe du traitement de la homePage de l administration en faisant le pont entre modele et vue
	 */
	public function index()
	{
		$url = $this -> basepath();
		if (isset($_GET['sup'])) { 
			$_SESSION['message'] = 'post delete';
		 }
		$posts = \App\App::getInstance() -> getTable('postsManager') -> getAll();
		$this -> page('admin/posts/index', compact('posts', 'url'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page d edition d un article en faisant le pont entre modele et vue
	 */
	public function edit($id)
	{
		$url = $this -> basepath();
		$posts = \App\App::getInstance() -> getTable('postsManager');
		if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
			$new = $posts -> update($id[0],[
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
		$post = $posts -> getPost($id);
		$categoryPost = $posts -> categoryPost($id);
		$categoriesList = \App\App::getInstance() -> getTable('categoriesManager') -> selectCategories();
		$form = new \App\HTML\Form($post);
		$this -> page('admin/posts/edit', compact('form', 'categoriesList', 'categoryPost', 'url'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page d addition d un article en faisant le pont entre modele et vue
	 */
	public function add()
	{
		$url = $this -> basepath();
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
		$this -> page('admin/posts/add', compact('form', 'categories', 'url'));
	}

	/**
	 * methode qui s ocuppe du traitement de suppression d un article en faisant appel au modele
	 */
	public function delete($id)
	{
		$post = \App\App::getInstance() -> getTable('postsManager');
		$delete = $post -> delete($id);
		if ($delete) {
			$_SESSION['message'] = 'post delete';
		} 
	}

	/**
	 * methode qui s ocuppe du traitement de la page comments en faisant le pont entre modele et vue
	 */
	public function comments()
	{
		$url = $this -> basepath();
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$commentsWait = $comments -> showComments();
		$this -> page('admin/posts/comments', compact('commentsWait', 'url'));
	}

	/**
	 * methode qui s ocuppe du traitement de la page singleComment en faisant le pont entre modele et vue
	 */
	public function viewComment($id)
	{
		$url = $this -> basepath();
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> showComment($id);
		$this -> page('admin/posts/singleComment', compact('comment', 'url'));
	}

	/**
	 * methode qui s ocuppe du traitement d acceptation d un commentaire en faisant appel au modele
	 */
	public function accept($id)
	{
		$url = $this -> basepath();
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentAccepted($id);
		header('Location: ' .$url. '/commentaires');
	}

	/**
	 * methode qui s ocuppe du traitement de suppression d un commentaire en faisant appel au modele
	 */
	public function denied($id)
	{
		$url = $this -> basepath();
		$comments = \App\App::getInstance() -> getTable('commentsManager');
		$comment = $comments -> CommentDenied($id);
		header('Location: ' .$url. '/commentaires');
	}
}














