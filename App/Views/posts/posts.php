<?php

ob_start();
?>

<h1 style="text-align: center;">Mes Articles</h1></br></br>
<div class="col-md-8">
<?php
foreach ($posts as $post) {
	echo '<h2>' .$post -> title. '</h2>';
	echo "<p>" .$post -> chapo. "<p/>"; ?>
	<div class="row">
		<div class="col-md-6">
		  <?php	echo '<p><a href="' .$post -> getUrl(). '">Voir la Suite</a></p></br></br>'; ?>
		</div>
		<div class="clo-md-6" style="position: relative; left: 150px;">
		  <?php	echo "<p>" .$post -> dateT. "<p/>"; ?>
		</div>
	</div>
<?php	
}
?>
</div>
<div class="col-md-offset-1 col-md-3" style="position: relative;left: 100px;bottom: 20px;">
	<h4 style="color: black !important;">Catégories</h4>
	<ul>
<?php
foreach ($categories as $category){
?>
	<li><a href="<?= $category -> getUrl(); ?>"><?php echo $category -> name; ?></a></li>
<?php	
}
?>
	</ul>
</div>
<?php
$contentPosts = ob_get_clean();

