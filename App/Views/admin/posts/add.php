<?php

$title = 'Ajout d\'un Article';

ob_start(); ?>


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
<a style="position: relative; bottom: 50px; left: 80%;" href="<?= $url; ?>admin">Administration</a>

<?php
$type = 'css1';
$content = ob_get_clean();