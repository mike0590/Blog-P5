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
	<div class="banner-main">
		<div class="banner">
			<div class="agile_dot_info one">
			<!--header-->
			<div class="header">
				<div class="container">
					<nav class="navbar navbar-default">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
							
						</div>
						<!--navbar-header-->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<?php
								$user = new App\Auth\DbAuth();
								if (isset($_SESSION['nameVisitor'])) { ?>
								<li style="position: relative;right:400px;top:20px;"><h4> Bonjour <?php echo $_SESSION['nameVisitor']; ?></h4></li> <?php
								} ?>
								<li><a href="index.php" class="active">Accueil</a></li>
								<li><a href="index.php?p=posts">Articles</a></li>
								<?php if (!isset($_SESSION['visitor']) AND !isset($_SESSION['auth'])) { ?>
									<li><a href="index.php?p=inscription">Inscription</a></li> <?php
								} 
								if ($user -> logged()) { ?>
									<li style="position: relative;left: 100px;"><a href="index.php?p=destroy">Deconnexion</a></li> <?php
								}
								else{ ?>
								<li style="position: relative;left: 100px;"><a href="index.php?p=userLogin">Connexion</a></li> <?php
								} ?>
							
							</ul>
						</div>
					</nav>
				</div>
				
				
			</div>
			<!--//header-->
			<div class="w3_banner_info">
				<div class="container">
					<div class="flexslider-info">
						<section class="slider">
							<div class="flexslider">
								<ul class="slides">
									<li>
									<div class="w3_banner_info_grid">
										<h2>Mike Gil </h2>
										<p>Le web developpeur qu'il vous faut.</p>
									</div>
									</li>
									
								</ul>
							</div>
						</section>
					</div>
				</div>
		</div>
		</div>
	</div>
	</div>
	<!-- //banner -->
								
	<!-- team -->
	<!-- About us -->
	<div class="about-3">
		<h3 class="w3l-titles">Bienvenue</h3>
		<div class="container">
			<div class="d-flex">
				<div class="about1"> 
					<h4>Mes derniers Articles</h4>
					<?php echo $content; ?>
				</div>
				<div class="about2">
					
				</div>
			</div>
			
		</div>
	</div>
	<!-- //About us -->

	

	<!-- Services -->
		<div class="service-w3ls">
			<div class="container">
				<h3 class="w3l-titles">Contactez-moi</h3>
				<form method="post" style="width: 60%;margin-right: auto;margin-left: auto;">
					<?php echo $formulaire; ?>
				</form>
				
			</div>
		</div>
		

	<!-- footer -->
	<div class="copyright">
		<div class="container">
			<?php if (isset($_SESSION['auth'])) { ?>
				<p><a href="admin.php">Administration</a></p> <?php
			}  ?>
			<ul class="social-icons3">
				<li><a href="www.facebook.com" class="fa fa-facebook icon-border facebook"> </a></li>
				<li><a href="www.twitter.com" class="fa fa-twitter icon-border twitter"> </a></li>
				<li><a style="background-color: blue;" href="www.linkedin.com" class="fa fa-linkedin icon-border linkedin"> </a></li>
			</ul>
		</div>
	</div>
	<!-- //footer -->
<!-- bootstrap-pop-up -->
					<div class="modal video-modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
										Improve
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
								</div>
								<section>
									<div class="modal-body">
										<img src="images/g3.jpg" alt=" " class="img-responsive" />
										<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
									</div>
								</section>
							</div>
						</div>
					</div>
					<!-- //bootstrap-pop-up -->
	<!-- js-scripts -->
	<!-- js -->
	<script type="text/javascript" src="public/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="public/js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->
	<!-- //js -->
	<!--Start-slider-script-->
	<script defer src="public/js/jquery.flexslider.js"></script>
		<script type="text/javascript">
		
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
<!--End-slider-script-->
<script src="js/responsiveslides.min.js"></script>
						
			<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								  // Slideshow 4
								  $("#slider3").responsiveSlides({
									auto: true,
									pager:false,
									nav:true,
									speed: 500,
									namespace: "callbacks",
									before: function () {
									  $('.events').append("<li>before event fired.</li>");
									},
									after: function () {
									  $('.events').append("<li>after event fired.</li>");
									}
								  });
							
								});
							 </script>

	<!-- smooth scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<!-- //here ends scrolling icon -->
<!-- //smooth scrolling -->
<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 
<!-- //scrolling script -->

	<!--search jQuery-->
	<script src="js/main.js"></script>
	<!--//search jQuery-->
	<!-- stats -->
	<script src="js/waypoints.min.js"></script>
	<script src="js/counterup.min.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$('.counter').counterUp({
				delay: 100,
				time: 1000
			});
		});
	</script>
	<!-- stats -->
	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smooth scrolling -->
	<!-- js-scripts -->
</body>

</html>