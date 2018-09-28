<?php


namespace App\Controller;


class PostsController extends Controller
{


	public function __construct()
	{
		parent::__construct();
	}

	public function home()
	{
	
    if (!empty($_POST['mail']) AND !empty($_POST['message']))
		{

			$destinataire = 'mike_gil@hotmail.fr'; // Déclaration de l'adresse de destination.
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) // On filtre les serveurs qui rencontrent des bogues.
			{
			    $passage_ligne = "\r\n";
			}
			else
			{
			    $passage_ligne = "\n";
			}

			$message_html = '<div style="width: 100%; font-weight: bold">' .htmlspecialchars($_POST['message']). '</div>';
			//==========
			 
			//=====Création de la boundary
			$boundary = "-----=".md5(rand());
			//==========
			 
			 $nom = htmlspecialchars($_POST['nom']);
			 $nom .= " " .htmlspecialchars($_POST['prenom']);

			$expediteur = htmlspecialchars($_POST['mail']);
			 
			//=====Création du header de l'e-mail.
			$header = "From:" .$expediteur .$passage_ligne;
			$header.= "Reply-to:" .$expediteur .$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========
			 
			//=====Création du message.

			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format HTML
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

			 mail($destinataire, $nom, $message, $header);
		}
		$this -> template = 'default';

		$posts =  \App\App::getInstance() -> getTable('postsManager') -> getPosts();
		$form = new \App\HTML\Form();
		if (!empty($_POST)) {
			if (!empty($_POST['mail']) AND !empty($_POST['message'])) {
			$message = 0;
		}
		else {
			$message = 1;
		}
		}
		$this -> page('posts/index', compact('posts', 'form', 'message'));
	}

	public function posts()
	{
		$this -> template = 'default_1';

		$posts = \App\App::getInstance() -> getTable('postsManager');
		$posts = $posts -> getPosts();
		$categories = \App\App::getInstance() -> getTable('categoriesManager');
		$categories = $categories -> getCategories();
		$this -> page('posts/posts', compact('posts', 'categories'));
	}

	public function single()
	{
		$this -> template = 'default_1';

		$new = \App\App::getInstance() -> getTable('commentsManager');
		$visitor = new \App\Auth\DbAuthManager();
		$id = $_GET['id'];
		if (!empty($_POST) AND isset($_POST['pseudo']) AND isset($_POST['pass'])) {
		    if($visitor -> login(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass'])))
		    {
		      header('Location: http://www.passion-php.fr/article/'.$id);
		    } else{
		     	$message = 0;
		    }
		} elseif (!empty($_POST) AND isset($_POST['content'])) {
		  $new -> addComment([
		    'content' => htmlspecialchars($_POST['content']),
		    'posts_id' => $_GET['id'],
		    'users_id' => $_SESSION['visitor']
		   ]);
		   $message = 1;
		}
		$comments = \App\App::getInstance() -> getTable('CommentsManager');
		$posts = \App\App::getInstance() -> getTable('postsManager');
		if ($posts -> postExist([$_GET['id']]) == false) {
			$message = 2;
		}
		$post = $posts -> getPost([$_GET['id']]);
		$comment = $comments -> getComments([$_GET['id']]);
		$this -> page('posts/single', compact('post', 'visitor', 'comments', 'comment', 'message'));

	}

	public function categories()
	{
		$this -> template = 'default_1';

		$postsPerCat = \App\App::getInstance() -> getTable('postsManager');
		$category = \App\App::getInstance() -> getTable('categoriesManager');
		if ($category -> catExist([$_GET['id']]) == false) {
			$message = 2;
		}
		$cat = $category -> getCategory([$_GET['id']]); 
		$posts = $postsPerCat -> getPostsPerCat([$_GET['id']]);
		$this -> page('posts/categories', compact('cat', 'posts', 'message'));

	}

}

