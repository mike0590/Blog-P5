<?php
ob_start();


if (isset($message) AND $message == 0) {
	?> <div class="align alert alert-danger" role="alert">Article Effacé</div> <?php
}

?>

<h1 style="text-align: center;">Mon Administration</h1></br>
<h3 style="text-align: center;">Articles</h3>

<a href="index.php?p=destroy" style="float: right; position: relative; bottom: 25px; right: 25px;">Deconnexion</a></br>

<a style="position: relative; left: 20px;" class="btn btn-primary" href="admin.php?p=post.add">Ajouter</a>
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
		<?php  foreach($posts as $post): ?>
		<tr>
			<td><?= $post -> post; ?></td>
			<td><?= $post -> title; ?></td>
			<td><?= $post -> name; ?></td>
			<td><?= $post -> date; ?></td>
			<td><?= $post -> author; ?></td>
			<td><a class="btn btn-primary" href="admin.php?p=post.edit&id=<?= $post -> post; ?>">Editer</a></td>
			<td><a class="btn btn-danger" style="position: relative; right: 20px;" href="admin.php?p=post.delete&id=<?= $post -> post; ?>">Supprimer</a></td>



		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<a href="admin.php?p=comments"><h3 style="text-align: center;">Commentaires</h3></a>

<?php

$admin = ob_get_clean();