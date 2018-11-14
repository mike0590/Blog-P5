<?php

$title = 'Catégories';

ob_start();
?>


<h1 style="text-align: center"><?= $cat -> name(); ?></h1></br>
<?php

if ($posts) {
		foreach ($posts as $post) {
		echo "<h3>".$post -> title(). "</h3>";
		echo "<p>" .$post -> chapo(). "<p/>";
		echo '<p><a href="'.$post -> getUrl($url).'">Voir la Suite</a></p></br>';
	}
} else{
	echo "Aucun article pour cette catégorie";
}


$content = ob_get_clean();





