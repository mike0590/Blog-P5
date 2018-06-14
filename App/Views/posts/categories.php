<?php

ob_start();
?>


<h1 style="text-align: center"><?= $cat -> name; ?></h1></br>

<?php

foreach ($posts as $post) {
	echo "<h3>".$post -> title. "</h3>";
	echo "<p>" .$post -> getExtrait(). "<p/>";
}




$showCats = ob_get_clean();





