<?php
require_once 'headerfunc.inc.php';
headerausgabe("Kontobearbeitung");
session_start();

//Abrufen der Userdaten
$user[0] = $_SESSION['usernummer'];
$user[1] = $_POST['Vorname'];
$user[2] = $_POST['Name'];
$user[3] = $_POST['Email'];
$user[4] = $_POST['Strasse'];
$user[5] = $_POST['Hausnummer'];
$user[6] = $_POST['PLZ'];
$user[7] = $_POST['Ort'];
$user[8] = $_POST['Verein'];
$passwort = $_POST['Passwort'];

//Verbindung zur Datenbank hergestellen
require 'Verbindung.php';

//Leerfeldüberprüfung
if ($user[1] == "" or $user[2] == "" or $user[3] == "" or $user[4] == "" or $user[5] == "" or $user[6] == "" or $user[7] == "" or $user[8] == "") {
    echo "Alle Felder müssen ausgefüllt sein.";
    echo "<br><a href='kontoinformationen.php?.SID.' >Zur&uuml;ck</a>";
    exit();
}

//Wurde der Button Löschen gedrückt
if (isset ($_POST["L�schen"])) {

    //Löschen der Userdaten
    $query = "Delete from user where Nummer='$user[0]'";
    $result = mysql_query($query, $conn) or die (mysql_error());

    if ($result) {
        //Beenden der Session und Weiterleitung zur Anmeldung.html
        session_unset();
        session_destroy();
        header('Location: anmeldung.html');
        echo "Abgemeldet";
    } else {
        echo "Fehler beim Löschen. Bitte erneut versuchen <br>";
        echo "<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='kontoinformationen.php?.SID.'\">";
    }
}

//Änderung der Daten in der Datenbank
$query2 = "UPDATE user SET Vorname = '$user[1]', Name = '$user[2]',Passwort =$passwort,Mail='$user[3]', Strasse='$user[4]',  Hausnummer='$user[5]', PLZ='$user[6]', Ort='$user[7]', Verein='$user[8]' WHERE Nummer = '$_SESSION[usernummer]'";
$result2 = mysql_query($query2, $conn) or die (mysql_error());


if ($result2) {
    echo "&Auml;nderung erfolgreich<br>";
    echo "<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='kontoinformationen.php?.SID.'\">";
} else {  //Fehlermeldung, wenn die Daten nicht aktualisiert werden konnten
    echo "A&uml;nderung Fehlgeschlagen<br>";
    echo "<input type=\"button\" value=\"Zur&uuml;ck\" onClick=\"window.location.href='kontoinformationen.php?.SID.'\">";

}

//Neustart der Session mit neuen Userdaten
session_destroy();
session_start();
$_SESSION['usernummer'] = $user[0];
$_SESSION['vorname'] = $user[1];
$_SESSION['name'] = $user[2];
$_SESSION['email'] = $user[3];
$_SESSION['strasse'] = $user[4];
$_SESSION['hausnummer'] = $user[5];
$_SESSION['plz'] = $user[6];
$_SESSION['ort'] = $user[7];
$_SESSION['verein'] = $user[8];

ende();

?>