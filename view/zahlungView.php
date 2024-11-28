<?php
/**
 * @file        zahlungView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    header('Content-Type: text/html; charset=UTF-8'); // Für die Anzeige der Währungen
    class ZahlungView
    {
        function render($waehrungListe=[])
        {
?>

<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        
        <h1>
            Währung und Zahlung 
            <?php
                session_start();
                    echo $_SESSION['mandantname']; 
                session_write_close();
            ?>
        </h1>

        <h2>Bitte wählen Sie die Währungen aus, für die Sie eine Zahlung durchführen möchten:</h2>
        <br>
        <form action="" method="post">
            Zurück zur Startseite
            <input type="submit" id="zurück" name="action" value="zurück" >
            Daten unwiederruflich senden
            <input type="submit" id="absenden" name="action" value="absenden" >
            <br>
            <br>
            <?php
                $waehrungNamen =array('EURO' =>array('euro','EUR','€'), 'Dollar'  => array('dollar','USD','$'), 'Yen'  => array('yen','JPY','¥'), 'Britische Pfund' => array('britischerPfund','GBP','£') ,
                'Australische Dollar'  => ['australischeDollar','AUD','$'] ,
                'Kanadischer Dollar'=> array('kanadischeDollar','CAD','$'), 'Schweizer Franken' => array('schweizerFranken','CHF','Fr'),
                'Chinesische Renminbi'  => array('chinesischeRenminbi','CNY','¥'), 'Schwedische Krone' => array('schwedischeKrone','SEK','Skr'),
                'Neuseeländischer Dollar' => array('neuseelaendischerDollar','NZD','$')  );

                foreach($waehrungNamen as $name => $vorgang):
            ?>
                    <label for=<?=$vorgang[0]?>><?=$name?><?=$vorgang[1] ?><?=$vorgang[2] ?></label>
                    
                    <?php 
                        if (isset($waehrungListe[$vorgang[0]]) && $waehrungListe[$vorgang[0]] == 1): 
                    ?>
                            <input type="hidden" name="<?=$vorgang[0]?>" value="<?= $waehrungListe[$vorgang[0]] ?>">
                            <input type="checkbox" id=<?=$vorgang[0]?> name="<?=$vorgang[0]?>" checked value="<?= $waehrungListe[$vorgang[0]] ?>">
                    <?php 
                        elseif(isset($waehrungListe[$vorgang[0]]) && $waehrungListe[$vorgang[0]] == 0): 
                    ?>
                            <input type="hidden" name="<?=$vorgang[0]?>" value=0>
                            <input type="checkbox" id=<?=$vorgang[0]?> name="<?=$vorgang[0]?>">
                    <?php endif; ?>
                    <br>
            <?php endforeach;?>
        </form>
    </body>
</html>

<?php
        }
    }