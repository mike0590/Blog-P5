<?php

ob_start();
?>

<form method="post">

<?php 
echo '</br>';
echo $form -> input('title', "Titre de l'article");
echo $form -> input('content', 'Contenu', ['type' => 'textarea']);
echo $form -> select('category_id', 'Catégorie', $categories);
echo $form -> input('author', "Auteur de l'Article");
echo $form -> submit('Enregistrer');
?>

</form>
<a style="position: relative; bottom: 50px; left: 80%;" href="admin.php">Administration</a>

<?php
$add = ob_get_clean();