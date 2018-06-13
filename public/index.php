<?php

define('ROOT', dirname(__DIR__));

require ROOT. '/App/Autoloader.php';
App\Autoloader::register();



if (isset($_GET['p'])) {
	$p = $_GET['p'];
}
else{
	$p = 'home';
}



if ($p == 'home') {
	session_start();
	$controller = new App\Controller\PostsController();
	$controller -> home();
}








