<?php 
require_once 'headerfunc.inc.php';
headerausgabe("Warenbestand bearbeiten");
session_start();

//Seite nur f�r H�ndler
if ($_SESSION['usernummer']=="1"){

//Verbindung zur Datenbank
require'Verbindung.php'; 

//Abrufen aller Artikeldaten
$query="Select * from artikel"; 
$result=mysql_query($query,$conn) or die (mysql_error());

while ($line = mysql_fetch_array($result)){
    
   if(isset($_POST[$line["Artikelnummer"]])) { //Wurde ein Wert mit der Artikelnummer �bertragen
         
 
    //Empfangen der Daten aus den Textfeldern
    $name=$_POST["Name"];
         $verein=$_POST["Verein"];
         $preis=$_POST["Preis"];
         $bild=$_POST["Bild"];
         $bestand=$_POST["Bestand"];     
         
 //Leerfeld�berpr�fung   
  if ($name=="" or $verein=="" or $preis=="" or $bild=="" or $bestand=="" ){
  echo "Eingabe unvollst&auml;ndig. Alle Felder m�ssen ausgef�llt sein.";
  echo "<br><a href='warenbestand.php?.SID.' >Zur&uuml;ck</a>";
  exit();  }
        
       
//�nderung der Artikeldaten in der DB
$query3="UPDATE artikel SET   Preis='$preis', Name='$name', Verein='$verein', Bild='$bild', Bestand='$bestand' WHERE  Artikelnummer= '$line[Artikelnummer]'";
$result3=mysql_query($query3,$conn) or die (mysql_error());

    }
 
    //wurde der Button L�schen gedr�ckt
if (isset($_POST["L�schen$line[Artikelnummer]"])){
    
    //l�schen des Artikels aus der DB
$query2="Delete  from artikel where Artikelnummer='$line[0]'";
 $result3=mysql_query($query2,$conn) or die (mysql_error());}
 
 //wurde der Button Hinzuf�gen geklickt
 if (isset($_POST["Add"])){
     
     //Empfangen der Daten aus den "leeren" Feldern f�r neuen Artikel
 $artikelnummer=$_POST["Artikelnummer"];
 $name=$_POST["Name"];
 $verein=$_POST["Verein"];
 $preis=$_POST["Preis"];
 $bild=$_POST["Bild"];
 $bestand=$_POST["Bestand"];
 
 //Hinzuf�gen der Daten in DB Artikel
 $query3="Insert INTO artikel (Artikelnummer, Name, Verein, Preis, Bild, Bestand ) values ('$artikelnummer', '$name', '$verein', '$preis', '$bild', $bestand)";
  $result3=mysql_query($query3,$conn) or die (mysql_error());
 }
  
if ($result3)header("Location: warenbestand.php");//Weiterleitung zur Seite Warenbestand
   else{ echo "Fehler bei der �bertragung";
   echo"<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='warenbestand.php'\">";
   }
  
}}

 ende();  
?>