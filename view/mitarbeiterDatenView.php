<?php
/**
 * @file        mitarbeiterDatenView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MitarbeiterDatenView
    {
        public function render()
        {
?>
<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        <form action="" method="post" enctype="multipart/form-data">

            <!-- Navigation -->
            <p>
                Zurück zur Startseite
                <input type="submit" id="zurück" name="action" value="zurück" >
                Weiter zur nächsten Seite
                <input type="submit" id="weiter" name="action" value="weiter" >
            </p>
            <h1>
                <?php
                    session_start();
                    echo $_SESSION['mitarbeiterInfo']['benutzername'];
                    session_write_close(); 
                ?>
                Persönliche Daten (freiwillige Angabe)
            </h1>
            <br>

        
            
            <?php
                $config =array('Straße'=>'strasse', 'Hausnummer' => 'hausnummer', 'Postleitzahl' => 'plz', 'Stadt' => 'stadt', 
                                'Land' => 'land', 'Telefon' => 'telefon', 'Mobil' => 'mobil', 'Fax' => 'fax', 'Email' => 'email', 'IBAN' => 'iban', 'BIC' => 'bic',
                                'Bank' => 'bank');
                session_start();

                
                
                foreach ($config as $name => $value): 
            ?>
                <label for="<?= $value ?>"><?=$name ?>:</label>
                <input type="<?php
                                    if($value == 'email')
                                    {
                                        echo 'email';
                                    }
                                    else{echo $value;} 
                                ?>"

                            id="<?= $value ?>" name="<?= $value ?>"

                            <?php 
                                $datVal = isset($_SESSION['mitarbeiterDaten'][$value]) ? trim($_SESSION['mitarbeiterDaten'][$value]) : ''; 
                                $datVal = htmlspecialchars($datVal, ENT_QUOTES, 'UTF-8'); 
                            ?>
                            value="<?= $datVal ?>" />
                <br><br><br>
                
            <?php 
            	endforeach;

            ?>
            <label for="bemerkung">Bemerkung:</label>
            <textarea name="bemerkung" cols="40" rows="5" ><?= $datVal['bemerkung'] ?? '' ?></textarea><br>
            <?php session_write_close(); ?>
            <p>
                Ein weiteren Mitarbeiter hinzufügen
                <input type="submit" id="neuMit" name="action" value="weiterer Mitarbaiter" >
        </form>
    </body>
</html>
<?php
        }
    }

                    



