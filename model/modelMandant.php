<?php 
/**
 * @file        modelMandant.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class Mandant
    {
        private $pdo;
        private $view;

        

        function __construct($pdo,$view=null)
        {
            $this->pdo = $pdo;
            $this->view = $view;
        }

        
        function setMandantInfo($name,$logopfad='')
        {
            session_start();
                $_SESSION['mandantname'] = $name;
                $_SESSION['mandantlogo'] = $logopfad;
            session_write_close();
        
        }

       

        function uploadLogo($name, $logopfad)
        {
            session_start();
                $_SESSION['mandantname'] = $name;
                $_SESSION['mandantlogo'] = $logopfad;
            session_write_close();
            $load = true;
            $error = '';
            $this->updateView($error,$name,$load);
        }


        function saveToDb()
        {
            try
            {
                $con = $this->pdo->connectionToDb();

                session_start();
                    $content = file_get_contents($_SESSION['mandantlogo']);
                    $name = $_SESSION['mandantname'];
                session_write_close();

                $sql = "INSERT INTO mandant (name, logo) VALUES (:name, :logo)"; 
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':logo', $content, PDO::PARAM_LOB);

                $stmt->execute();
    
                $con =null;
                
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                echo "mandant";
                die();
            }
          
        }

        function updateView($error,$issetLogo=false)
        {
            session_start();
                $logopfad = $_SESSION['mandantlogo'] ?? '';
            session_write_close();
            $this->view->render($error,$logopfad,$issetLogo);
        }


    }
