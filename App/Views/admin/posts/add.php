<?php

$title = 'Ajout d\'un Article';

ob_start();

if (isset($message) AND $message == 0) {
	?> <div class="lol align alert alert-success" role="alert">Article Enregistré</div> <?php
} elseif (isset($message) AND $message == 1) {
	?> <div class="lol align alert alert-danger" role="alert">Veuillez remplir tous les champs</div> <?php
}
?>

<form method="post">

<?php 
echo '</br>';
echo $form -> input('title', "Titre de l'article");
echo $form -> input('chapo', 'Description', ['type' => 'textarea']);
echo $form -> input('content', 'Contenu', ['type' => 'textareaB']);
echo $form -> select('category_id', 'Catégorie', $categories);
echo $form -> submit('Enregistrer');
?>


</form>
<a style="position: relative; bottom: 50px; left: 80%;" href="http://www.passion-php.fr/administration">Administration</a>

<?php
$content = ob_get_clean();