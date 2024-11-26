<?php

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

        foreach ($_POST as $key => $value)
        {
            if($value === 'on')
            {
                $value = 1;
            }
            $zahlungListe[$key] = $value;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $action = $_POST['action'];

            if ($action === 'absenden')
            {
                $this->modelListe[7]->setZahlungenListe($zahlungListe);

                foreach($this->modelListe as $model)
                {
                    $model->saveToDb();
                }

                session_start();
                // überarbeiten!!!
                $_SESSION['mandanten_liste']=[
                                                $_SESSION['mandant'] => [
                                                                            'name' => $_SESSION['mandantname'],
                                                                            'logo'=>$_SESSION['image'],
                                                                            'mitarbeiter' => [
                                                                                                'mitarbeiter_informationen' => $_SESSION['mitarbeiterInfo'],
                                                                                                'persoenliche_informationen'=> $_SESSION['mitarbeiterDaten']
                                                                                             ],
                                                                            'email_configuration' => $_SESSION['emailListe'],
                                                                            'menue_sortierung' => $_SESSION['menurang'],
                                                                            'vorgangs_sortierung' => $_SESSION['vorgangrang'],
                                                                            'menue_design' => $_SESSION['design_config'],
                                                                            'waehrungen_zahlungen'=> $_SESSION['zahlungenListe']
                                                                        ]
                                            ];

                $_SESSION['json'] = json_encode($_SESSION['mandanten_liste']); //abspeichern in die DB nicht vergessen !!!
                session_write_close();
                header('Location: index.php?seite=letzte&'.$_SESSION['sessionName'].'='.$_SESSION['sessionId']);
                exit();
            }
            
    
            if ($action === 'zurueck')
            {
    
            }
    
            
        }

        $this->modelListe[7]->updateView();
    }
}
        
      
    

    
