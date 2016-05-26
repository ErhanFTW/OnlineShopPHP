<?php

//Abrufen der Usernummer
$usernummer = $_SESSION["usernummer"];

//Abrufen des Gesamtpreises der Artikel im Warenkorb des User
$query = "SELECT Gesamtpreis  FROM warenkorb WHERE Usernummer ='$usernummer '";
$result = mysql_query($query, $conn) or die (mysql_error());
$wert = "0";

//Zählen des Gesamtpreises
while ($geld = mysql_fetch_array($result)) {
    $wert = $wert + $geld[0];
}

//Z#hlen der Artikel
$row = mysql_num_rows($result);

//Ausgabe
echo "Im <a href=\"warenkorbanzeige.php?'.SID.'\">Warenkorb</a> befinden sich $row Artikel zum Preis von $wert €";

?>
