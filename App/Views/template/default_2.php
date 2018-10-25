<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title><?= $title ?></title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=charset=UTF-8" />
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
	<link rel="stylesheet" href="public/css/flexslider.css" type="text/css" media="screen" />
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
		if (isset($_SESSION['message'])){ 

            	switch ($_SESSION['message']) {
					case 'wrong id': 
						?>
						<div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'account create': 
						?>
						<div class=" lol alert alert-success align" role="alert">Compte Validé</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'unavailable id': 
						?>
						<div class=" lol alert alert-danger align" role="alert">Idantifiants indisponibles</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'obligatory': 
						?>
						<div class=" lol alert alert-danger align" role="alert">Champs Obligatoirs</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'post delete': 
						?>
						<div class="align alert alert-danger" role="alert">Article Effacé</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'update/add': 
						?>
						<div class="lol align alert alert-success" role="alert">Article Enregistré</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'every input': 
						?>
						<div class="lol align alert alert-danger" role="alert">Veuillez remplir tous les champs</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'restart mail sent': 
						?>
						<div class="lol align alert alert-success" role="alert">Un email vous a été envoyé avec votre mot de passe</div>
						<?php
						unset($_SESSION['message']);
					break;

					case 'restart denied': 
						?>
						<div class="lol align alert alert-danger" role="alert">Cet username n'existe pas</div>
						<?php
						unset($_SESSION['message']);
					break;
				}
			} 
		echo $content;
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