
    
<?php

    class StartSeite
    {
        function render()
        {
?>

<!DOCTYPE html>
<html>
    <body>
        <img src="./images/LogoHeintze.png"></img>
        <img src="./images/LogoGlorixx.png"></img>

        <h1>Willkommen zur GLORiXX ERP Konfigurationsauskunft</h1>
            Dieses Formular dient in erster Linie dazu grundlegende Informationen zu erfassen. Dies soll nicht nur
            <br> 
            Zeit und Kosten einsparen, sondern auch einen reibungslosen Start Ihrer GLORiXX ERP ermöglichen.
            <br><br>
            Um Ihnen den bestmöglichen Service der Grundkonfiguration Ihrer GLORiXX ERP zu ermöglichen, sind
            <br> 
            auf den folgenden Seiten die für einen reibungslosen Arbeitsablauf notwendige Informationen zu
            <br> 
            Ihrem Unternehmen einzutragen.
            <br><br>
            Sie haben Fragen zum Formular oder allgemein zur GLORiXX ERP?
            <br><br>
            Sie erreichen uns telefonisch unter  0202 75 88 9001  oder per Email an glorixx@heintze.de.
            <br><br>
            Wir bedanken uns für Ihr Vertrauen und wünschen Ihnen einen erfolgreichen Start mit GLORiXX ERP.
            <br><br><br>
            Ihr heintze Service Team.
            <br><br><br><br>
            Besuchen Sie uns im Web unter <a header href="http://www.heintz.de">www.heintz.de</a>
            <br><br>
            Weitere Informationen zu GLORiXX ERP im Web unter <a href="http://www.glorixx.de">www.glorixx.de</a>
            <br><br>
            oder auch auf YouTube unter <a href="http://www.youtube.com/@glorixxsoftware1735">www.youtube.com/@glorixxsoftware1735</a>
            <br><br>

            <?php session_write_close(); ?> 
            <button onclick="window.location.href='index.php?seite=mandant&<?php echo $_SESSION['sessionName']; ?>=<?php echo $_SESSION['sessionId']; ?>'">Starte Formular</button>

    </body>
</html>
<?php
        }
    }


