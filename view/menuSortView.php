<?php
/**
 * @file        menuSortView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MenuSortView
    {
        function render($menuSortRang=[])
        {
?>

<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        
     
        
        <form action="" method="post">
            <p>
                Zurück zur Startseite
                <input type="submit" id="zurück" name="action" value="zurück" >
            
                Weiter zur nächsten Seit
                <input type="submit"  name="action" value="weiter" >
            </p>
            <h2>Menüsortierung:
                <?php
                    session_start();
                    echo $_SESSION['mandantname']; 
                    session_write_close();
                ?>
            </h2>
            <p>
                Mit Hilfe der Menü Sortierungspunkte können für Sie relevante Kategorien nach oben oder unten<br>
                verschoben werden.<br>
                Hierbei gilt: je niedriger die Zahl desto höher die Kategorie in der Menüleiste.<br>
                Bei einer Doppelbelegung eines Sortierungspunktes wird Alphabetisch angeordnet.<br>
            </p>
            <p style="color:blue;">
                Hinweis: Die Sortierung ist leider nicht für einzelne Benutzer anwendbar.
            </p>
        
            <?php
                $menuNamen =array('Artikel' => 'artikel','Kalender'=>'kalender','Kunde'=>'kunde','Projekt'=>'projekt','Lieferant'=>'lieferant','Ticket'=>'ticket',
                                    'Vorgang'=>'vorgang','Vertrag'=>'vertrag','Offene Posten'=>'offenePosten','Dienstleistung'=>'dienstleistungen','Lager'=>'lager','Produktion'=>'produktion',
                                    'Auswertung'=>'auswertung','Webshop'=>'webshop','Verleihartikel'=>'verleihartikel','Gerät'=>'geraet','Schnittstelle'=>'schnittstelle');
            ?>

            <?php foreach($menuNamen as $name => $menu):?>
                <label for=<?=$menu ?>><?=$name ?>:</label>
                <select id=<?=$menu ?> name=<?=$menu ?>>
                    <option value="  <?= !isset($menuListe[$menu]) ? 'selected' : '' ?> "> Wählen Sie ein Element aus.</option>
                    <?php for($i=1;$i<18;$i++):?>
                        <option value=<?=$i ?> <?= isset($menuSortRang[$menu]) && $menuSortRang[$menu] === $i ? 'selected' : '' ?>> <?= $i ?> </option>
                        
                    <?php endfor; ?>
                </select><br>
                <br>
            <?php endforeach;?>
        </form>
    </body>
</html>

<?php
        }
    }