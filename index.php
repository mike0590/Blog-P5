<?php



require 'App/Autoloader.php';
App\Autoloader::register();

if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
else{
	$p = 'home';
}



switch ($p) {
	case 'home':
		session_start();
		$controller = new App\Controller\PostsController();
		$controller -> home();
	break;

	case 'posts':
	 	session_start();
		$controller = new App\Controller\PostsController();
		$controller -> posts();
	break;

	case 'userLogin':
		$controller = new App\Controller\UsersController();
		$controller -> login();
	break;

	case 'single':
		session_start();
		$controller = new App\Controller\PostsController();
		$controller -> single();
	break;

	case 'categories':
		session_start();
		$controller = new App\Controller\PostsController();
		$controller -> categories();
	break;

	case 'userDestroy':
		$controller = new App\Controller\UsersController();
		$controller -> destroy();
	break;

	case 'login':
		$controller = new App\Controller\AdminController();
		$controller -> login();
	break;

	case 'destroy':
		$controller = new App\Controller\AdminController();
		$controller -> destroy();
	break;

	case 'inscription':
	$controller = new App\Controller\UsersController();
	$controller -> inscription();
	break;

}


