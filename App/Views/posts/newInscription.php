<?php

$title = 'Inscription';


ob_start(); ?>

<h4 style="text-align: center;">Veuillez introduire votre e-mail</h4><br/>
<div class="row">
	<div class="col-sm-12 col-md-offset-2 col-md-8">
		<form method="post">
		
		<?php
		echo '</br>';
		echo $form -> input('mail', 'E-Mail*');
		echo $form -> submit('VALIDER');
		?>

		</form>
	</div>
</div>
<div class="hidden-xs hidden-sm col-md-10">
<h3 style="float: right;"><a href="accueil">Page d'Accueil</a></h3>
</div>
<div class="visible-xs visible-sm col-sm-10">
<br/><br/><h3 style="float: right;"><a href="accueil">Page d'Accueil</a></h3>
</div>

<?php
$type = 'css1';
$content = ob_get_clean();


