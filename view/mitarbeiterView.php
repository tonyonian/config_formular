<?php
/**
 * @file        mitarbeiterView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MitarbeiterView
    {
        public function render($error='')
        {
?>
<Doctype html>
<html>

    <body>
    <img src="./images/LogoHeintze.png" />
    <img src="./images/LogoGlorixx.png" />

    >

    <form action="" method="post" enctype="multipart/form-data">
        Zurück zur Startseite
        <input type="submit" id="zurück" name="action" value="zurück" >
        Weiter zur nächsten Seite
        <input type="submit"  name="action" value="weiter" >
        <br>
        <h1>
            Neuer Mitarbeiter
            <?php 
                session_start();
                    echo htmlspecialchars(stripslashes(trim($_SESSION['mandantname'])));
                session_write_close(); 
            ?>
        </h1>
       
        <br>

        <?php if($error): ?>
            <p style="color: red;"> <?=htmlspecialchars(stripslashes(trim($error))) ?></p>
        <?php endif; ?>

        <?php 
            $config = array('Benutzername' => 'benutzername', 'Anrede' => 'anrede', 'Vorname' => 'vorname', 'Nachname' => 'nachname',
                            'Position' => 'position',  'E-Mail' => 'email', 'E-Mail BCC*' => 'bccEmail',
                            'Firma Telefon' => 'firmaTelefon', 'Firma Mobil' => 'firmaMobil', 'Firma Fax' => 'firmaFax', 'Passwort' => 'passwort', 'Passwort Wiederholen' => 'passwortOK');

    
            session_start();
            foreach ($config as $name => $val): 
        ?>
        <label for="<?= $val ?>"><?=$name ?>:</label>
        
        <input type="<?php
                            if($val == 'passwort' || $val == 'passwortOK') 
                            { 
                                echo 'password';
                                if(isset($_SESSION['mitarbeiterInfo'][$val]))
                                {
                                    $_SESSION['mitarbeiterInfo'][$val] = '';
                                }

                            }
                            else if($val == 'email' || $val == 'bccEmail') 
                            {
                                echo 'email';
                            }
                            else{echo $val;} 
                        ?>"
                    id="<?= $val ?>" name="<?= $val ?>"
                    <?php 
                        $datVal = isset($_SESSION['mitarbeiterInfo'][$val]) ? trim($_SESSION['mitarbeiterInfo'][$val]) : ''; 
                        $datVal = htmlspecialchars($datVal, ENT_QUOTES, 'UTF-8'); 
                    ?>
                    value="<?= $datVal ?>"
        />
        <br><br>
            
        <?php 
            endforeach; 
        ?>
       
        <label for="name">Aktiviert:</label>
        <select id="aktiviert" name="aktiviert">    
            <option value=""  <?= !isset($_SESSION['mitarbeiterInfo']['aktiviert']) ? 'selected' : '' ?>>Wählen Sie ein Element aus.</option>
            <option value="true" <?= isset($_SESSION['mitarbeiterInfo']['aktiviert']) && $_SESSION['mitarbeiterInfo']['aktiviert'] == 1 ? 'selected' : '' ?>>Ja</option>
            <option value="false" <?= isset($_SESSION['mitarbeiterInfo']['aktiviert']) && $_SESSION['mitarbeiterInfo']['aktiviert'] == 0 ? 'selected' : '' ?>>Nein</option>
        </select><br><br>

        <label for="name">Anmeldung erlaubt:</label>
        <select id="anmeldungOk" name="anmeldungOk">
            <option value=""  <?= !isset($_SESSION['mitarbeiterInfo']['anmeldungOk']) ? 'selected' : '' ?>>Wählen Sie ein Element aus.</option>
            <option value="true" <?= (isset($_SESSION['mitarbeiterInfo']['anmeldungOk']) && $_SESSION['mitarbeiterInfo']['anmeldungOk'] == 1) ? 'selected' : '' ?>>Ja</option>
            <option value="false" <?= (isset($_SESSION['mitarbeiterInfo']['anmeldungOk']) && $_SESSION['mitarbeiterInfo']['anmeldungOk'] == 0) ? 'selected' : '' ?>>Nein</option>
        </select><br><br>

        <label for="name">API Zugang:</label>
        <select id="apiZugang" name="apiZugang">
            <option value="" <?= !isset($_SESSION['mitarbeiterInfo']['apiZugang']) ? 'selected' : '' ?>>Wählen Sie ein Element aus.</option>
            <option value="true" <?= (isset($_SESSION['mitarbeiterInfo']['apiZugang']) && $_SESSION['mitarbeiterInfo']['apiZugang'] == 1) ? 'selected' : '' ?>>Ja</option>
            <option value="false" <?= (isset($_SESSION['mitarbeiterInfo']['apiZugang']) && $_SESSION['mitarbeiterInfo']['apiZugang'] == 0) ? 'selected' : '' ?>>Nein</option>
        </select><br><br>

        <label for="name">API Schlüssel:</label>
        <input type="password"  name="apiSchluessel" value=""  /><br>
        <?php
            session_write_close();
        ?>
    </body>
</html>
    
<?php
        }
    }
