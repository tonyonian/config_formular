<?php
/**
 * @file        controllerMitarbeiter.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
class MitarbeiterController
{
    private $mitarbeiterModel;

    function __construct($mitarbeiterModel)
    {
        $this->mitarbeiterModel = $mitarbeiterModel;
    }

    function handleRequest()
    {
        $error = '';
        $mitarbeiterInfo = [];
       

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $action = $_POST['action'];

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
                
                $val = trim($val) ?? '';
                $val =  htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                $mitarbeiterInfo[$key] = $val;
               
            }


            if($action === "weiter")
            {
                
                
                foreach($mitarbeiterInfo as $key => $val)
                {
                    
                    if($val==='' || $val===NULL )
                    {    
                        if(($key === 'apiSchluessel' && $mitarbeiterInfo['apiZugang'] == 1))
                        {
                            $error = "Bitte alle Felder ausfüllen.";
                            break;
                        }
                        
                    }
                    else if($key === 'email' || $key === 'eMailBCC')
                    {
                        if(!filter_var($val, FILTER_VALIDATE_EMAIL))
                        {
                            $error = "Bitte eine gültige ".$key."-Adresse eingeben.";
                            break;
                        }
                    }
                   if(!empty($mitarbeiterInfo['passwort']) && (($mitarbeiterInfo['passwort'] !== $mitarbeiterInfo['passwortOK'])))
                   {
                        $error = "Passwörter stimmen nicht überein.";
                        break;
                   }
                   
                   if($key === 'firmatel' || $key === 'firmamobil' || $key === 'firmafax')
                   {
                      
                      if (ctype_digit($val)) 
                      { 
                        $val = intval($val);
                      }

                      if(!(is_int($val)))
                      {
                        $error = "Telefonnummer müssen nur aus Nummern bestehen, bitte keine Trennzeichen benutzen.";
                        break;
                      }
                      else
                      {
                        $mitarbeiterInfo[$key] = $val;
                      }
                   }
                }
                if(empty($error))
                {
                    $this->mitarbeiterModel->setMitarbeiterInfo('',$mitarbeiterInfo);

                    session_start();
                        $x = $_SESSION['sessionName'];
                        $y = $_SESSION['sessionId'];
                    session_write_close();
                    
                    header('Location: index.php?seite=mitarbeiterDaten&' . $x . '=' . $y);
                    exit();
                }
                else
                {
                    $this->mitarbeiterModel->setMitarbeiterInfo($error,$mitarbeiterInfo);
                    exit();
                }
              
            }

            if($action === "zurück")
            {
                session_start();
                    $x = $_SESSION['sessionName'];
                    $y = $_SESSION['sessionId'];
                session_write_close();

                $this->mitarbeiterModel->setMitarbeiterInfo('',$mitarbeiterInfo);
                
                header('Location: index.php?seite=mandant&' .$x . '=' . $y);
                exit;
            }

        }
        
        $this->mitarbeiterModel->updateView('','');
    }
    
    
}