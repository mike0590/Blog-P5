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
		$this -> template = 'default';
		$url = $this -> basepath();

		if (!empty($_POST)) {
			if (!empty($_POST['mail']) AND !empty($_POST['message'])){
				$mail = htmlspecialchars($_POST['mail']);
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
					$nom = htmlspecialchars($_POST['nom']);
					$message = htmlspecialchars($_POST['message']);
					$prenom = htmlspecialchars($_POST['prenom']);
					\App\Mail\Mail::sendMail($mail, $message, $nom, $prenom);
					$_SESSION['message'] = 'mail sent';
				} else{
					$_SESSION['message'] = 'mail invalid';
				}
			} else{
				$_SESSION['message'] = 'mail not sent';
			}
		}
    
		$posts =  \App\App::getInstance() -> getTable('postsManager') -> getPosts();
		$form = new \App\HTML\Form();
		$this -> page('posts/index', compact('posts', 'form', 'url'));
	}

	/**
	 * methode qui s ocuupe du tratement de la page posts en faisant le pont entre modele et vue
	 */
	public function posts()
	{
		$this -> template = 'default_1';
		$url = $this -> basepath();

		$posts = \App\App::getInstance() -> getTable('postsManager');
		$posts = $posts -> getPosts();
		$categories = \App\App::getInstance() -> getTable('categoriesManager');
		$categories = $categories -> getCategories();
		$this -> page('posts/posts', compact('posts', 'categories', 'url'));
	}

	/**
	 * methode qui s ocuupe du tratement de la page single en faisant le pont entre modele et vue
	 */
	public function single($id)
	{
		$this -> template = 'default_1';
		$url = $this -> basepath();

		$new = \App\App::getInstance() -> getTable('commentsManager');
		$visitor = new \App\Auth\DbAuthManager();
		
		if (!empty($_POST) AND isset($_POST['pseudo']) AND isset($_POST['pass'])) {
		    if($visitor -> login(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass'])))
		    {
		      header('Location: ' .$url. 'article/' .$id);
		    } else{
		     	$_SESSION['message'] = 'wrong id';
		    }
		} elseif (!empty($_POST) AND isset($_POST['content'])) {
		  $new -> addComment([
		    'content' => htmlspecialchars($_POST['content']),
		    'posts_id' => $id,
		    'users_id' => $_SESSION['visitor']
		   ]);
		   $_SESSION['message'] = 'comment sent';
		}
		$comments = \App\App::getInstance() -> getTable('CommentsManager');
		$posts = \App\App::getInstance() -> getTable('postsManager');
		$post = $posts -> getPost([$id]);
		$comment = $comments -> getComments([$id]);
		$this -> page('posts/single', compact('post', 'visitor', 'comment', 'url'));

	}

	/**
	 * methode qui s ocuupe du tratement de la page categories en faisant le pont entre modele et vue
	 */
	public function categories($id)
	{
		$this -> template = 'default_1';
		$url = $this -> basepath();

		$postsPerCat = \App\App::getInstance() -> getTable('postsManager');
		$category = \App\App::getInstance() -> getTable('categoriesManager');
		$cat = $category -> getCategory([$id]); 
		$posts = $postsPerCat -> getPostsPerCat([$id]);
		$this -> page('posts/categories', compact('cat', 'posts', 'url'));

	}


	public function error()
	{
		$url = $this -> basepath();
		$this -> page('directory/404', compact('url'));
	}
}

