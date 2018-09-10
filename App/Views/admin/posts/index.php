<?php

$title = 'Administration';

ob_start();


if (isset($message) AND $message == 0) {
	?> <div class="align alert alert-danger" role="alert">Article Effacé</div> <?php
}

?>

<h1 style="text-align: center;">Mon Administration</h1></br>


<h3 class="hidden-xs hidden-sm" style="text-align: center;">Articles</h3>
<div class="hidden-md hidden-lg" style="display: flex;">
	<h3 >Articles</h3>
	<a style="position: relative; left: 20%;" href="index.php?p=destroy">Deconnexion</a>
</div>

<div class="visible-xs visible-sm">
	<br/><a class="btn btn-primary" href="index.php?p=post.add">Ajouter</a>
</div>


<div class="hidden-xs hidden-sm">
<a href="index.php?p=destroy" style="float: right; position: relative; bottom: 25px; right: 25px;">Deconnexion</a></br>

<a style="position: relative; left: 20px;" class="btn btn-primary" href="index.php?p=post.add">Ajouter</a>
</br></br>
<table class="table">
	<thead>
		<tr>
			<td>ID</td>
			<td>Titre</td>
			<td>Categorie</td>
			<td>Date</td>
			<td>Auteur</td>
		</tr>
	</thead>
	<tbody>
		<?php



		  foreach($posts as $post): ?>
		<tr>
			<td><?= $post -> idPosts(); ?></td>
			<td><?= $post -> title(); ?></td>
			<td><?= $post -> categories() -> name(); ?></td>
			<td><?= $post -> dateT(); ?></td>
			<td><?= $post -> users() -> username(); ?></td>
			<td><a class="btn btn-primary" href="index.php?p=post.edit&id=<?= $post -> idPosts(); ?>">Editer</a></td>
			<td><a class="btn btn-danger" style="position: relative; right: 20px" href="index.php?p=post.delete&id=<?= $post -> idPosts(); ?>">Supprimer</a></td>



		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<a href="index.php?p=comments"><h3 style="text-align: center;">Commentaires</h3></a>
<h3><a href="index.php?p=home">Page d'Accueil</a></h3>
</div>

<div class="visible-xs visible-sm">
	<br/><br/>

<?php  foreach($posts as $post): ?>
	<div>
			<p><?= '<strong style="color:black;">ID: </strong>' .$post -> idPosts(); ?></p>
			<p><?= '<strong style="color:black;">Titre: </strong>' .$post -> title(); ?></p>
			<p><?= '<strong style="color:black;">Categorie: </strong>' .$post -> categories() -> name(); ?></p>
			<p><?= '<strong style="color:black;">Date: </strong>' .$post -> dateT(); ?></p>
			<p><?= '<strong style="color:black;">Auteur: </strong>' .$post -> users() -> username(); ?></p><br/><br/>
		 	<div style="display: flex;">
			<a class="btn btn-primary" href="index.php?p=post.edit&id=<?= $post -> idPosts(); ?>">Editer</a>
			<a class="btn btn-danger" style="position: relative; left: 5%;" href="index.php?p=post.delete&id=<?= $post -> idPosts(); ?>">Supprimer</a>
	</div>
			<br/><br/>
	
<?php endforeach; ?>
<br/><br/>

<a href="index.php?p=comments"><h3 style="text-align: center;">Commentaires</h3></a>
<br/><br/><h3 style="text-align: center"><a href="index.php?p=home">Page d'Accueil</a></h3>
</div>





<?php

$content = ob_get_clean(); 
