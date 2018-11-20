<?php


namespace App\Controller;

class Controller
{
	/**
	 * variable representant le chemin vers les vues
	 * @var [string]
	 */
	private $viewPath;

	/**
	 * indique le template utilisé
	 * @var [string]
	 */
	protected $template;

	/**
	 * chemin utilisé par toutes les vues
	 */
	
	private $basepath;

	/**
	 * base - url
	 */
	
	public function __construct()
	{
		$this -> viewPath = 'App/Views/';
	}

	/**
	 * [permet de require nos vues dynamiquement et de leur envoyer certaines variables]
	 * @param  [string] $view      [nom de la vue]
	 * @param  array  $variables [variables a envoyer aux vues]
	 */
	public function page($view, $variables=[])
	{
		extract($variables);
		require ($this -> viewPath . $view . '.php');
		if (isset($this -> template)) {
			require ($this -> viewPath . 'template/'. $this -> template. '.php');
		}
	}

	public function basepath()
	{
		$this -> basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		return $this -> basepath;
	}
}
