<?php


namespace App\Controller;


class PostsController extends Controller
{


	public function __construct()
	{
		$this -> viewPath = ROOT . '/App/Views/';
	}

	public function home()
	{
		$this -> template = 'default';

		$posts =  \App\App::getInstance() -> getTable('posts') -> getPosts();
		$form = new \App\Html\Form();
		$this -> page('posts/index', compact('posts', 'form'));

	}

	public function posts()
	{
		$this -> template = 'default_1';
		
		$posts = \App\App::getInstance() -> getTable('posts');
		$posts = $posts -> getPosts();

		$categories = \App\App::getInstance() -> getTable('categories');
		$categories = $categories -> getCategories();

		$this -> page('posts/posts', compact('posts', 'categories'));
	}

	public function single()
	{
		$this -> template = 'default_1';

		$new = \App\App::getInstance() -> getTable('comments');
		$visitor = new \App\Auth\DbAuth();
		$id = $_GET['id'];


		if (!empty($_POST) AND isset($_POST['pseudo']) AND isset($_POST['pass'])) {
		    if($visitor -> userLogin($_POST['pseudo'], $_POST['pass']))
		    {
		      header('Location: index.php?p=single&id= '.$id.' ');
		    }
		    else
		      ?>
		    <div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
		    <?php }

		elseif (!empty($_POST) AND isset($_POST['content'])) {
		  $new -> addComment([
		    'visitor_username' => $_SESSION['nameVisitor'],
		    'content' => $_POST['content'],
		    'posts_id' => $_GET['id'],
		    'visitor_id' => $_SESSION['visitor'],
		    'date' => 'NOW()'

		  ]);
		}

		$comments = \App\App::getInstance() -> getTable('Comments');
		$posts = \App\App::getInstance() -> getTable('posts');
		$post = $posts -> getPost([$_GET['id']]);
		$comment = $comments -> getComments([$_GET['id']]);

		$this -> page('posts/single', compact('post', 'visitor', 'comments', 'comment'));

	}

	public function categories()
	{
		$this -> template = 'default_1';

		$postsPerCat = \App\App::getInstance() -> getTable('posts');
		$category = \App\App::getInstance() -> getTable('categories');
		$cat = $category -> getCategory([$_GET['id']]); 
		$posts = $postsPerCat -> getPostsPerCat([$_GET['id']]);
		$this -> page('posts/categories', compact('cat', 'posts'));

	}

}


