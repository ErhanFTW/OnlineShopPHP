<?PHP 
require_once 'headerfunc.inc.php';
  $titel="Anmeldung";
  headerAusgabe($titel);
  
  //Abgreifen der Emailadresse und Hausnummer
$email = $_POST['email'];
$nummer = $_POST['hausnummer'];

// Wurden die Felder ausgefüllt
if ($email=="" or $nummer==""){
  echo "Eingabe unvollst&auml;ndig.";
  echo "<br><a href='passwortvergessen.html' >Zur&uuml;ck</a>";
  exit();  }
  
else {
 
    //Verbindung herstellen
      require 'Verbindung.php';

    //Abrufen der Daten des Users
 $query = "SELECT Vorname,Name,Mail,Passwort FROM user WHERE Mail='$email' and Hausnummer='$nummer'";
 $result=mysql_query($query,$conn) or die (mysql_error());
 $array = mysql_fetch_array($result);
 
 //Ausgabe des Namens und des Passworts
 if (mysql_num_rows($result)){
  echo " Hallo $array[0] $array[1],<br>
 deine E-Mail-Adresse lautet: $array[2]<br> und dein Passwort ist: $array[3]. 
 <br>
 <form>
 <input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='anmeldung.html'\">
 </form>  ";
 }
 
 else {
     echo"Diese Emailadresse ist nicht registriert.
     <form> 
     <input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='anmeldung.html'\">
 </form>";
}}
ende();
 ?>