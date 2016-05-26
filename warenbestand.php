<?php
session_start();
require_once 'headerfunc.inc.php';
headerausgabe("Warenbestand");

//Herstellen der Verbindungen
require 'Verbindung.php';

if ($_SESSION['usernummer'] == "1") {
//Abrufen aller Artikeldaten
    $query = "SELECT *  FROM artikel ";
    $result = mysql_query($query, $conn) or die (mysql_error());

    echo "<table style=\"border:1px;margin:10px;padding:1px;text-align:center;valign:middle;\"><br>\n\r";
    while ($line = mysql_fetch_array($result)) {

        //Ausgabe der Artikeldaten in Textfeldern
        echo "<tr><th>Artikelnummer</th><th>Name</th><th>Verein</th><th>Preis</th><th>Bild</th><th>Bestand</th>\n\r";
        echo "<tr>";
        echo "<form action=\"warenbestandbearbeiten.php\" method=\"post\">";
        echo "<td>$line[Artikelnummer] </td>
          <td><input name=Name value=" . $line["Name"] . "></td>
          <td><input name=Verein value=\"" . $line["Verein"] . "\"></td>
          <td><input name=Preis value=" . $line["Preis"] . " ></td>
          <td><input name=Bild value=" . $line["Bild"] . "></td>
          <td><input name=Bestand value=" . $line["Bestand"] . "></td>
          <td><input type=\"submit\" name=" . $line["Artikelnummer"] . " value=\"ändern\"></td>
           <td><input type=\"submit\" name=Löschen" . $line["Artikelnummer"] . " value=\"Löschen\"></td>";

        //Warnung vor Minderbestand
        if ($line["Bestand"] < "10") {
            echo "<td style=\"color:red\">Achtung Bestand niedrig</td>";
        }
        echo "</tr>";

        echo " </form>";

    }
    echo "</table>";

//Leere Felder für neue Artikel
    echo "<table style=\"border:1px;margin:10px;padding:1px;text-align:center;valign:middle;\"><br>\n\r";
    echo "<tr><th>Artikelnummer</th><th>Name</th><th>Verein</th><th>Preis</th><th>Bild</th><th>Bestand</th> \n\r";
    echo "<tr><br>";
    echo "<form action=\"warenbestandbearbeiten.php\" method=\"post\">";
    echo "<td><input name=\"Artikelnummer\"></td>
          <td><input name=Name></td>
          <td><input name=\"Verein\" ></td>
          <td><input name=\"Preis\" ></td>
          <td><input name=\"Bild\" ></td>
          <td><input name=\"Bestand\"></td>
          <td><input type=\"submit\" name=\"Add\" value=\"Zu Artikel hinzufügen\"></td>";
    echo "</tr></form></table><br>";


//Falls keine Artikel
    if (mysql_num_rows($result) == 0) echo "Es gibt keine Artikel zum Kaufen .";
    echo "<br><input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php'\">";
}
ende();
?>