<?php

/**
 * @file        connection.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class Connection
    {
        private $servername = "127.0.0.1:3306";
        private $db = "glorixx";
        private $username = "root";
        private $pw = "";
        private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // PDO::ATTR_DEFAULT_FETCH_MODE nicht nötigt, da nur gespeichert werden.
        private $pdo;
        private $dsn;
        
       function connectionToDb() 
       {
            $this->dsn = "mysql:host=$this->servername;dbname=$this->db";
            

            try 
            {
                $this->pdo = new PDO($this->dsn, $this->username, $this->pw,$this->options);
            } 
            catch (PDOException $e) 
            {
                echo $e->getMessage();
            }

            return $this->pdo;
       }
           
        
    }
    
        
    
   

