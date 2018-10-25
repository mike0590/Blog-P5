<?php


namespace App\Controller;

class Controller
{
	/**
	 * variable representant le chemin vers les vues
	 * @var [string]
	 */
	protected $viewPath;

	/**
	 * indique le template utilisé
	 * @var [string]
	 */
	protected $template;

	/**
	 * chemin utilisé par toutes les vues
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
		require ($this -> viewPath . 'template/'. $this -> template. '.php');
	}
}
