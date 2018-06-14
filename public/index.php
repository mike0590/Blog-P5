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
elseif ($p == 'posts') {
	session_start();
	$controller = new App\Controller\PostsController();
	$controller -> posts();
}
elseif ($p == 'userLogin') {
	$controller = new App\Controller\UsersController();
	$controller -> login();
}
elseif ($p == 'single') {
	session_start();
	$controller = new App\Controller\PostsController();
	$controller -> single();
}
elseif ($p == 'categories') {
	session_start();
	$controller = new App\Controller\PostsController();
	$controller -> categories();
}







