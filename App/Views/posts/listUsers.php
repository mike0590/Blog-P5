<?php

ob_start();

?>

<h1 style="text-align: center;">Liste des Utilisateurs</h1></br>

<?php
if ($list) { ?>
    <table class="table">
		<thead>
			<tr>
				<td>ID</td>
				<td>Username</td>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach($list as $list): ?>

			<tr>
				<td><?= $list -> idUsers(); ?></td>
				<td><?= $list -> username(); ?></td>
				<td><a class="btn btn-danger" style="position: relative; right: 20px" href="<?= $url ?>deleteUser/<?= $list -> idUsers(); ?>">Supprimer</a></td>
			</tr>
			<?php
	        endforeach; ?>
		</tbody>
	</table> <?php
} else{
	echo "Aucun Utilisateur..";
} ?>