<?php
/**
 * @file        mandantView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MandantView
    {
        public function render($error='',$zieldatei='',$issetLogo=false)
        {
            if(isset($_SESSION['mandantlogo']))
            {
                $issetLogo = true;
            }
?>

<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />

       

        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="issetLogo" id="issetLogo" value="<?= $issetLogo ?>" >
            <input type="hidden" name="image" id="image" value="<?= $zieldatei ?>" >

            <!-- Navigation -->
            <p>
                Zurück zur Startseite
                <input type="submit" id="zurück" name="action" value="zurück" >
                Weiter zur nächsten Seite
                <input type="submit" id="weiter" name="action" value="weiter" >
            </p>
            
            <h2>Neuer Mandant</h2>

            <!-- Fehlerbehandlung -->
            <?php 
                $error = trim( $error );
                $error = htmlspecialchars($error,ENT_QUOTES, 'UTF-8' );
            if($error): ?>
                <p style="color: red;"> <?= $error ?></p>
            <?php endif; ?> 

            <!-- Mandanten Name eingeben -->
            <label for="name">Mandanten Name:</label>
            <?php 
                session_start();
                    $name = trim($_SESSION['mandantname']);
                    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
                session_write_close();
            ?>

            <input type="text"  name="name" value="<?=isset($name) ? $name : '' ?>" ><br>
                
            <!-- Logo hochladen -->
            <label for="logo">Datei (PNG/JPG, max. 600x800):</label>
            <input type=file id="hochladen"  name="logo" accept=".png, .jpg "/>

            <input type="submit" id="hochladen" name="action" value="hochladen" >
            
            <!-- Logo anzeigen, falls vorhanden -->
            <?php if ($zieldatei): ?>
                <p>Dein Logo</p>
                <?php 
                    $ziedatei = trim($zieldatei);
                    $zieldatei = htmlspecialchars($zieldatei, ENT_QUOTES, 'UTF-8');
                ?>
                <img src="<?= $zieldatei ?>" alt="Logo" style="max-width: 600px; max-height: 800px;" />
            <?php endif; ?>   
            <br>
        </form>

    </body>
</html>
<?php
        }
    }
   

