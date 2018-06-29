<?php


namespace App\Controller;

class Controller
{
	protected $viewPath;
	protected $template;


	public function __construct()
	{
		$this -> viewPath = ROOT . '/App/Views/';
	}

	public function page($view, $variables=[])
	{
		extract($variables);
		require ($this -> viewPath . $view . '.php');
		require ($this -> viewPath . 'template/'. $this -> template. '.php');
	}



	
}