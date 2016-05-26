<?php
 require_once 'headerfunc.inc.php';
  $titel="Anmeldung";
  headerAusgabe($titel);
  
 //Abgreifen der Anmeldeinformation
 $anmeldung=array();
 
 //Herstellen einer Verbindung
 require 'Verbindung.php';
 
 $anmeldung[0]=$_POST['email'];
 $anmeldung[1]=$_POST['Passwort'];
    
  //Überprüfen, ob es Leerfelder sind
if ($anmeldung[0]=="" or $anmeldung[1]=="" ){
  echo "Eingabe unvollst&auml;ndig.";
  echo "<br><a href='anmeldung.html' >Zur&uuml;ck</a>";
  exit();  }
  
else {
    
 //Gibt es den User, der sich anmelden will bzw. stimmt das Passwort
 $query = "SELECT * FROM user WHERE ".
"(Mail='$anmeldung[0]') and (Passwort='$anmeldung[1]')";
 $result=mysql_query($query,$conn) or die (mysql_error());
 
 if (mysql_num_rows($result)){
     
 header("Location: seite.php?'.SID.'");
 
//Erfassen der Usernummer,Username,Usernachname
 $query = "SELECT * FROM user WHERE Mail='$anmeldung[0]'";
 $result=mysql_query($query,$conn);
 
 $zeile = mysql_fetch_array( $result, MYSQL_ASSOC);
 $nummer = $zeile['Nummer'];
 $name=$zeile['Name'];
 $vname=$zeile['Vorname'];
 $email=$zeile['Mail'];
 $straße=$zeile['Straße'];
 $hausnr=$zeile['Hausnummer'];
 $plz=$zeile['PLZ'];
 $ort=$zeile['Ort'];
 $verein=$zeile['Verein'];
 
 //Usernummer per Session weitergeben
 session_start();
 
 // Session Variablen setzen
$_SESSION['usernummer'] = $nummer ;
$_SESSION['name']=$name;
$_SESSION['vorname']=$vname;
$_SESSION['email'] = $email ;
$_SESSION['straße']=$straße;
$_SESSION['hausnummer']=$hausnr;
$_SESSION['plz'] = $plz ;
$_SESSION['ort']=$ort;
$_SESSION['verein']=$verein;

 }
else {
header('Location: anmeldungfehlgeschlagen.php');

}

 
 }
 ende();
?>