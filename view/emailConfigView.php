<?php
/**
 * @file        emailConfigView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class EmailConfigView
    {
        public function render($error='',$emailliste=[])
        {
?>
<DOCTYPE html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />

       

        <form action="" method="post">
            Zurück zur Startseite
            <input type="submit" id="zurück" name="action" value="zurück" >
        
            Weiter zur nächsten Seite
            <input type="submit" id="weiter" name="action" value="weiter" >
            <br>
            <h2>
                E-Mail
                <?php
                    session_start();
                    echo $_SESSION['mandantname']; 
                    session_write_close();
                ?>
            </h2>
            
            <h3>E-Mail Einstellungen:</h3>

            <?php if($error): ?>
                <p style="color: red;"> <?=htmlspecialchars($error) ?></p>
            <?php endif;?>

            <?php
                $config = array('SMTP Host' => 'smtpHost', 'SMTP Port' => 'smtpPort', 'SMTP Benutzer' => 'smtpBenutzer','SMTP Passwort' => 'smtpPasswort');
            ?>
            <?php foreach ($config as $name => $value): ?>
                <label for="<?= $value ?>"><?=$name ?>:</label>
                <input type="<?php
                                    if($value == 'smtpPasswort') 
                                    { 
                                        echo 'password';
                                    }
                                    else if($value == 'smtpBenutzer' || $value == 'bccEmail')
                                    {
                                        echo 'email';
                                    }
                                    else{echo $value;} 
                                ?>"
                            id="<?= $value ?>" name="<?= $value ?>"  
                            value="<?= (isset($emailliste[$value]) && $value !== 'smtpPasswort') ? htmlspecialchars(trim($emailliste[$value])) : '' ?>"
                /><br><br>
                
            <?php endforeach;?>

        <label for="smtpVerschluesselung">SMTP Verschlüsselung:</label>
        <select id="smtpVerschluesselung" name="smtpVerschluesselung">
            <option value=""  <?= !isset($emailliste['smtpVerschluesselung']) ? 'selected' : '' ?>>Wählen Sie ein Element aus.</option>
            <option value="true" <?= isset($emailliste['smtpVerschluesselung']) && $emailliste['smtpVerschluesselung'] === 1 ? 'selected' : '' ?>>Ja</option>
            <option value="false" <?= isset($emailliste['smtpVerschluesselung']) && $emailliste['smtpVerschluesselung'] === 0 ? 'selected' : '' ?>>Nein</option>
        </select><br><br>

        <label for="bccEmail">BCC E-Mail*:</label>
        <input type="email" id="bccEmail" name="bccEmail" value="<?= isset($emailliste['bccEmail']) ? htmlspecialchars(trim($emailliste['bccEmail'])) : '' ?>">

        </form>
    </body>
</html>
<?php
        }
    }