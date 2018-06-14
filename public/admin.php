<?php

define('ROOT', dirname(__DIR__));

require ROOT. '/App/Autoloader.php';
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







if ($p == 'admin') {
	$controller = new App\Controller\AdminController();
	$controller -> index();
}
elseif ($p == 'post.edit'){
	$controller = new App\Controller\AdminController();
	$controller -> edit();
}