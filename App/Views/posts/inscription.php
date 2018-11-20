<?php

$title = 'Inscription';


ob_start(); ?>

<h4 style="text-align: center;">Veuillez introduire vos nouveaux identifiants</h4><br/>
<div class="row">
	<div class="col-sm-12 col-md-offset-2 col-md-8">
		<form method="post">

		<?php
		echo '</br>';
		echo $form -> input('username', 'Pseudo');
		echo $form -> input('password', 'Mot de Passe', ['type' => 'password']). '</br>';
		echo $form -> input('password_verify', 'Confirmation Mot de Passe', ['type' => 'password']). '</br>';
		echo $form -> submit('VALIDER');
		echo "<p style='float: right'><a href='" .$url. "reinitialisation'>( Mot de Passe Oublié ? )</a></p>";
		?>

		</form>
	</div>
</div>
<br/><br/>
<div class="hidden-xs hidden-sm col-md-10">
<h3 style="float: right;"><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
</div>
<div class="visible-xs visible-sm col-sm-10">
<br/><br/><h3 style="float: right;"><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
</div>

<?php
$type = 'css1';
$content = ob_get_clean();

