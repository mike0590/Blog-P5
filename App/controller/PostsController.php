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

}