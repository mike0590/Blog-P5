<?php

require "vendor/autoload.php";

session_start();

if (isset($_GET['page'])) {
	$url = new \App\Url\Url($_GET['page']);
	$page = $url -> getPage();
	$id[] = $url -> getId();
	$delete = $url -> getDelete();
	$token = $url -> getToken();
} else {
	$page = 'accueil';
}



switch ($page) {
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
		$controller -> newPass($id, $token);
	break;

	case 'article':
		$controller = new App\Controller\PostsController();
		$controller -> single($id);
	break;

	case 'categorie':
		$controller = new App\Controller\PostsController();
		$controller -> categories($id);
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
		if (isset($delete)) {
			$controller -> delete($id);
		}
		$controller -> index();
	break;

	case 'post.edit':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> edit($id);
	break;

	case 'post.add':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> add();
	break;

	case 'post.supp':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> delete($id);
	break;

	case 'commentaires':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> comments();
	break;

	case 'commentaire':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> viewComment($id);
	break;

	case 'commentaireAccepte':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> accept($id);
	break;

	case 'commentaireRefuse':
		$controller = new App\Controller\AdminController();
		$controller -> dashbord();
		$controller -> denied($id);
	break;


}


