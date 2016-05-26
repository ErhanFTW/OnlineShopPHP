<?php session_start();
require_once 'headerfunc.inc.php';
$titel = "Kontoinformationen";
headerausgabe($titel);

//Verbindung herstellen
require 'Verbindung.php';

//Abrufen des Passworts
$query = "Select Passwort from User where Nummer='$_SESSION[usernummer]'";
$result = mysql_query($query, $conn) or die (mysql_error());

//"Speichern" des Passworts
if ($result) {
    $line = mysql_fetch_array($result);
    $passwort = $line[0];
}
?>
<html>
<!--Ausgabe der Userdaten in Textfeldern zum Bearbeiten -->
<body>
<form action="kontobearbeiten.php" method="post">
    <div align="center">
        <table border="1" cellpadding="4" width="600" rules="groups">
            <tr>
                <td width="120"></td>
                <td width="120"></td>
                <td width="120"></td>
                <td width="240"></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120"></td>
                <td width="120"></td>
                <td width="240"></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120"></td>
                <td width="120">Kontoinformationen:</td>
                <td width="240"></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Vorname:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Vorname\" value=\"$_SESSION[vorname]\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Nachname:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Name\" value=\"$_SESSION[name]\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Email:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Email\" value=\"$_SESSION[email]\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Passwort:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Passwort\" value=\"$passwort\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Adresse:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Strasse\" value=\"$_SESSION[strasse]\"><input type=\"text\" name=\"Hausnummer\" value=\"$_SESSION[hausnummer]\" size=\"5\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120"></td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"PLZ\" value=\"$_SESSION[plz]\" size=\"5\"><input type=\"text\" name=\"Ort\" value=\"$_SESSION[ort]\">"; ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120">Lieblingsverein:</td>
                <td width="120"></td>
                <td width="240"><?php echo "<input type=\"text\" name=\"Verein\" value=\"$_SESSION[verein]\">" ?></td>
            </tr>
            <tr>
                <td width="120"></td>
                <td width="120"></td>
                <td width="120" align="center"><input type="button" value=Zur&uuml;ck
                                                      onClick="window.location.href='seite.php?.SID.'"><input
                        type="submit" value="&Auml;ndern"><input type="submit" name="L�schen" value="L&ouml;schen"></td>
                <td width="240"></td>
            </tr>
        </table>
    </div>
</form>
</body>
</html>