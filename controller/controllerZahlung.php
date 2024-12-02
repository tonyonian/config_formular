<?php
/**
 * @file        controllerZahlung.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
class ZahlungController
{
    private $modelListe;

    function __construct($modelListe)
    {
        $this->modelListe = $modelListe;
    }

    function handleRequest()
    {
        $zahlungListe =[];

       

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $action = $_POST['action'];

            foreach ($_POST as $key => $value)
            {
                if($value == 1)
                {
                    $value = 1;
                }
                if($value == 2)
                {
                    $value = 0;
                }
                
                $value = trim($value) ?? '';
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $zahlungListe[$key] = $value;
            }

            if ($action === 'absenden')
            {
                $this->modelListe[7]->setZahlungenListe($zahlungListe);

               
                for($i = 0; $i<8; $i++)
                {
                    if($i == 1 || $i == 2) 
                    {
                        session_start();
                            $len =$_SESSION['anzahlMitarbeiter'];
                        session_write_close();
                        
                            for($j = 0; $j < $len+1; $j++)
                            {
                                $this->modelListe[$i]->saveToDb($j);
                            }
                    }
                    else
                    {
                        $this->modelListe[$i]->saveToDb();
                    }
                    
                }

                session_start();
                    $_SESSION['mandanten_liste']=  
                    [
                        'name' => $_SESSION['mandantname'],
                        'logo'=>$_SESSION['image'],
                        'mitarbeiterListe' => $_SESSION['mitarbeiterListe'],
                        'mitarbeiterPrivateDaten' => $_SESSION['mitarbeiterDatenListe'],
                        'email_configuration' => $_SESSION['emailListe'],
                        'menue_sortierung' => $_SESSION['menurang'],
                        'vorgangs_sortierung' => $_SESSION['vorgangrang'],
                        'menue_design' => $_SESSION['design_config'],
                        'waehrungen_zahlungen'=> $_SESSION['zahlungenListe']
                    ];
                                                

                    $_SESSION['jsondata'] = json_encode($_SESSION['mandanten_liste']); //abspeichern in die DB nicht vergessen !!!
                    $this->modelListe[8]->saveToDb($_SESSION['jsondata']);
                    $_SESSION = array();
                
                session_destroy();
                
                
                header('Location: index.php?seite=ende');
                exit();
            }
            
    
            if ($action === 'zurück')
            {
                $this->modelListe[7]->setZahlungenListe($zahlungListe);
                session_start();
                    $x = $_SESSION['sessionName'];
                    $y = $_SESSION['sessionId'];
                session_write_close();
                header('Location: index.php?seite=vorgang&'.$x . '=' . $y);
                exit();
            }
    
            
        }

        $this->modelListe[7]->updateView();
    }
}
        
      
    

    
