<?php
    //Funktion gibt HTML-Code f�r den Header aus
    //als Parameter lässt sich ein Wert f�r den Titel der Seite �bergeben.
    function headerAusgabe($titel){
      $doctype="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" ";
      $doctype.="\"http://www.w3.org/TR/html4/transitional.dtd\">\n\r";

      $headtext= "<html>\n\r <head> \n\r <title>$titel</title> ";
      $headtext.="<meta http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"ISO-8859-1\"> ";
      $headtext.="<link rel=\"stylesheet\" type=\"text/css\" href=\"formate.css\"> ";
      $headtext.="</head>";
      $headtext.="<body>";

      print_r($doctype);
      print_r($headtext);
     }
     function ende(){
         echo "</body> \r\n";
         echo "</html>";
     }
?>
