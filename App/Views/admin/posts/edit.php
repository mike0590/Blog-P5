<?php

ob_start();

?>
<form method="post">
<?php



echo $form -> input('title', "Titre de l'article");
echo $form -> input('content', 'Contenu', ['type' => 'textarea']);
echo $form -> select('category_id', 'Catégorie', $categories, $categoryPost -> idCat, $categoryPost -> name);
echo $form -> submit('Enregistrer');
?>

</form>
<a style="position: relative; bottom: 30px; left: 80%;" href="admin.php">Administration</a>


<?php
$edit = ob_get_clean();