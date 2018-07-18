<?php



require 'App/Autoloader.php';
App\Autoloader::register();

session_start();
if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
else{
	$p = 'admin';
}


$controller = new App\Controller\AdminController();
$controller -> dashbord();


switch ($p) {
	case 'admin':
		$controller = new App\Controller\AdminController();
		$controller -> index();
	break;

	case 'post.edit':
		$controller = new App\Controller\AdminController();
		$controller -> edit();
	break;

	case 'post.add':
		$controller = new App\Controller\AdminController();
		$controller -> add();
	break;

	case 'post.delete':
		$controller = new App\Controller\AdminController();
		$controller -> delete();
	break;

	case 'comments':
		$controller = new App\Controller\AdminController();
		$controller -> comments();
	break;

	case 'singleComment':
		$controller = new App\Controller\AdminController();
		$controller -> viewComment();
	break;

	case 'commentAccepted':
		$controller = new App\Controller\AdminController();
		$controller -> accept();
	break;

	case 'commentDenied':
		$controller = new App\Controller\AdminController();
		$controller -> denied();
	break;

}






