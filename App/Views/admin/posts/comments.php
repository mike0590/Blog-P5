<?php
ob_start();
?>


<table class="table">
	<thead>
		<tr>
			<td><strong>Visiteur</strong></td>
			<td><strong>Commentaire</strong></td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($commentsWait as $comment): ?>
		<tr>
			<td><?= $comment -> visitor_username; ?></td>
			<td><?= substr($comment -> content, 0, 70). '..'; ?></td>
			
			<td><a class="btn btn-primary" href="admin.php?p=singleComment&id=<?= $comment -> id; ?>">Voir</a></td>
			<td><a class="btn btn-primary" href="admin.php?p=commentAccepted&id=<?= $comment -> id; ?>">Accepter</a></td>
			<td><a class="btn btn-danger" href="admin.php?p=commentDenied&id=<?= $comment -> id; ?>">Supprimer</a></td>



		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<a style="position: relative; bottom: 30px; left: 80%;" href="admin.php">Administration</a>


<?php
$comments = ob_get_clean();
