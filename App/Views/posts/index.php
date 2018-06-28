<?php

ob_start();



$i = 0;

	foreach ($posts as $post) {
		if ($i < 3) {
			echo "<h3>" .$post -> title. "</h3>";
			echo "<p>" .$post -> chapo. "<p/>";
			echo '<p><a href="' .$post -> getUrl(). '">Voir la Suite</a></p></br>';
			$i++;
		}
		else{
			break;
		}

	}

echo "</br><a href='index.php?p=posts'>Tous les articles</a>";

$content = ob_get_clean();

ob_start(); 

echo $form -> input('nom', 'Nom');
echo $form -> input('prenom', 'Prénom');
echo $form -> input('mail', 'E-Mail');
echo $form -> input('message', 'Votre Message', ['type' => 'textarea']). '</br>'; ?>
<div class="row">
	<div class="col-sm-6">
		<?php echo $form -> submit('Envoyer'); ?>
	</div>
	<div class="col-sm-6">
		<a style="float: right;" href="cv.pdf">Mike Filipe - CV</a>
	</div>
</div></br>



<?php
$formulaire = ob_get_clean();


