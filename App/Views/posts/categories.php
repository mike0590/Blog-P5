<?php

ob_start();
?>


<h1 style="text-align: center"><?= $cat -> name; ?></h1></br>

<?php

foreach ($posts as $post) {
	echo "<h3>".$post -> title. "</h3>";
	echo "<p>" .$post -> chapo. "<p/>";
	echo '<p><a href="' .$post -> getUrl(). '">Voir la Suite</a></p></br>';
}




$showCats = ob_get_clean();





