<?php

//Beginn des PHP-Dokuments

require_once 'headerfunc.inc.php';
headerausgabe("Alle Bestellungen");

//Verbindung zu Datenbanken

require 'Verbindung.php';
session_start();

//Abrufen der Bestellungen des Users

$query = "Select Artikelnummer,Anzahl,Bestellzeitpunkt,Kommentar from bestellung where Usernummer='$_SESSION[usernummer]'";
$result = mysql_query($query, $conn) or die (mysql_error());


if ($result) {

    while ($bestellung = mysql_fetch_array($result)) {

        //Abrufen der Artikeldaten zu den Artikelnummern, die bestellt wurden

        $query2 = "Select Artikelnummer,Name,Bild from artikel where artikelnummer='$bestellung[Artikelnummer]'";
        $result2 = mysql_query($query2, $conn) or die (mysql_error());

        $test = "1";

        //Ausgabe aller Daten

        while ($row = mysql_fetch_array($result2)) {
            echo "<table align=\"center\"; border=\"1\"; text-align=\"center\";>";

            //Ausgabe der Spaltennamen nur beim ersten Durchlauf
            
            if ($test == "1") {
                echo "<tr><td>Artikelnummer</td><td>Name</td><td>Bild</td><td>Anzahl</td><td>Bestelltag<td>Status</td></td>";
            }
            echo "<tr><td>$row[Artikelnummer]</td>
     <td>$row[Name]</td>
     <td><img src=\"Bilder/$row[Bild] \" height=100; alt:$row[Bild] ></td>
     <td>$bestellung[Anzahl]</td>
     <td>$bestellung[Bestellzeitpunkt]</td>
     <td>$bestellung[Kommentar]</td>    </tr>";
            echo "</table>";
            $test++;
        }
    }
}

echo "<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php?.SID.'\">";
ende();
?>