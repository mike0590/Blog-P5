<?php

$title = 'Réinitialisation';


ob_start(); 
?>

<h4 style="text-align: center;">Veillez introduire votre e-mail</h4><br/>
<div class="row">
	<div class="col-sm-12 col-md-offset-2 col-md-8">
		<form method="post">

		<?php
		echo '</br>';
		echo $form -> input('mail', 'E-Mail'). '<br/>';
		echo $form -> submit('VALIDER');
		?>

		</form>
	</div>
</div>
<div class="hidden-xs hidden-sm col-md-10">
<h3 style="float: right;"><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
</div>
<div class="visible-xs visible-sm col-sm-10">
<br/><br/><h3 style="float: right;"><a href="<?= $url; ?>accueil">Page d'Accueil</a></h3>
</div>

<?php

$content = ob_get_clean();
