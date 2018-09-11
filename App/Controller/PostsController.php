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
		$this -> template = 'default';

		$posts =  \App\App::getInstance() -> getTable('postsMannager') -> getPosts();
		$form = new \App\HTML\Form();
		$this -> page('posts/index', compact('posts', 'form'));

	}

	public function posts()
	{
		$this -> template = 'default_1';
		
		$posts = \App\App::getInstance() -> getTable('postsMannager');
		$posts = $posts -> getPosts();

		$categories = \App\App::getInstance() -> getTable('categoriesMannager');
		
		$categories = $categories -> getCategories();


		$this -> page('posts/posts', compact('posts', 'categories'));
	}

	public function single()
	{
		$this -> template = 'default_1';


		$new = \App\App::getInstance() -> getTable('commentsMannager');
		$visitor = new \App\Auth\DbAuthMannager();
		$id = $_GET['id'];


		if (!empty($_POST) AND isset($_POST['pseudo']) AND isset($_POST['pass'])) {
		    if($visitor -> login(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass'])))
		    {
		      header('Location: index.php?p=single&id= '.$id.' ');
		    }
		    else
		     	$message = 0;
		      }

		elseif (!empty($_POST) AND isset($_POST['content'])) {
		  $new -> addComment([
		    'content' => htmlspecialchars($_POST['content']),
		    'posts_id' => $_GET['id'],
		    'users_id' => $_SESSION['visitor']
		    
		  ]);
		  $message = 1;
		}

		$comments = \App\App::getInstance() -> getTable('CommentsMannager');
		$posts = \App\App::getInstance() -> getTable('postsMannager');
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

		$postsPerCat = \App\App::getInstance() -> getTable('postsMannager');
		$category = \App\App::getInstance() -> getTable('categoriesMannager');
		if ($category -> catExist([$_GET['id']]) == false) {
			$message = 2;
		}
		$cat = $category -> getCategory([$_GET['id']]); 
		$posts = $postsPerCat -> getPostsPerCat([$_GET['id']]);
		$this -> page('posts/categories', compact('cat', 'posts', 'message'));

	}

}

