<?php

/**
 * @file        modelMitarbeiterDaten.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MitarbeiterDaten
    {
        private $pdo;
        
        private $view;
        private $mitarbeiterDaten;
        
        function __construct($pdo,$view=null)
        {
            $this->pdo = $pdo;
            $this->view = $view;
        }
    
        function setMitarbeiterDaten($mitarbeiterDaten)
        {
            session_start();
                $_SESSION['mitarbeiterDaten']=[];
                    
                foreach ($mitarbeiterDaten as $key => $val)
                {
                    $_SESSION['mitarbeiterDaten'][$key] = $val ?? '';
                }    
                unset($_SESSION['mitarbeiterDaten']['action']);
                $_SESSION['mitarbeiterDaten'] = array_merge(['mitarbeiter_mandant_name' => $_SESSION['mandantname'],
                'mitarbeiter_benutzername' => $_SESSION['benutzername']],$_SESSION['mitarbeiterDaten']);
            session_write_close();
            
        }

        


        function saveToDb()
        {
            try
            {
                $con = $this->pdo->connectionToDb();

                $sql = "INSERT INTO `mitarbeiterdaten` (`mitarbeiter_mandant_name`, `mitarbeiter_benutzername`, `strasse`, `hausnummer`, `plz`, `stadt`, `land`, `telefon`, `mobil`, `fax`, `email`, `iban`, `bic`, `bank`, `bemerkung`) 
                VALUES (:mitarbeiter_mandant_name,:mitarbeiter_benutzername,:strasse,:hausnummer,:plz,:stadt,:land,:telefon,:mobil,:fax,:email,:iban,:bic,:bank,:bemerkung)";

                $stmt = $con->prepare($sql);
                
                session_start();
                    $stmt->execute($_SESSION['mitarbeiterDaten']);
                session_write_close();
                

                $con = null;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                echo "MitarbeiterDaten";
                die();
            }
           
        }

        function updateView()
        {
            session_start();
            if(!empty($_SESSION['mitarbeiterDaten']))
            {
                $mitInfo = $_SESSION['mitarbeiterDaten'];
            }
            else
            {
                $mitInfo=[];
            }
            
            session_write_close();

        $this->view->render($mitInfo);
        }
    }