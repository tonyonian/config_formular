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
            Zurück zur Startseite
            <input type="submit" id="zurück" name="action" value="zurück" >
            Weiter zur nächsten Seite
            <input type="submit"  name="action" value="weiter" >
            <br>
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
                            value="<?= isset($_SESSION['mitarbeiterDaten'][$value]) ? htmlspecialchars(stripslashes(trim($_SESSION['mitarbeiterDaten'][$value]))) : '' ?>"/>
                <br><br>
                
            <?php endforeach;?>
            <label for="bemerkung">Bemerkung:</label>
            <textarea name="bemerkung" cols="40" rows="5" ><?= isset($_SESSION['mitarbeiterDaten']['bemerkung']) ? htmlspecialchars(stripslashes(trim($_SESSION['mitarbeiterDaten']['bemerkung']))) : '' ?></textarea><br>
            <?php session_write_close(); ?>
        </form>
    </body>
</html>
<?php
        }
    }

                    



