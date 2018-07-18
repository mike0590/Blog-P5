<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title></title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Improve Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="public/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
	<!-- css files -->
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<!-- //css files -->
</head>

<body>
	<!-- banner -->
	
			
				
				<!-- //banner -->
								
	<!-- team -->
	<!-- About us -->
	<div class="about-3" style="width: 60%; margin-left: auto;margin-right: auto;">
		<?php 
		if ($p == 'userLogin'){
			echo '<h3 class="w3l-titles">Login</h3>';
			echo $userLogin;
		}
		elseif ($p == 'login'){
			echo '<h3 class="w3l-titles">Login</h3>';
			echo $login; 
		}
		elseif ($p == 'admin'){
			echo $admin;
		}
		elseif ($p == 'post.edit'){
			echo '<h3 class="w3l-titles">Edition de l\'Article</h3>';
			echo $edit;
		}
		elseif ($p == 'post.add') {
			echo '<h3 class="w3l-titles">Ajouter un Article</h3>';
			echo $add;
		}
		elseif ($p == 'comments') {
			echo '<h3 class="w3l-titles">Commentaires en Attente</h3>';
			echo $comments;
		}
		elseif ($p == 'singleComment') {
			echo '<h3 class="w3l-titles">Inspection du Commentaire</h3>';
			echo $singleComment;
		}
		elseif ($p == 'inscription') {
			echo '<h3 class="w3l-titles">Inscription</h3>';
			echo $inscription;
		}
		
		?>
		<div class="container">
			<div class="d-flex">
			
			</div>
			
		</div>
	</div>
	<!-- //About us -->

	

	<!-- Services -->
		
<!-- footer -->

	<!-- js-scripts -->
</body>

</html>