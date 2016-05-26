<?php
session_start();

require_once 'Headerfunc.inc.php';
headerausgabe("Warenkorbbearbeiten");

//Verbindung zur Datenbank
require 'Verbindung.php';

//Abrufen aller Artikelnummern
$query = "Select Artikelnummer,Preis from artikel";
$result = mysql_query($query, $conn) or die (mysql_error());

while ($line = mysql_fetch_array($result)) {
    //Wurde ein Wert mit der Artikelnummer übertragen
    if (isset($_POST[$line["Artikelnummer"]])) {

        $anzahl = $_POST[$line[0]];
        $gesamtpreis = $anzahl * $line[1]; //Ausrechnen Gesamtpreis

        //Wenn Leerfeld oder 0, dann löschen
        if ($anzahl == "" or $anzahl == "0") {
            $query2 = "Delete from warenkorb where Usernummer = '$_SESSION[usernummer]' and Artikelnummer='$line[0]'";
            $result3 = mysql_query($query2, $conn) or die (mysql_error());
        } else {

//Änderung der Anzahl und Gesamtpreis in der DB
            $query3 = "UPDATE warenkorb SET  Anzahl='$anzahl',Gesamtpreis='$gesamtpreis' WHERE Usernummer = '$_SESSION[usernummer]' and Artikelnummer='$line[0]'";
            $result3 = mysql_query($query3, $conn) or die (mysql_error());
        }

//Wenn erfolgreich, dann Weiterleitung zur Seite Warenkorb
        if ($result3) header("Location: warenkorbanzeige.php");//Weiterleitung zum Warenkorb
        else echo "Fail";
    }
}
ende();
?>