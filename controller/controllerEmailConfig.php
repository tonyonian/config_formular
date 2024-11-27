<?php
/**
 * @file        controllerEmailConfig.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class EmailConfigController
    {
        private $modelEmail;
        

        function __construct($modelEmail)
        {
            $this->modelEmail = $modelEmail;
        }
        function handleRequest()
        {
            

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $action = $_POST['action']?? '';
                $emailliste = [];
                $error ='';

                foreach($_POST as $key => $val)
                {
                    if($val === 'true')
                {
                    $val = true;
                }
                if($val === 'false')
                {
                    $val=false;
                }

                if(is_bool($val))
                {
                    $val = $val ? 1 : 0 ;
                }
                    $emailliste[$key] = $val;
                }

                if($action === 'weiter')
                {
                    
                    //Validierungen der SMTP server
                    if(empty($emailliste['smtpHost']) || empty($emailliste['smtpPort']) || empty($emailliste['smtpBenutzer']) || empty($emailliste['smtpPasswort']))
                    {
                       
                        $error = "Bitte alle SMTP-Server-Daten ausfüllen.";
                    }
                    //Validerung vom Format des SMTP-Server-Daten
                    else if(!filter_var($emailliste['smtpHost'], FILTER_VALIDATE_IP))
                    {
                        $error = "Bitte eine gültige SMTP-Server-Adresse eingeben.";
                    }
                    else if(!is_numeric($emailliste['smtpPort']) || $emailliste['smtpPort'] < 1 || $emailliste['smtpPort'] > 65535)
                    {
                        $error = "Bitte eine gültige SMTP-Server-Portnummer eingeben.";
                    }
                    else if(!filter_var($emailliste['smtpBenutzer'], FILTER_VALIDATE_EMAIL))  //Validerung der SMTP-Benutzerdaten
                    {
                        $error = "Bitte eine gültige SMTP-Benutzer-E-Mail-Adresse eingeben.";
                    }
                    else if(strlen($emailliste['smtpPasswort']) < 8)
                    {
                        $error = "Bitte ein Passwort mit mindestens 8 Zeichen eingeben.";
                    }
                    else if(!filter_var($emailliste['bccEmail'], FILTER_VALIDATE_EMAIL))  //Validierung der BCC E-Mail
                    {
                        $error = "Bitte eine gültige BCC-E-Mail-Adresse eingeben.";
                    }

                    $this->modelEmail->setEmailListe($emailliste);

                    if(!empty($error))
                    {
                        $this->modelEmail->updateView($error);
                        exit();
                    }
                    else
                    {
                        session_write_close();
                        header('Location: index.php?seite=emailVorlage&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                        exit();
                    }
                    
                }

                if($action === 'zurück')
                {
                    $this->modelEmail->setEmailListe($emailliste);
                    session_write_close();
                    header('Location: index.php?seite=mitarbeiterDaten&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                    exit();
                }
            }

            $this->modelEmail->updateView('');

            
        }

    }