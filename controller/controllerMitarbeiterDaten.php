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
                    $mitarbeiterDaten[$key] = $val ?? 'null';
                }
                
                

                if($action === "weiter")
                {
                    
                    session_write_close();
                    $this->mitarbeiterDatenmodel->setMitarbeiterDaten($mitarbeiterDaten);
                    header('Location: index.php?seite=emailConfig&' . $_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                    exit();
                }
                if($action === "zurück")
                {
                    session_write_close();   
                    $this->mitarbeiterDatenmodel->setMitarbeiterDaten($mitarbeiterDaten);
                    header('Location: index.php?seite=mitarbeiter&' . $_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                    exit();
                }
                
            }
           
                $this->mitarbeiterDatenmodel->updateView();
            
            
        }
    }