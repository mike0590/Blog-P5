<?php

ob_start();

session_start();

if (isset($message) AND $message == 0) {
	?> <div class="align alert alert-danger" role="alert">Identifiants Incorrects</div> <?php
}

?>

<div class="row">
	<div class="col-sm-12 col-md-offset-2 col-md-8">

		<form method="post">

		<?php
		echo '</br>';
		echo $form -> input('username', 'Pseudo');
		echo $form -> input('password', 'Password', ['type' => 'password']). '</br>';
		echo $form -> submit('VALIDER');

		?>


		</form>
	</div>
</div>
<div class="hidden-xs hidden-sm col-md-10">
<h3 style="float: right;"><a href="index.php?p=home">Page d'Accueil</a></h3>
</div>
<div class="visible-xs visible-sm col-sm-10">
<br/><br/><h3 style="float: right;"><a href="index.php?p=home">Page d'Accueil</a></h3>
</div>

<?php

$login = ob_get_clean();

