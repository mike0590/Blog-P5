<?php
ob_start();
?>

<h3>Visiteur: <?= $comment -> user; ?></h3></br></br>
<h3>Article:</h3>
<?= $comment -> title; ?></br></br></br>

<h3>Commentaire:</h3></br>
	<?= $comment -> content; ?>
</br></br></br>

<tr>
			
			<td><a class="btn btn-primary" href="admin.php?p=commentAccepted&id=<?= $comment -> id; ?>">Accepter</a></td>
			<td><a class="btn btn-danger" href="admin.php?p=commentDenied&id=<?= $comment -> id; ?>">Supprimer</a></td>
			
</tr>

<a style="position: relative; bottom: 30px; left: 80%;" href="admin.php">Administration</a>


<?php
$singleComment = ob_get_clean();