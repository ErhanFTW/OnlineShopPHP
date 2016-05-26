<div id="logo">
    <?php
    require_once 'headerfunc.inc.php';
    $titel = "Hauptseite";
    headerausgabe($titel);
    session_start();


    $usernummer = $_SESSION['usernummer'];
    $verein = $_SESSION['verein'];

    if ($usernummer == "") {
        exit();
    }
    require 'Verbindung.php';

    if ($verein == "Borussia Dortmund")
        echo "<img src=\"Bilder/bvb-wappen.jpg\" width=\"100%\">";
    elseif ($verein == "FC Bayern München")
        echo "<img src=\"Bilder/fcb-wappen.jpg\" width=\"100%\">";
    elseif ($verein == "VFB Stuttgart")
        echo "<img src=\"Bilder/vfb-wappen.jpg\" width=\"100%\">";

    //Abrufen des Lieblingsvereins und Einfügen des Wappens
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
        echo "<span style=\"color:white\"><input type=\"radio\" name=\"Verein\" value=\"Mein\" checked> Mein Verein 
    <input type=\"radio\" name=\"Verein\" value=\"Alle\"> Alle Vereine<br></style>";
        echo "</form>";
        //Ausgabe Menübutton
        mysql_free_result($result2);

        ?>

    </div>

    Herzlich Willkommen in unserem Onlineshop,<br>
    Wenn sie auf ihren Namen klicken, können sie ihre Benutzerdaten ändern und ihr Benutzerkonto löschen.<br>
    In der Menüleiste können sie auswählen, ob sie alle Vereine oder nur ihren Verein angezeigt haben wollen.<br>
    Wenn sie rechts oben auf Warenkorb klicken gelangen sie zu ihrem Warenkorb und können ihre Bestellung tätigen.<br>
    Darunter finden sie unter Hier alle ihre bisherigen Bestellungen.<br>
    Viel Spass beim Einkaufen <br>
    Ihr Fanshop-Verkäufer

    <?php

    //Hintergrundfarbe entsprechend zum Lieblingsverein


    if ($verein == "Borussia Dortmund")
        echo "<div id=\"Dort\">";
    elseif ($verein == "FC Bayern München")
        echo "<div id=\"Bayern\">";
    else if ($verein == "VFB Stuttgart")
        echo "<div id=\"haupt\" style=\"background-color:white\">";


    //Abrufen der Artikelkategorien
    $query3 = "Select name from artikel group by name";
    $result3 = mysql_query($query3, $conn) or die(mysql_error());


    while ($line = mysql_fetch_array($result3)) {

        //Wenn Menübutton angeklickt, dann Ausgabe der entsprechenden Artikel
        if (isset($_POST["$line[0]"])) {
            if ($_POST["Verein"] == "Mein") {
                $where = "and verein='$verein'";
            } else $where = "";

            //Abrufen der Artikeldaten
            $query4 = "Select * from artikel where name='$line[0]' $where";
            $result4 = mysql_query($query4, $conn) or die(mysql_error());

            if (mysql_num_rows($result4) == "0") {
                echo "In dieser Kategorie gibt es leider keine Artikel für ihren Verein";
            }

            echo "<table style=\"border:1px;margin:10px;padding:1px;text-align:center;valign:middle;\">";

            while ($line = mysql_fetch_array($result4)) {

                //Ausgabe der Artikel
                echo "<tr><th>Artikelnummer</th><th>Name</th><th>Verein</th><th>Bild</th><th>Preis</th><th>Bestand</th><th>Anzahl</th><th></th> \n\r";
                echo "<tr>";
                echo "<td>" . $line["Artikelnummer"] . "</td>
          <td>" . $line["Name"] . "</td>
              <td>" . $line["Verein"] . "</td>
              <td><img src=\"Bilder/$line[Bild]\" height=100; alt:$line[Bild] ></td>
                  <td>" . $line["Preis"] . " �</td>
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
    
