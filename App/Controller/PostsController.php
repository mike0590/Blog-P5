<?php


namespace App\Controller;


class PostsController extends Controller
{


	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * methode qui s occupe du traitement de la homePage en faisant le pont entre modele et vue
	 */
	public function home()
	{
	
    if (!empty($_POST['mail']) AND !empty($_POST['message']))
		{
			\App\Mail\Mail::sendMail($_POST['mail'], $_POST['message'], $_POST['nom'], $_POST['prenom']);
		}
		$this -> template = 'default';

		$posts =  \App\App::getInstance() -> getTable('postsManager') -> getPosts();
		$form = new \App\HTML\Form();
		if (!empty($_POST)) {
			if (!empty($_POST['mail']) AND !empty($_POST['message'])) {
			$_SESSION['message'] = 'mail sent';
		}
		else {
			$_SESSION['message'] = 'mail not sent';
		}
		}
		$this -> page('posts/index', compact('posts', 'form'));
	}

	/**
	 * methode qui s ocuupe du tratement de la page posts en faisant le pont entre modele et vue
	 */
	public function posts()
	{
		$this -> template = 'default_1';

		$posts = \App\App::getInstance() -> getTable('postsManager');
		$posts = $posts -> getPosts();
		$categories = \App\App::getInstance() -> getTable('categoriesManager');
		$categories = $categories -> getCategories();
		$this -> page('posts/posts', compact('posts', 'categories'));
	}

	/**
	 * methode qui s ocuupe du tratement de la page single en faisant le pont entre modele et vue
	 */
	public function single()
	{
		$this -> template = 'default_1';

		$new = \App\App::getInstance() -> getTable('commentsManager');
		$visitor = new \App\Auth\DbAuthManager();
		$id = $_GET['id'];
		if (!empty($_POST) AND isset($_POST['pseudo']) AND isset($_POST['pass'])) {
		    if($visitor -> login(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass'])))
		    {
		      header('Location: index.php?p=single&id='.$id);
		    } else{
		     	$_SESSION['message'] = 'wrong id';
		    }
		} elseif (!empty($_POST) AND isset($_POST['content'])) {
		  $new -> addComment([
		    'content' => htmlspecialchars($_POST['content']),
		    'posts_id' => $_GET['id'],
		    'users_id' => $_SESSION['visitor']
		   ]);
		   $_SESSION['message'] = 'comment sent';
		}
		$comments = \App\App::getInstance() -> getTable('CommentsManager');
		$posts = \App\App::getInstance() -> getTable('postsManager');
		$post = $posts -> getPost([$_GET['id']]);
		$comment = $comments -> getComments([$_GET['id']]);
		$this -> page('posts/single', compact('post', 'visitor', 'comment'));

	}

	/**
	 * methode qui s ocuupe du tratement de la page categories en faisant le pont entre modele et vue
	 */
	public function categories()
	{
		$this -> template = 'default_1';

		$postsPerCat = \App\App::getInstance() -> getTable('postsManager');
		$category = \App\App::getInstance() -> getTable('categoriesManager');
		$cat = $category -> getCategory([$_GET['id']]); 
		$posts = $postsPerCat -> getPostsPerCat([$_GET['id']]);
		$this -> page('posts/categories', compact('cat', 'posts'));

	}

}

