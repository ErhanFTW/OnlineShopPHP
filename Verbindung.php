<?php

//Beginn des PHP-Dokuments


$conn = mysql_connect("localhost", "user", "123") or die(mysql_error());
//stellt eine Verbindung zur Datenbank her; im Erfolgsfall erhält man eine Verbindungskennung zurück;
//im Misserfolgsfall gibt die Funkion false zurück

$db = mysql_select_db("projekt", $conn);
//waehlt die Datenbank aus; liefert im Erfolgsfall true zurück
//andernfalls false

?>