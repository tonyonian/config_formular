<?php

    class MitarbeiterDatenView
    {
        public function render($mitarbeiterDaten=[])
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
            <h1><?php echo $_SESSION['mitarbeiterInfo']['benutzername']; ?> Persönliche Daten (freiwillige Angabe)</h1>
            <br>

        
            
            <?php
                $config =array('Straße'=>'strasse', 'Hausnummer' => 'hausnummer', 'Postleitzahl' => 'plz', 'Stadt' => 'stadt', 
                                'Land' => 'land', 'Telefon' => 'telefon', 'Mobil' => 'mobil', 'Fax' => 'fax', 'Email' => 'email', 'IBAN' => 'iban', 'BIC' => 'bic',
                                'Bank' => 'bank');
                
            ?>
            <?php foreach ($config as $name => $value): ?>
                <label for="<?= $value ?>"><?=$name ?>:</label>
                <input type="<?php
                                    if($value == 'email')
                                    {
                                        echo 'email';
                                    }
                                    else{echo $value;} 
                                ?>"
                            id="<?= $value ?>" name="<?= $value ?>"  
                            value="<?= isset($mitarbeiterdDaten[$value]) ? htmlspecialchars(trim($mitarbeiterdDaten[$value])) : '' ?>"
                /><br><br>
                
            <?php endforeach;?>
            <label for="bemerkung">Bemerkung:</label>
            <textarea name="bemerkung" cols="40" rows="5"></textarea><br>
        </form>
    </body>
</html>
<?php
        }
    }

                    



