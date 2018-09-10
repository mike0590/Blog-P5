<?php

$title = 'Commentaire';

ob_start();
?>


<h3>Visiteur: <?= $comment -> users() -> username(); ?></h3></br></br>
<h3>Article:</h3>
<?= $comment -> posts() -> title(); ?></br></br></br>

<h3>Commentaire:</h3></br>
	<?= $comment -> content(); ?>
</br></br></br>

<tr>
			
			<td><a class="btn btn-primary" href="index.php?p=commentAccepted&id=<?= $comment -> idComments(); ?>">Accepter</a></td>
			<td><a class="btn btn-danger" href="index.php?p=commentDenied&id=<?= $comment -> idComments(); ?>">Supprimer</a></td>
			
</tr>

<a style="position: relative; bottom: 30px; left: 80%;" href="index.php?p=admin">Administration</a>


<?php
$content = ob_get_clean();