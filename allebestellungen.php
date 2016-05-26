<?php
require_once 'headerfunc.inc.php';
headerausgabe("Alle Bestellungen");
session_start();

//Herstellen einer Verbindung
require 'Verbindung.php';

if($_SESSION['usernummer']=="1"){
    
//Abrufen aller Daten der DB Bestellung
$query="Select * from Bestellung";
$result=mysql_query($query,$conn) or die (mysql_error());

//Wenn keine Bestellungen
if (mysql_num_rows($result)==0){
    echo"Keine Bestellungen<br>";
    echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php'\">";
    exit();
}

//Ausgabe aller Bestellungen
echo"<table>";
echo"<tr><td>Artikelnummer</td><td>Usernummer</td><td>Anzahl</td><td>Bestellzeitpunkt</td><td>Gesamtpreis</td>";
while ($row=mysql_fetch_array($result)){
    echo"<form action=\"status.php\" method=\"post\">";
    $name=$row[0].$row[1];
      echo"<tr><td>$row[0]</td>
      <td>$row[1]</td> 
      <td>$row[2]</td>
      <td>$row[3]</td>
     <td>$row[4]</td> 
      <td><input type=\"text\" name=$name value='$row[5]'></td>
      <td><input type=\"submit\"></td></tr>";
    echo"</form>";
}
echo"</table>";
}
echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php'\">";
ende();
?>