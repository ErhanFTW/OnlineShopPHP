<div id="logo">
    <?php

    //Beginn des PHP-Dokuments

    require_once 'headerfunc.inc.php';
    $titel = "Hauptseite";
    headerausgabe($titel);
    session_start();
    $usernummer = $_SESSION['usernummer'];

    if ($usernummer == "") {
        exit();
    }
    
    ?>
    
</div>

<div id="Mitte">
    <div id="Kopf">
        <?php require 'anmeldeinformation.html';

        ?>
    </div>
    
    <div id="menue">
        
        <?php
        
        $query2 = "Select name from artikel group by name";
        $result2 = mysql_query($query2, $conn) or die(mysql_error());
        
        //SQL-Anfrage wird gesendet; im Erfolgsfall wird eine Ergebniskennung ausgegeben
        //im Misserfolgsfall wird false zurückgegeben.

        echo "<form action=\"seite.php\"method=\"post\">";
        while ($line = mysql_fetch_array($result2)) {
            echo "<input type=\"submit\" name=$line[0] value=$line[0] >";
        }


        ?>
    </div>
    Herzlich Willkommen in unserem Kamehameha-Onlineshop,<br>
    
    <?php
    //Abrufen der Artikelkategorien
    $query3 = "Select name from artikel group by name";
    $result3 = mysql_query($query3, $conn) or die(mysql_error());

    while ($line = mysql_fetch_array($result3)) {
        //Wenn Menübutton angeklickt, dann Ausgabe der entsprechenden Artikel
        if (isset($_POST["$line[0]"])) {
            if ($_POST[""] == "Mein") {
                $where = "and ='$verein'";
            } else $where = "";
            //Abrufen der Artikeldaten
            $query4 = "Select * from artikel where name='$line[0]' $where";
            $result4 = mysql_query($query4, $conn) or die(mysql_error());

            if (mysql_num_rows($result4) == "0") {
                echo "In dieser Kategorie gibt es leider keine Artikel";
            }

            echo "<table style=\"border:1px;margin:10px;padding:1px;text-align:center;valign:middle;\">";

            while ($line = mysql_fetch_array($result4)) {
                //Ausgabe der Artikel
                echo "<tr><th>Artikelnummer</th><th>Name</th><<th>Bild</th><th>Preis</th><th>Bestand</th><th>Anzahl</th><th></th> \n\r";
                echo "<tr>";
                echo "<td>" . $line["Artikelnummer"] . "</td>
          <td>" . $line["Name"] . "</td>
              <td><img src=\"Bilder/$line[Bild]\" height=100; alt:$line[Bild] ></td>
                  <td>" . $line["Preis"] . "</td>
                      <td>" . $line["Bestand"] . "</td>
                      <td><form action=\"warenkorb.php\" method=\"post\"><input name=" . $line["Artikelnummer"] . " size=10></td>
                        <td><input type=\"submit\" value=\"in den Warenkorb\"></td>
                          </form>";
                echo "</tr>";
            }
            echo "</table>";
            mysql_free_result($result4);
        }
    }
    mysql_free_result($result3);
    echo "</div>";
    ?>
</div>
<div id="Rechts">
    <div id="Warenkorb">
        <?php
        require 'waren.php';  //Anzeige für Artikel und Gesamtpreis
        ?>

    </div>
    <!-- Link zu den getätigten Bestellungen    -->
    <div id="Bestellung">
        <a href="bestellungenalt.php">Hier</a> k�nnen sie ihre bisherigen Bestellungen sehen.
    </div>
    <!-- Links für Händler für getätigte Bestellungen,Artikelbestand,Benutzerdaten         -->
    <?php if ($usernummer == "1") {
        echo "<div id=\"Haendler\">";
        echo "<a href=\"warenbestand.php\">Hier</a> können sie Ihren Warenbestand ändern.";
        echo "<br><br>";
        echo "<a href=\"allebestellungen.php\">Hier</a> können sie alle Bestellungen sehen.";
        echo "<br><br>";
        echo "<a href=\"user.php\">Hier</a> können sie alle Benutzerdaten sehen.";
        echo "</div>";
    }
    ende(); ?>
</div>
    
