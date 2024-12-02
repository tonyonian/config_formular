<?php
/**
 * @file        controllerMitarbeiterDaten.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MitarbeiterDatenController
    {
        private $mitarbeiterDatenmodel;

        function __construct($mitarbeiterDatenmodel)
        {
            $this->mitarbeiterDatenmodel = $mitarbeiterDatenmodel;
        }

        function handleRequest()
        {
            $error = '';
            $mitarbeiterDaten = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $action = $_POST['action'];

                
                
                foreach($_POST as $key => $val)
                {
                   
                    $val = trim($val) ?? '';
                    $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                    $mitarbeiterDaten[$key] = $val;
                }
                
                

                if($action === "weiter")
                {
                    session_start();
                        $x = $_SESSION['sessionName'];
                        $y = $_SESSION['sessionId'];
                    session_write_close();
                    $this->mitarbeiterDatenmodel->setMitarbeiterDaten($mitarbeiterDaten);
                    header('Location: index.php?seite=emailConfig&' . $x . '=' . $y);
                    exit();
                }

                if($action === "zurück")
                {
                    $this->mitarbeiterDatenmodel->setMitarbeiterDaten($mitarbeiterDaten);
                    session_start();
                        $x = $_SESSION['sessionName'];
                        $y = $_SESSION['sessionId'];
                    header('Location: index.php?seite=mitarbeiter&' . $x . '=' . $y);
                    exit();
                }

                if($action === "weiterer Mitarbaiter")
                {
                    $this->mitarbeiterDatenmodel->setMitarbeiterDaten($mitarbeiterDaten);
                    session_start();
                        $x = $_SESSION['sessionName'];
                        $y = $_SESSION['sessionId'];
                        $_SESSION['neuerArbeiter'] = true;
                        $_SESSION['mitarbeiterDaten'] = [];
                    header('Location: index.php?seite=mitarbeiter&' . $x . '=' . $y);
                    exit();
                }
                
                
            }
           
                $this->mitarbeiterDatenmodel->updateView();
            
            
        }
    }