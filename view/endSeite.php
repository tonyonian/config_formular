<?php

/**
 * @file        endSeite.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class EndSeite
    {
        function render()
        {

?>

<!DOCTYPE html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        
        <h2>Zahlungsarten:
            <?php
                session_start();
                echo $_SESSION['mandanten'];
                session_write_close();
            ?>
        </h2>

        <p>
            In der GLORiXX ERP gibt es die Möglichkeit verschiedene Zahlungsarten mit einem passenden Text<br> 
            der z.B. in der Rechnung erscheinen soll zu erstellen.<br>

            Name:			Zahlungsart:			Text:	<br>				

            Rechnung 14 Tage	Rechnung			Zahlung innerhalb 14 Tage…		<br>
            Lastschrift 3 Tage	Lastschrift			Wir buchen den Betrag			<br>										
            Barzahlung Sofort	Barzahlung			Zahlung erfolgt in Bar…			<br>	
            Vorkasse		Vorkasse			Vorkasse…	                        <br>

            Beispiel Rechnung: <br><br>
            Zahlung innerhalb von 14 Tagen ab Rechnungseingang ohne Abzüge an die unten angegebene <br>
            Bankverbindung<br>


            Bitte teilen Sie uns Ihre bevorzugten Zahlungsarten und die dazugehörigen Texte wie oben <br>
            angegeben schriftlich mit.

        </p>

        <h2>Druckbelege:
            <?php
                session_start();
                echo $_SESSION['mandanten'];
                session_write_close();
            ?>
        </h2>

        <p>
            Bitte übersenden Sie uns ein Muster PDF (aus Ihrem alten Warenwirtschaftssystem) zu jedem
            Vorgang den Sie beabsichtigen in GLORiXX ERP zu nutzen. Diese Muster helfen uns um für Sie die
            Belege anzupassen.
        </p><br><br>

        <h2>Stammdaten:
            <?php
                session_start();
                echo $_SESSION['mandanten'];
                session_write_close();
            ?>
        </h2>
        <p>
            Bitte lassen Sie uns Ihre Stammdaten (Kunden/ Lieferanten und Artikel) in Excel-Format zukommen.<br>
            Diese werden dann von uns aufbereitet und für den Import vorbereitet.<br>
        <p>
        
        <h1>Hinweis:</h1>
        <p>
            Es werden von uns die vorhandenen Daten lediglich für den Import bearbeitet. Es wir von unserer<br>
            Seite keine Datenpflege (Vervollständigung von Daten / Löschen von nicht mehr benötigten<br>
            Datensätze usw.) durchgeführt.
        </p>
        

    </body>
</html>

<?php
        }
    }