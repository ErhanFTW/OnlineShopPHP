<?php

//Beginn des PHP-Dokuments

session_start();
require_once 'headerfunc.inc.php';
headerausgabe("Status");
//Verbindung zur Datenbank
require 'Verbindung.php';

if ($_SESSION['usernummer'] == "1") {
    
//Abrufen aller Artikelnummern
    
    $query = "Select Artikelnummer,Usernummer from Bestellung";
    $result = mysql_query($query, $conn) or die (mysql_error());

    while ($line = mysql_fetch_array($result)) {

        //Erzeugen des Namen des Textfeldes
        
        $name = $line["Artikelnummer"] . $line["Usernummer"];

        //Wurde ein Wert mit dem Namen übertragen
        
        if (isset($_POST["$name"])) {
            $g = $_POST["$name"];

            //Änderung des Kommentars(Status) in DB Bestellungen
            
            $query = "Update Bestellung set Kommentar='$g' where Artikelnummer='$line[Artikelnummer]' and Usernummer='$line[Usernummer]'";
            $result = mysql_query($query, $conn) or die (mysql_error());
        } else {
            echo "Es wurden keine Werte übermittelt.";
        }

//Wenn Übertragung erfolgreich
        if ($result) header("Location: allebestellungen.php");//Weiterleitung zum Warenkorb
        else echo "Fail";
    }
}
ende();
?>