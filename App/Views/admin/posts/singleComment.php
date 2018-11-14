<?php

$title = 'Commentaire';

ob_start();

if ($comment) {
	?><h3>Visiteur: <?= $comment -> getUsers() -> username(); ?></h3></br></br>
<h3>Article:</h3>
<?= $comment -> getPosts() -> title(); ?></br></br></br>

<h3>Commentaire:</h3></br>
	<?= $comment -> content(); ?>
</br></br></br>

<tr>
			
	<td><a class="btn btn-primary" href="<?= $url; ?>commentaireAccepte/<?= $comment -> idComments(); ?>">Accepter</a></td>
	<td><a class="btn btn-danger" href="<?= $url; ?>commentaireRefuse/<?= $comment -> idComments(); ?>">Supprimer</a></td>
			
</tr> <?php
} else{
	echo "Aucun Commentaire en attente";
} ?>

<a style="position: relative; bottom: 30px; left: 80%;" href="<?= $url; ?>admin">Administration</a>

<?php
$content = ob_get_clean();