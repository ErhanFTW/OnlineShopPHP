<?php
session_start();
require_once 'headerfunc.inc.php';
headerausgabe("Warenkorb");

//Usernummer abrufen
$usernummer=$_SESSION['usernummer'];

//Verbindung herstellen
require 'Verbindung.php';

//Abrufen der Daten aus DB Warenkorb
$query="SELECT *  FROM warenkorb WHERE Usernummer ='$usernummer '";
$result=mysql_query($query,$conn) or die (mysql_error());

//Wenn keine Artikel im Warenkorb
if (mysql_num_rows($result)==0) echo"Es befinden sich keine Artikel im Warenkorb.<br>";
else{
    
   //Ausgabe der Artikel im Warenkorb 
 echo "<table style=\"border:1px;margin:10px;padding:1px;text-align:center;valign:middle;\">\n\r";
 echo "<tr><th>Artikelnummer</th><th>Name</th><th>Preis</th><th>Verein</th><th>Anzahl</th><th>Gesamtpreis</th> \n\r";
while ($line = mysql_fetch_array($result)) {
   
  echo "<tr>";
      echo "<td>$line[Artikelnummer]</td>
          <td>$line[Name]</td>
          <td>$line[Preis] </td><td>$line[Verein]</td>
          <td><form action=\"warenkorbbearbeiten.php\" method=\"post\">
          <input type=\"text\" name=".$line['Artikelnummer']." value=$line[Anzahl] size=10></td>
          <td>$line[Gesamtpreis]</td>
          <td><input type=\"submit\" value=\"ändern\"></form></td>";
                         
      echo "</tr><tr>&nbsp;</tr><br><br>";

     

}
//Bestellbutton
echo"<tr><td></td><td></td><td></td><td><form action=\"bestellung.php\" method=\"post\"><input type=\"submit\" align=\"center\" value=\"Bestellen\"></td></tr></form>";
echo"</table><br>";

echo"Möchten Sie einen Artikel aus dem Warenkorb entfernen, tragen Sie entweder eine 0 ein oder Sie lassen das Feld frei und drücken auf ändern<br>";
}

echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php'\">";
ende();
?>