<?php 
    /**
 * @file        modelMitarbeiter.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class Mitarbeiter
    {
       
       
        
        private $pdo;
        private $mitarbeiterView;

        function __construct($pdo,$mitarbeiterView=null)
        {
            $this->pdo = $pdo;
            $this->mitarbeiterView = $mitarbeiterView;
        }


        function setMitarbeiterInfo($error,$mitabeiterInfo)
        {

            session_start();
                $_SESSION['mitarbeiterInfo']=[];
                foreach ($mitabeiterInfo as $key => $val)
                {
                    $_SESSION['mitarbeiterInfo'][$key] = $val ?? '';
                } 
                unset($_SESSION['mitarbeiterInfo']['passwortOK']);
                unset($_SESSION['mitarbeiterInfo']['action']);
                $_SESSION['mitarbeiterInfo'] = array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['mitarbeiterInfo'] );
                $_SESSION['benutzername'] = $_SESSION['mitarbeiterInfo']['benutzername'];
                
                if(!empty($_SESSION['neuerArbeiter']))
                {
                    if(!isset($_SESSION['mitarbeiterListe']))
                    {
                        $_SESSION['mitarbeiterListe'] = [];
                    }
                    
                    $_SESSION['anzahlMitarbeiter'] = count($_SESSION['mitarbeiterListe']);
                    $_SESSION['neuerArbeiter'] = false;
                }
                else if(!empty($error))
                {
                    $_SESSION['anzahlMitarbeiter'] = (isset($_SESSION['mitarbeiterListe']) && isset($_SESSION['mitarbeiterListe'])) ? count($_SESSION['mitarbeiterListe'])-1 : 0;
                   
                }

                $_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']] = $_SESSION['mitarbeiterInfo']; 

                $saltedPasswort =$_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]['passwort'];
                $saltedApiKey = $_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]['apiSchluessel'];
                $saltedPasswort = password_hash($saltedPasswort, PASSWORD_DEFAULT);
                $saltedApiKey = password_hash($saltedApiKey, PASSWORD_DEFAULT);
                $_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]['passwort'] =$saltedPasswort;
                $_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]['apiSchluessel'] =$saltedApiKey;
            
            session_write_close();

            
            if($error)
            {
                $this->updateView($error);
            }
        }

        function saveToDb()
        {

            try
            {
                $con = $this->pdo->connectionToDB();
                
                $sql = "INSERT INTO `mitarbeiter` (`mandant_name`, `benutzername`, `anrede`, `vorname`, `nachname`, `position`, `email`, 
                        `bccEmail`, `firmaTelefon`, `firmaMobil`, `firmaFax`, `passwort`, `aktiviert`, `anmeldungOk`, `apiZugang`, `apiSchluessel`)
                        VALUES (:mandant_name,:benutzername,  :anrede, :vorname, :nachname, :position, :email,
                            :bccEmail, :firmaTelefon, :firmaMobil, :firmaFax, :passwort, :aktiviert ,:anmeldungOk, :apiZugang, :apiSchluessel)";
            
                $stmt = $con->prepare($sql);
                session_start();
                    $stmt->execute($_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]);
                session_write_close();
                

                $con = null;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                echo var_dump($_SESSION['mitarbeiterListe'][$_SESSION['anzahlMitarbeiter']]);
                echo "mitarbeiter";
            die();;
            }
        }

        function updateView($error)
        {
            session_start();
                if(!empty($_SESSION['neuerArbeiter']))
                    $_SESSION['mitarbeiterInfo'] = [];
            session_write_close();
            $this->mitarbeiterView->render($error);
        }
    }