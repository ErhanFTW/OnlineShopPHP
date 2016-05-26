<?php
require_once 'headerfunc.inc.php';
session_start();

$titel="Warenkorb";
  headerAusgabe($titel);
  
  require 'Verbindung.php';
    
  $query1="SELECT Artikelnummer FROM artikel";
  $result1=mysql_query($query1,$conn) or die(mysql_error());
  //SQL-Anfrage wird gesendet; im Erfolgsfall wird eine Ergebniskennung ausgegeben
  //im Misserfolgsfall wird false zurÃ¼ckgegeben.

  
  if (!isset($db)){
      echo "Verbindungsfehler";
  }
  else{
  $usernummer=$_SESSION['usernummer'];
   //Abgreifen der Usernummer

  if (!isset($usernummer)){
      echo"Sie sind nicht angemeldet";
      echo"<a href=\"anmeldung.html\">Hier gehts zur Anmeldung</a>";
      exit();
     }
  //Es wird überprüft, ob die Person angemeldet ist. Wenn nicht dann wird das Script abgebrochen.

     else{
   
   while ($line=mysql_fetch_array ($result1)){
    
    if (isset ($_POST["$line[0]"])){
    $artikel=$_POST["$line[0]"];

    //Überprüfen ob Artikel ausgewählt wurden
    if ($artikel=="" or $artikel=="0"){
        echo"Es wurde leider keine Anzahl eingegeben.";
        echo"<form> <input type=\"button\" value=\"Weiter einkaufen\" onClick=\"window.location.href='seite.php'\"></form>";
        exit();}
  
    else{
    $query2="Select * from Warenkorb where Usernummer=$usernummer and Artikelnummer='$line[0]'";    
    $result2=mysql_query($query2,$conn) or die(mysql_error());
    if (mysql_num_rows($result2))  {
        $ware=mysql_fetch_array ($result2);
        $anzahl=$artikel+$ware['Anzahl'];
        $gpreis=$anzahl*$ware['Gesamtpreis'];
        
        $query3="Update warenkorb set Anzahl=$anzahl, Gesamtpreis=$gpreis where Artikelnummer ='$line[0]' and Usernummer =$usernummer";
        $result3=mysql_query($query3,$conn) or die(mysql_error());
        
        If ($result3){
            echo" <h1>Erfolgreich in den Warenkorb gelegt!</h1> <br>";
      echo"Im Warenkorb befand sich schon der ausgesuchte Artikel, deshalb befindet sich der Artikel nun wie folgt im Warenkorbs: <br>
          <table>
      <tr><td>Artikelnummer:</td> <td>$ware[Artikelnummer]</td> </tr>
      <tr><td>Name:</td><td>$ware[Name]</td> </tr>
      <tr><td>Verein:</td> <td>$ware[Verein]</td></tr>
      <tr><td>Preis:</td><td>$ware[Preis]</td></tr>
      <tr><td>Anzahl:</td><td>$anzahl</td> </tr>
      <tr><td>Gesamtpreis:</td><td>$gpreis €</td></tr>
      </table>";
      echo"<form> <input type=\"button\" value=\"Weiter einkaufen\" onClick=\"window.location.href='seite.php'\"></form>";
      echo"<form> <input type=\"button\" value=\"Weiter zum Warenkorb\" onClick=\"window.location.href='warenkorbanzeige.php'\"></form>";
    } }
    else{    
    $query4="SELECT Artikelnummer, Name, Verein, Preis FROM artikel where Artikelnummer='$line[0]'";
    $result4=mysql_query($query4,$conn) or die(mysql_error());
    
   
//Abrufen der Daten des Artikels, der ausgewählt wurden
    while ($row=mysql_fetch_array ($result4)){ 

    //Einfügen der Daten in die Datenbank Warenkorb
    $preis=$artikel*$row[3];
    $query="INSERT INTO warenkorb (Usernummer, Artikelnummer, Name, Verein, Preis, Anzahl, Gesamtpreis) values ('$usernummer',";
    $query.="'".$row[0]."',";
    $query.="'".$row[1]."',";
    $query.="'".$row[2]."',";
    $query.="'".$row[3]."',";
    $query.="'$artikel',";
    $query.="'$preis')";
      
    $result5=mysql_query($query,$conn) or die(mysql_error());
//Ausgabe der Daten, die in den Warenkorb übertragen wurden
    if($result5){
      echo" <h1>Erfolgreich in den Warenkorb gelegt!</h1> <br>";
      echo"<table>
      <tr><td>Artikelnummer:</td> <td>$row[0]</td> </tr>
      <tr><td>Name:</td><td>$row[1]</td> </tr>
      <tr><td>Verein:</td> <td>$row[2]</td></tr>
      <tr><td>Preis:</td><td>$row[3]</td></tr>
      <tr><td>Anzahl:</td><td>$artikel</td> </tr>
      <tr><td>Gesamtpreis:</td><td>$preis</td></tr>
      </table>";
      echo"<form> <input type=\"button\" value=\"Weiter einkaufen\" onClick=\"window.location.href='seite.php'\"></form>";
      echo"<form> <input type=\"button\" value=\"Weiter zum Warenkorb\" onClick=\"window.location.href='warenkorbanzeige.php'\"></form>";
      
    }

    else {echo"Fehler bei der Übertragung";}
      


    }}}
}
}
}
  } 

ende();
?>
