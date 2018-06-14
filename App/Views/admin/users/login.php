<?php

ob_start();

session_start();

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

$login = ob_get_clean();

