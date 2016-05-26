
<?php
header('Location: anmeldung.html'); //Weiterleitung zur Anmeldung

//Beenden und Löschen der Session
session_start();
session_unset();
session_destroy();
$_SESSION = array();
echo "Abgemeldet";
?>