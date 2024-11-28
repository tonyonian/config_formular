<?php 
/**
 * @file        modelVorgangSort.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class VorgangSort
    {
        private $pdo,$view;
        function __construct( $pdo, $view = null)
        {
            $this->pdo = $pdo;
            $this->view = $view;
        }

        function setVorgangRang($vorgangSortRang)
        {
            session_start();
                foreach($vorgangSortRang as $key => $value)
                {
                    $_SESSION['vorgangrang'][$key]=$value;
                }
                unset($_SESSION['vorgangrang']['action']);
                $_SESSION['vorgangrang'] =array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['vorgangrang'] );
            session_write_close();
        }
        

        function saveToDb()
        { 
            try
            {
                $con = $this->pdo->connectionToDb();

                $sql = "INSERT INTO `vorgangssortierung` (`mandant_name`, `angebot`, `auftragsbestaetigung`, `serviceauftrag`,`lieferschein`, `teilLieferschein`,
                     `rechnung`, `proformaRechnung`, `individualBestellung`, `stornorechnungGutschrift`, `mahnung`, `bestellung`,
                    `eingangsrechnung`, `eingangslieferschein`, `produktionsauftrag`, `ruecknahme`, `verleihrueckname`, `webbestellung`, `packschein`, 
                     `fertigstellung`, `preisanfrage`, `brief`, `zahlungserinnerung`, `zweiteMahnung`) 
                        VALUES (:mandant_name,:angebot,:auftragsbestaetigung,:serviceauftrag,:lieferschein ,:teilLieferschein,:rechnung,:proformaRechnung,
                                :individualBestellung,:stornorechnungGutschrift,:mahnung,:bestellung,:eingangsrechnung,:eingangslieferschein,:produktionsauftrag,:ruecknahme,
                                :verleihrueckname,:webbestellung,:packschein,:fertigstellung,:preisanfrage,:brief,:zahlungserinnerung,:zweiteMahnung)
                        "; 
    
                $stmt = $con->prepare($sql);
    
                session_start();
                    $stmt->execute($_SESSION['vorgangrang']);
                session_write_close();
    
                $con = null;
            }
            catch (PDOException $e)
            {
                echo "Error: ".$e->getMessage();
                echo "Vorgang";
                die();
            }
          
        }

        function updateView()
        {
            session_start();
                $rang = $_SESSION['vorgangrang'] ?? [];
            session_write_close();
            $this->view->render($rang);
           
        }
    }