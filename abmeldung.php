
<?php
header('Location: anmeldung.html'); //Weiterleitung zur Anmeldung

//Beenden und L�schen der Session
session_start();
session_unset();
session_destroy();
$_SESSION = array();
echo "Abgemeldet";
?>