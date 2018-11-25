<?php


$title = "Accueil";

ob_start();

$i = 0;

if ($posts) {
	foreach ($posts as $post) {
		if ($i < 3) {
			echo "<h3>" .$post -> title(). "</h3>";
			echo "<p>" .$post -> chapo(). "<p/>";
			echo '<p><a href="' .$post -> getUrl($url). '">Voir la Suite</a></p></br>';
			$i++;
		}
		else{
			break;
		}
	}
} else{
	echo "Aucun article disponible";
}


echo "</br><a href='articles'>Tous les articles</a>";

$content = ob_get_clean();

ob_start(); 

echo $form -> input('nom', 'Nom');
echo $form -> input('prenom', 'Prénom');
echo $form -> input('mail', 'E-Mail*');
echo $form -> input('message', 'Votre Message*', ['type' => 'textarea']). '</br>'; ?>

<div class="row">
	<div class="col-sm-6">
		<?php echo $form -> submit('Envoyer'); ?>
	</div>
	<div class="col-sm-6" style="position: relative; left: 45%;">
		<a href="public/cv.pdf">CV</a>
	</div>
	
</div><br/>

<?php
$formulaire = ob_get_clean();


