<?php



ob_start();

session_start();

if (isset($message) AND $message == 0) {
	?> <div class=" lol alert alert-danger align" role="alert">Identifiants Incorrects</div> <?php
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

<?php

$userLogin = ob_get_clean();

