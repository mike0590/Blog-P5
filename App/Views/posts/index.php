<?php

ob_start();



$i = 0;

	foreach ($posts as $post) {
		if ($i < 3) {
			echo "<h3>" .$post -> title. "</h3>";
			echo "<p>" .$post -> getExtrait(). "<p/>";
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
echo $form -> input('message', 'Votre Message', ['type' => 'textarea']). '</br>';
echo $form -> submit('Envoyer'). '</br>';


$formulaire = ob_get_clean();


