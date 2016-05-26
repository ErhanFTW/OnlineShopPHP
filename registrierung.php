<?php
  require_once 'headerfunc.inc.php';
  session_start();

  $titel="Registrierung";
  headerAusgabe($titel);

//Abgreifen der Informationen
  $user=array();
  $user[0]=  time();//unix timestamp
  $user[1]=$_POST['vorname'];
  $user[2]=$_POST['nachname'];
  $user[3]=$_POST['email'];
  $user[4]=$_POST['passwort'];
  $user[5]=$_POST['strasse'];
  $user[6]=$_POST['hausnummer'];
  $user[7]=$_POST['plz'];
  $user[8]=$_POST['ort'];


//Überprüfen Leerfeld
if ($user[1]=="" or $user[2]=="" or $user[3]=="" or $user[4]=="" or $user[5]=="" or $user[6]=="" or $user[7]=="" or $user[8]==""){
  echo "Eingabe unvollst&auml;ndig.";
  echo "<br><a href='registrierung.html' >Zur&uuml;ck</a>";
  exit();  }

 else     {

     //Verbindung zu DB herstellen
 require 'Verbindung.php';

 //Userüberprüfung, wurde der Name+Mail oder nur Mailadresse schon einmal verwendet
 $query = "SELECT * FROM user WHERE ".
"(vorname='$user[1]') and (name='$user[2]') and (mail='$user[3]') or (mail='$user[3]')";
 $result=mysql_query($query,$conn) or die (mysql_error());

 if (mysql_num_rows($result)==0){$db=

//Einfügen der Userdaten in Datenbank User
  $query="INSERT INTO user(Nummer, Vorname, Name, Mail, Passwort, Stra�e, Hausnummer, PLZ, Ort,  Verein) values ('".$user[0]." ',";
  $query.="'".$user[1]."',";
  $query.="'".$user[2]."',";
  $query.="'".$user[3]."',";
  $query.="'".$user[4]."',";
  $query.="'".$user[5]."',";
  $query.="'".$user[6]."',";
  $query.="'".$user[7]."',";
  $query.="'".$user[8]."')";


  $result=mysql_query($query,$conn) or die(mysql_error());

  //Wenn erfolgreiche Übertragung, dann Ausgabe aller Userdaten des Users
  if($result){
      echo" <h1>Die Registrierung war erfolgreich!</h1> <br>";
      echo"<table>
      <tr><td>Vorname:</td> <td>$user[1]</td> </tr>
      <tr><td>Name:</td><td>$user[2]</td> </tr>
      <tr><td>Email:</td> <td>$user[3]</td></tr>
      <tr><td>Passwort:</td><td>$user[4]</td></tr>
      <tr><td>Straße:</td><td>$user[5]</td> </tr>
      <tr><td>Hausnummer:</td><td>$user[6]</td></tr>
      <tr><td>PLZ:</td> <td>$user[7]</td></tr>
      <tr><td>Ort:</td> <td>$user[8]</td> </tr>
      </table>";
      echo "<br><a href=../Desktop/SHOP/seite.php?'.SID.'>Hier gehts weiter</a>";
     
 //Übergabe der Daten an Session
 $_SESSION['usernummer'] = $user[0] ;
 $_SESSION['vorname']=$user[1];
 $_SESSION['name']=$user[2];
 $_SESSION['email'] = $user[3] ;
 $_SESSION['stra�e']=$user[5];
 $_SESSION['hausnummer'] = $user[6] ;
 $_SESSION['plz']=$user[7];
 $_SESSION['ort']=$user[8];
  }

  else{
      echo" Das war wohl nix!\r\n";
      echo"<br><a href=registrierung.html>Zur&uuml;ck</a>";
  }
 }

 else{
 echo "Dieser User ist bereits registriert.";
 echo"<br><a href=registrierung.html>Zur&uuml;ck</a>";
 ende();    }}

?>
