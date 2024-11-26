<?php

    class VorgangSortView
    {
        function render($vorgangListe=[])
        {
?>

<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        
        <h2>
            Vorgangssortierung:
            <?php
                session_start();
                    echo $_SESSION['mandantname']; 
                session_write_close();
                ?>
        </h2>
        <form action="" method="post">

        Zurück zur Startseite
            <input type="submit" id="zurueck" name="action" value="zurueck" >
            Weiter zur nächsten Seite
            <input type="submit" id="weiter" name="action" value="weiter" >
            <br>
            <br>
        
            
            <?php
                $vorgangNamen =array('Angebot'=>'angebot','Auftragsbestätigung'=>'auftragsbestaetigung','Serviceauftrag'=>'serviceauftrag','Teil Lieferschein'=>'teilLieferschein','Lieferschein'=>'lieferschein',
                                        'Rechnung'=>'rechnung','Proforma Rechnung' =>'proformaRechnung','Individual Bestellung'=>'individualBestellung','Stornorechnung / Gutschrift'=>'stornorechnungGutschrift',
                                        'Mahnung' =>'mahnung','Bestellung'=>'bestellung','Eingangsrechnung'=>'eingangsrechnung','Eingangslieferschein'=>'eingangslieferschein','Produktionsaufrag'=>'produktionsauftrag',
                                        'Rücknahme'=>'ruecknahme','Verleihrückname'=>'verleihrueckname','Webbestellung'=>'webbestellung','Packschein'=>'packschein','Fertigstellung'=>'fertigstellung','Preisanfrage'=>'preisanfrage','Brief'=>'brief',
                                        'Zahlungserinnerung'=>'zahlungserinnerung','Zweite Mahnung'=>'zweiteMahnung');
            ?>

            <?php foreach($vorgangNamen as $name => $vorgang):?>
                <label for=<?=$vorgang ?>><?=$name?>:</label>
                <select id=<?=$vorgang ?> name=<?=$vorgang ?>>
                    <option value=""  <?= !isset($vorgangListe[$vorgang]) ? 'selected' : '' ?> > Wählen Sie ein Element aus.</option>
                    <?php for($i=1;$i<18;$i++):?>
                        <option value=<?=$i ?> <?= isset($vorgangListe[$vorgang]) && $vorgangListe[$vorgang] === $i ? 'selected' : '' ?>> <?= $i ?> </option>
                        
                    <?php endfor; ?>
                </select><br><br>
            <?php endforeach;?>
            
        </form>

<?php
        }
    }