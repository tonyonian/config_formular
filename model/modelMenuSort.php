<?php 
/**
 * @file        modelMenuSort.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class MenuSort
    {
        private $pdo;

        private $menuSortRang =[] ;
        private $view;

        function __construct( $pdo,$view =null)
        {
            $this->pdo = $pdo;
            $this->view = $view;
        }

        function setMenuRang($menuSortRang)
        {
            session_start();
                foreach($menuSortRang as $key => $value)
                {
                    $_SESSION['menurang'][$key]=$value;
                }
                unset($_SESSION['menurang']['action']);
                $_SESSION['menurang'] =array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['menurang']);
            session_write_close();
        }

        function saveToDb()
        { 
            try
            {
                $con = $this->pdo->connectionToDb();

            $sql = "INSERT INTO `menuesortierung` (`mandant_name`, `artikel`, `Kalender`, `kunde`, `projekt`, `lieferant`,
                     `ticket`, `vorgang`, `vertrag`, `offenePosten`, `dienstleistungen`, `lager`, `produktion`, `auswertung`,
                            `webshop`, `verleihartikel`, `geraet`, `schnittstelle`)
                    VALUES (:mandant_name,:artikel,:kalender,:kunde,:projekt,:lieferant,:ticket,:vorgang,:vertrag,:offenePosten,:dienstleistungen,
                            :lager,:produktion,:auswertung,:webshop,:verleihartikel,:geraet,:schnittstelle)"; 

            $stmt = $con->prepare($sql);
            session_start();
                $stmt->execute($_SESSION['menurang']);
            session_write_close();
            
         
            $con = null;
            }
            catch (PDOException $e)
            {
                echo "".$e->getMessage();
                echo "menusoert";
                die();
            }
            
        }

        function updateView($menuSortRang)
        {
            $this->view->render($menuSortRang);
        }
    }