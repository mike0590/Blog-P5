<?php

$title = 'Administration';

ob_start(); ?>


<h1 style="text-align: center;">Mon Administration</h1></br>


<h3 class="hidden-xs hidden-sm" style="text-align: center;">Articles</h3>
<div class="hidden-md hidden-lg" style="display: flex;">
	<h3 >Articles</h3>
	<a style="position: relative; left: 20%;" href="<?= $url; ?>destroy">Deconnexion</a>
</div>

<div class="visible-xs visible-sm">
	<br/><a class="btn btn-primary" href="<?= $url; ?>post.add">Ajouter</a>
</div>

<div class="hidden-xs hidden-sm">
<a href="<?= $url; ?>destroy" style="float: right; position: relative; bottom: 25px; right: 25px;">Deconnexion</a></br>

<a style="position: relative; left: 20px;" class="btn btn-primary" href="<?= $url; ?>post.add">Ajouter</a>
</br></br>
<?php
if ($posts) { ?>
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
				<td><?= $post -> getCategories() -> name(); ?></td>
				<td><?= $post -> dateT(); ?></td>
				<td><?= $post -> getUsers() -> username(); ?></td>
				<td><a class="btn btn-primary" href="<?= $url; ?>post.edit/<?= $post -> idPosts(); ?>">Editer</a></td>
				<td><a class="btn btn-danger" style="position: relative; right: 20px" href="<?= $url ?>admin/<?= $post -> idPosts(); ?>/delete">Supprimer</a></td>
			</tr>
			<?php
	        endforeach; ?>
		</tbody>
	</table> <?php
} else{
	echo "Aucun article à administrer..";
} ?>

<a href="<?= $url; ?>commentaires"><h3 style="text-align: center;">Commentaires</h3></a>
<h3><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
</div>

<?php 
if ($posts) { ?>
	<div class="visible-xs visible-sm">
		<br/><br/>
		<?php
	    foreach($posts as $post): ?>
			<div>
					<p><?= '<strong style="color:black;">ID: </strong>' .$post -> idPosts(); ?></p>
					<p><?= '<strong style="color:black;">Titre: </strong>' .$post -> title(); ?></p>
					<p><?= '<strong style="color:black;">Categorie: </strong>' .$post -> getCategories() -> name(); ?></p>
					<p><?= '<strong style="color:black;">Date: </strong>' .$post -> dateT(); ?></p>
					<p><?= '<strong style="color:black;">Auteur: </strong>' .$post -> getUsers() -> username(); ?></p><br/><br/>
				 	<div style="display: flex;">
					<a class="btn btn-primary" href="<?= $url ?>post.edit/<?= $post -> idPosts(); ?>">Editer</a>
					<a class="btn btn-danger" style="position: relative; left: 5%;" href="<?= $url ?>post.supp/<?= $post -> idPosts(); ?>">Supprimer</a>
					</div>
					<br/><br/>
			<?php
	    endforeach; ?>
			<br/><br/>

			<a href="<?= $url; ?>commentaires"><h3 style="text-align: center;">Commentaires</h3></a>
			<br/><br/><h3 style="text-align: center"><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
			</div>
	</div> <?php 
} else{
	echo "Aucun article À administrer..";
}

$content = ob_get_clean(); 
