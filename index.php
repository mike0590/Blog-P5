<?php

require "vendor/autoload.php";

session_start();

if (isset($_GET['page'])) {
	$url = new \App\Url\Url($_GET['page']);
} else {
	$url = new \App\Url\Url();
	$url -> setPage('accueil');
}



switch ($url -> page()) {
	case 'accueil':
		$controller = new App\Controller\PostsController();
		$controller -> home();
	break;

	case 'articles':
	 	$controller = new App\Controller\PostsController();
		$controller -> posts();
	break;

	case 'connexion':
		$controller = new App\Controller\UsersController();
		$controller -> login();
	break;

	case 'reinitialisation':
		$controller = new App\Controller\UsersController();
		$controller -> restartPass();
	break;

	case 'nouveau_password':
		$controller = new App\Controller\UsersController();
		$controller -> newPass($url -> id(), $url -> key());
	break;

	case 'article':
		$controller = new App\Controller\PostsController();
		$controller -> single($url -> id());
	break;

	case 'categorie':
		$controller = new App\Controller\PostsController();
		$controller -> categories($url -> id());
	break;

	case 'destroy':
		$controller = new App\Controller\UsersController();
		$controller -> destroy();
	break;

	case 'nouvelle_inscription':
		$controller = new App\Controller\UsersController();
		$controller -> newInscription();
	break;

	case 'inscription':
		$controller = new App\Controller\UsersController();
		$controller -> inscription($url -> id(), $url -> key());
	break;

	case 'admin':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord(); 
		if(!empty($url -> delete())){
			$controller -> index($url -> delete(), $url -> id());
		} else{
			$controller -> index();
		}	
	break;

	case 'post.edit':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> edit($url -> id());
	break;

	case 'post.add':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> add();
	break;

	case 'post.supp':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> delete($url -> id());
	break;

	case 'commentaires':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> comments();
	break;

	case 'commentaire':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> viewComment($url -> id());
	break;

	case 'commentaireAccepte':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> accept($url -> id());
	break;

	case 'commentaireRefuse':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> denied($url -> id());
	break;

	case 'deleteUser':
		$controller = new App\Controller\UsersController();
		$controller -> deleteUser($url -> id());
	break;

	default:
		$controller = new App\Controller\PostsController;
		$controller -> error();
		die();
}


