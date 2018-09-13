<?php

require "vendor/autoload.php";

session_start();


if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
else{
	$p = 'home';
}



switch ($p) {
	case 'home':
		$controller = new App\Controller\PostsController();
		$controller -> home();
	break;

	case 'posts':
	 	$controller = new App\Controller\PostsController();
		$controller -> posts();
	break;

	case 'userLogin':
		$controller = new App\Controller\UsersController();
		$controller -> login();
	break;

	case 'single':
		$controller = new App\Controller\PostsController();
		$controller -> single();
	break;

	case 'categories':
		$controller = new App\Controller\PostsController();
		$controller -> categories();
	break;

	case 'destroy':
		$controller = new App\Controller\UsersController();
		$controller -> destroy();
	break;

	case 'inscription':
	$controller = new App\Controller\UsersController();
	$controller -> inscription();
	break;
	case 'admin':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> index();
	break;

	case 'post.edit':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> edit();
	break;

	case 'post.add':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> add();
	break;

	case 'post.delete':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> delete();
	break;

	case 'comments':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> comments();
	break;

	case 'singleComment':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> viewComment();
	break;

	case 'commentAccepted':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> accept();
	break;

	case 'commentDenied':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> denied();
	break;


}


