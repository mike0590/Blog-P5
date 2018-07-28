<?php

$title = 'Commentaires';

ob_start();
?>


<table class="table visible-md visible-lg">
	<thead>
		<tr>
			<td><strong>Visiteur</strong></td>
			<td><strong>Commentaire</strong></td>
			<td><strong>Article</strong></td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($commentsWait as $comment): ?>
		<tr>
			<td><?= $comment -> username; ?></td>
			<td><?= substr($comment -> content, 0, 70). '..'; ?></td>
			<td><?= $comment -> title; ?></td>
			<td><?= $comment -> id; ?></td>
		</tr>
		<tr>
			<td><a class="btn btn-primary" href="admin.php?p=singleComment&id=<?= $comment -> id; ?>">Voir</a></td>
			<td><a class="btn btn-primary" href="admin.php?p=commentAccepted&id=<?= $comment -> id; ?>">Accepter</a></td>
			<td><a class="btn btn-danger" href="admin.php?p=commentDenied&id=<?= $comment -> id; ?>">Supprimer</a></td>




		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div class="visible-xs visible-sm">
	<br/><br/>
	<?php  

	if ($commentsWait == null) {
		echo "Sans Commentaires en attente !";
	}
	foreach($commentsWait as $comment): ?>
	<div>
			<p><?= '<strong style="color:black;">Visiteur: </strong>' .$comment -> username; ?></p>
			<p><?= '<strong style="color:black;">Commentaire: </strong>' .substr($comment -> content, 0, 70). '..'; ?></p>
			<p><?= '<strong style="color:black;">Article: </strong>' .$comment -> title; ?></p><br/>
		 	<div style="display: flex;">
			  <a class="btn btn-primary" href="admin.php?p=singleComment&id=<?= $comment -> id; ?>">Voir</a>
			  <a class="btn btn-primary" href="admin.php?p=commentAccepted&id=<?= $comment -> id; ?>">Accepter</a>
			  <a class="btn btn-danger" href="admin.php?p=commentDenied&id=<?= $comment -> id; ?>">Supprimer</a>
			</div>
	</div>
			<br/><br/>
	
<?php endforeach; ?>
</div>

<a class="visible-md visible-lg" style="position: relative; bottom: 30px; left: 80%;" href="admin.php">Administration</a>
<a class="visible-xs visible-sm" style="position: relative; top: 50px;" href="admin.php">Administration</a>


<?php
$comments = ob_get_clean();
