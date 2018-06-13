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
}