<?php 
/**
 * @file        modelEmailConfig.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class EmailConfig
    {
        private $pdo,$emailConfigView,$emailListe;

        function __construct( $pdo,$emailConfigView=null )
        {
            $this->pdo = $pdo;
            $this->emailConfigView = $emailConfigView;
        }

     
      

        function setEmailListe($emailListe)
        {
            session_start();
                foreach($emailListe as $key => $value)
                {
                    $_SESSION['emailListe'][$key] = $value;
                }
                unset($_SESSION['emailListe']['action']);
                $_SESSION['emailListe'] = array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['emailListe']);
            session_write_close();
               
        }
        
        function saveToDb()
        {
            try
            {
                $con = $this->pdo->connectionToDb();

                $sql = "INSERT INTO `emailconfiguration` (`mandant_name`, `smtpHost`, `smtpPort`, `smtpBenutzer`, `smtpPasswort`, `smtpVerschluesselung`, `bccEmail`) 
                        VALUES (:mandant_name, :smtpHost, :smtpPort, :smtpBenutzer, :smtpPasswort, :smtpVerschluesselung,:bccEmail)"; 
    
                $stmt = $con->prepare($sql);
                
                session_start();
                    $stmt->execute($_SESSION['emailListe']);
                session_write_close();
                
    
                $con = null;  // Verbindung löschen
            }
            catch (PDOException $e)
            { 
                echo $e->getMessage();
                echo "Email";
                die();
            }
          
        }

        function updateView($error)
        {
            session_start();
                if(!empty($_SESSION['emailListe']))
                {
                    $elist = $_SESSION['emailListe'];
                }
                else
                {
                    $elist = [];
                }
            session_write_close();
            $this->emailConfigView->render($error,$elist);
        }
    }