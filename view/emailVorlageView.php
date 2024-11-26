<?php
    class EmailVorlageView
    {
        function render()
        {
?>
<DOCTYPE html>
 <html>
    <body>
        <img src="./images/LogoHeintze.png" />
        <img src="./images/LogoGlorixx.png" />
        <h2>
            Email-Vorlagen
            <?php
                session_start();
                $_SESSION['mandantname']; 
                session_write_close();
            ?>
        </h2>

        <form action="" method="post">
            Zurück zur Startseite
            <input type="submit" id="zurück" name="action" value="zurück" >
            Weiter zur nächsten Seite
            <input type="submit"  name="action" value="weiter" >
            <br>
        </form>
            
        
        In der GLORiXX ERP ist es möglich für verschiedene Vorgänge E-Mail Vorlagen zu erstellen.<br>
        Beispiel anhand eines Angebotes:<br>
        *******************************Body****************************************<br>
        Sehr geehrte Damen und Herren,<br>
        vielen Dank für Ihre Anfrage.<br>
        Im Anhang übersenden wir Ihnen unser entsprechendes Angebot.<br>
        Wir werden uns über Ihren Auftrag freuen.<br>
        Für Rückfragen stehen wir Ihnen gerne zur Verfügung.<br>
        Mit freundlichen Grüßen<br>
        „Benutzer Vorname“ „Benutzer Name“<br>
        Ihr Unternehmen GmbH<br>
        Ihre Strasse 99<br>
        99999 IhrOrt<br>
        Tel.:  01111-9999999<br>
        Fax.: 01111-8888888<br>
        Mail.: info@IhrUnternehmen.de<br>
        „Disclaimer“ Beispiel<br>


        <p> info(at)IhrUnternehmen.de</p>

        <p>Bitte übersenden Sie uns Ihre E-Mail Vorlagen.<p>


        <!-- Natürlcih sollte keine Logik in der View-Datei stehen, besser Controller benutzten -->
        <?php 
            if($_SERVER["REQUEST_METHOD"] === "POST")
            {
                $action = $_POST['action'];

                if($action === 'weiter')
                {
                    session_write_close();
                    header('Location: ./index.php?seite=design&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                    exit();
                }
                if($action === 'zurück')
                {
                    session_write_close();
                    header('Location: ./index.php?seite=emailConfig&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                    exit();
                }
            }
        
                      
        }
    }