<?php

$title = 'Catégories';

ob_start();

if (isset($message) AND $message == 2) { ?>
	<h2>Cette Categorie n'existe pas !</h2>
    <h3><a href="index.php?p=home">Page d'Accueil</a></h3> <?php
	die();
}

?>


<h1 style="text-align: center"><?= $cat -> name; ?></h1></br>

<?php

foreach ($posts as $post) {
	echo "<h3>".$post -> title. "</h3>";
	echo "<p>" .$post -> chapo. "<p/>";
	echo '<p><a href="' .$post -> getUrl(). '">Voir la Suite</a></p></br>';
}




$showCats = ob_get_clean();





