<?php
require_once 'headerfunc.inc.php';
headerausgabe("Benutzer");
Session_start();
//Verbindung herstellen
require 'Verbindung.php';

if($_SESSION['usernummer']=="1"){
//Abrufen aller Userdaten
$query="Select Nummer,Vorname, Name, Mail,Straße,Hausnummer,PLZ,Ort from user";
$result=mysql_query($query,$conn) or die (mysql_error());

//Wenn keine Benutzer registriert
if (mysql_num_rows($result)==0){
    echo"Keine Benutzer registriert.";
    echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php?.SID.'\">";
    exit();
}
//Ausgabe aller Userdaten aller User
echo"<table><tr><td>Nummer</td><td>Vorname</td><td>Nachname</td><td>Email</td><td>Straße</td><td>Hausnummer</td><td>PLZ</td><td>Ort</td></tr>";
while($line=mysql_fetch_array($result)){
    
   echo"<tr><td>$line[0]</td><td>$line[1]</td><td>$line[2]</td>
       <td>$line[3]</td><td>$line[4]</td><td>$line[5]</td>
           <td>$line[6]</td><td>$line[7]</td></tr>";


}}
 echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php?.SID.'\">";
 
ende();
?>