<?php
/**
 * @file        designView.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class DesignView
    {
        function render($error='',$designConfig=[])
        {
?>
<Doctype html>
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
                Design
                <?php
                    session_start();
                    echo $_SESSION['mandantname']; 
                    session_write_close();
                ?>
            </h2>
            <h3>Menüfarbe:</h3>

            <p>Die Menüfarbe der GLORiXX ERP kann individuell angepasst werden.</p>

            <?php if($error): ?>
                <p style="color: red;"> <?=htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php

                $config = array('Hinergrundfarbe' => 'hintergrundfarbe', 'Schriftfarbe' => 'schriftfarbe', 'Icon Farbe' => 'iconfarbe',
                                'Pfeilfarbe' => 'pfeilfarbe', 'Hover Farbe' => 'hoverfarbe','Header Farbe' =>'headerfarbe', 'Header Button Farbe' => 'headerbuttonfarbe',
                                'Login Hintergrundfarbe' => 'loginhintergrundfarbe', 'Login Fensterfarbe' => 'loginfensterfarbe',
                                'Login Schriftfarbe' => 'loginschriftfarbe');
            ?>

            <?php foreach ($config as $key => $val): ?>
                <label for="<?=$val ?>"><?=$key ?>: </label>
                <input type="color" id="<?=$val ?>" name="<?=$val ?>" value="<?= isset($designConfig[$val]) ? htmlspecialchars(trim($designConfig[$val])) : '' ?>">
                <br>
            <?php endforeach; ?>

        </form>

        <p><br>Die Farben können mittels rgb Farbcode (z.B. 255,255,255 weiß) erstellt werden. </p>



<?php            
        }
    }