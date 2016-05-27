<?php

//Beginn des PHP-Dokuments

require_once 'headerfunc.inc.php';
headerausgabe("Warenbestand bearbeiten");
session_start();

//Seite nur für Händler

if ($_SESSION['usernummer'] == "1") {

//Verbindung zur Datenbank
    
    require 'Verbindung.php';

//Abrufen aller Artikeldaten
    
    $query = "Select * from artikel";
    $result = mysql_query($query, $conn) or die (mysql_error());

    while ($line = mysql_fetch_array($result)) {
        if (isset($_POST[$line["Artikelnummer"]])) { //Wurde ein Wert mit der Artikelnummer übertragen
            
            //Empfangen der Daten aus den Textfeldern
            
            $name = $_POST["Name"];
            $preis = $_POST["Preis"];
            $bild = $_POST["Bild"];
            $bestand = $_POST["Bestand"];

            //Leerfeldüberprüfung
            
            if ($name == "" or $preis == "" or $bild == "" or $bestand == "") {
                echo "Eingabe unvollst&auml;ndig. Alle Felder müssen ausgefüllt sein.";
                echo "<br><a href='warenbestand.php?.SID.' >Zur&uuml;ck</a>";
                exit();
            }
            //Änderung der Artikeldaten in der DB
            
            $query3 = "UPDATE artikel SET   Preis='$preis', Name='$name', Bild='$bild', Bestand='$bestand' WHERE  Artikelnummer= '$line[Artikelnummer]'";
            $result3 = mysql_query($query3, $conn) or die (mysql_error());
        }
        //wurde der Button Löschen gedrückt
        
        if (isset($_POST["Löschen$line[Artikelnummer]"])) {
            //löschen des Artikels aus der DB
            $query2 = "Delete  from artikel where Artikelnummer='$line[0]'";
            $result3 = mysql_query($query2, $conn) or die (mysql_error());
        }
        //wurde der Button Hinzufügen geklickt
        
        if (isset($_POST["Add"])) {
            //Empfangen der Daten aus den "leeren" Feldern für neuen Artikel
            $artikelnummer = $_POST["Artikelnummer"];
            $name = $_POST["Name"];
            $preis = $_POST["Preis"];
            $bild = $_POST["Bild"];
            $bestand = $_POST["Bestand"];

            //Hinzufügen der Daten in DB Artikel
            
            $query3 = "Insert INTO artikel (Artikelnummer, Name, Preis, Bild, Bestand ) values ('$artikelnummer', '$name', '$preis', '$bild', $bestand)";
            $result3 = mysql_query($query3, $conn) or die (mysql_error());
        }

        if ($result3) header("Location: warenbestand.php");//Weiterleitung zur Seite Warenbestand
        else {
            echo "Fehler bei der Übertragung";
            echo "<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='warenbestand.php'\">";
        }
    }
}

ende();
?>