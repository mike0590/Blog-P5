<?php



ob_start();

if (isset($message) AND $message == 0) {
	?> <div class=" lol alert alert-danger align" role="alert">Utilisateur déjà enregistré</div> <?php
}
elseif ((isset($message) AND $message == 1)) {
	?> <div class=" lol alert alert-danger align" role="alert">Username Indisponible</div> <?php
}
elseif (((isset($message) AND $message == 2))) {
	?> <div class=" lol alert alert-success align" role="alert">Compte Validé</div> <?php
}


?>

<form method="post" style="width: 30%; text-align: center; margin-left: auto; margin-right: auto;">

<?php
echo '</br>';
echo $form -> input('username', 'Pseudo');
echo $form -> input('password', 'Password', ['type' => 'password']). '</br>';
echo $form -> submit('VALIDER');

?>


</form>

<h3 style="float: right;"><a href="index.php?p=home">Page d'Accueil</a></h3>

<?php

$inscription = ob_get_clean();


