<?php
    class MandantView
    {
        public function render($error='',$name ='',$zieldatei='',$issetLogo=false)
        {
?>

<Doctype html>
<html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />

       

        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="issetLogo" id="issetLogo" value="<?= $issetLogo ?>" >
            <input type="hidden" name="image" id="image" value="<?= $zieldatei ?>" >

            Zurück zur Startseite
            <input type="submit" id="zurück" name="action" value="zurück" >
            Weiter zur nächsten Seite
            <input type="submit" id="weiter" name="action" value="weiter" >
            <br>
            <h2>Neuer Mandant</h2>

            <?php if($error): ?>
                <p style="color: red;"> <?=htmlspecialchars($error) ?></p>
            <?php endif; ?> 
            <!-- Mandanten Name eingeben -->
            <label for="name">Mandanten Name:</label>
            <input type="text"  name="name" value="<?= htmlspecialchars(stripslashes(trim($name))) ?>" ><br>
                
                
            <!-- Logo hochladen -->
            <label for="logo">Datei (PNG/JPG, max. 600x800):</label>
            <input type=file id="hochladen"  name="logo" accept=".png, .jpg "/>

            <input type="submit" id="hochladen" name="action" value="hochladen" >
            
            
            <?php if ($zieldatei): ?>
                <p>Dein Logo</p>
                <img src="<?= htmlspecialchars(stripslashes(trim($zieldatei))) ?>" alt="Logo" style="max-width: 600px; max-height: 800px;" />
            <?php endif; ?>   
            <br>
        </form>

    </body>
</html>
<?php
        }
    }
   

