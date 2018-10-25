<?php

$title = 'Réinitialisation';


ob_start(); ?>

<h4>Veuillez indiquer votre pseudonyme, un email vous sera envoyé avec votre mot de passe</h4><br/>
<div class="row">
	<div class="col-sm-12 col-md-offset-2 col-md-8">
		<form method="post">

		<?php
		echo '</br>';
		echo $form -> input('username', 'Pseudo'). '<br/>';
		echo $form -> submit('VALIDER');
		?>

		</form>
	</div>
</div>
<div class="hidden-xs hidden-sm col-md-10">
<h3 style="float: right;"><a href="index.php?p=home">Page d'Accueil</a></h3>
</div>
<div class="visible-xs visible-sm col-sm-10">
<br/><br/><h3 style="float: right;"><a href="index.php">Page d'Accueil</a></h3>
</div>

<?php

$content = ob_get_clean();
