<?php
require_once 'headerfunc.inc.php';
headerausgabe("Bestellung");

//Herstellen der Verbindung
require 'Verbindung.php';
session_start();

//Abrufen der Artikeldaten,die vom User in den Warenkorb gelegt wurden
$query="Select Artikelnummer, Anzahl, Gesamtpreis from warenkorb where Usernummer = '$_SESSION[usernummer]'";
$result=mysql_query($query,$conn) or die (mysql_error());
$time=date('d-m-y');
$test="0";


while ($row = mysql_fetch_array($result)) {
   
    //Abrufen aller Artikeldaten
$query3="Select Artikelnummer,Name,Verein,Bild,Bestand from artikel where artikelnummer='$row[Artikelnummer]'";
$result3=mysql_query($query3,$conn) or die (mysql_error());
  

while ($row2 = mysql_fetch_array($result3)) {
       
//Überprüfung, ob Artikelanzahl vorhanden ist
if($row["Anzahl"]>$row2["Bestand"]){
   echo"Ihre Bestellung konnte nicht angenommen werde.<br> ";
   echo"Sie können leider nur so viele Artikel bestellen, wie wir auf Lager haben.<br>";
   echo"Ändern sie bitte die Anzahl der bestellten Artikel und versuchen Sie es erneut.<br> ";
   echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='warenkorbanzeige.php'\">";
   exit;
}    
//Übertragung der Daten an DB Bestellung
$query2="Insert INTO bestellung (Artikelnummer, Usernummer, Anzahl, Bestellzeitpunkt, Gesamtpreis, Kommentar) values ('$row[Artikelnummer]', '$_SESSION[usernummer]', '$row[Anzahl]', '$time', '$row[Gesamtpreis]','Wird bearbeitet')";
    $result2=mysql_query($query2,$conn) or die (mysql_error());
    
    //Berechnung des neuen Bestandes
    $bestand=$row2["Bestand"]-$row["Anzahl"];
    
  //Änderung der Bestandszahl in DB Artikel
    $query5="Update artikel set Bestand=$bestand where Artikelnummer='$row[Artikelnummer]'";
    $result5=mysql_query($query5,$conn) or die (mysql_error());
    
  //Überprüfung, ob erste Ausgabe, um Überschrift auszugeben
if($result2 and $result5){
    if($test=="0"){
        echo"<h1 align=\"center\" >Erfolgreiche Bestellung</h1>";$test++;}
        
 echo"<table align=\"center\"; border=\"1\"; text-align=\"center\";>";

//Falls es zum ersten Mal ausgegeben wird, wird die Spaltennamen ausgegeben
 if ($test=="1"){echo"<tr><td>Artikelnummer</td><td>Name</td><td>Verein</td><td>Bild</td><td>Anzahl</td>";} 

 //Ausgabe der Artikeldaten, die bestellt wurden
     echo"<tr><td>$row2[Artikelnummer]</td>
     <td>$row2[Name]</td>
     <td>$row2[Verein]</td>
     <td><img src=\"Bilder/$row2[Bild] \" height=100; alt:$row2[Bild] ></td>
     <td>$row[Anzahl]</td>
         <td>wird bearbeitet</td></tr>";
    echo"</table>";
    
}
else {echo"Fehler bei der Übertragung";}


//Artikel werden aus dem Warenkorb gelöscht
$query4="Delete from Warenkorb where Usernummer='$_SESSION[usernummer]'";
$result4=mysql_query($query4,$conn) or die (mysql_error());


if(!$result4){echo"Fehler bei der Löschung der Artikel aus dem Warenkorb.";}

}}

echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='seite.php?.SID.'\">";
ende();
?>
