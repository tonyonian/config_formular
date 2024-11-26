<?php
/**
 * @file        modelZahlung.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    class ZahlungModel
    {
      

        private $pdo,$zahlungView;

        function __construct($pdo,$zahlungView)
        {
            $this->pdo = $pdo;
            $this->zahlungView = $zahlungView;
        }

        
        

        function setZahlungenListe($zahlungenliste)
        {
            session_start();
                $_SESSION['zahlungenListe']=[];

                foreach ($zahlungenliste as $key => $val)
                {
                    $_SESSION['zahlungenListe'][$key] = $val;
                }    
                unset($_SESSION['zahlungenListe']['action']);
                $_SESSION['zahlungenListe'] = array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['zahlungenListe']);
            session_write_close();
        }

        
        function saveToDb()
        {

            try
            {
                $con = $this->pdo->connectionToDb();

                $sql = "INSERT INTO `zahlungen` (`mandant_name`, `euro`, `dollar`, `yen`, `britischerPfund`, `australischeDollar`,
                 `kanadischeDollar`, `schweizerFranken`, `chinesischeRenminbi`, `schwedischeKrone`, `neuseelaendischerDollar`) 
                        VALUES (:mandant_name,:euro,:dollar,:yen,:britischerPfund,:australischeDollar,:kanadischeDollar,:schweizerFranken,:chinesischeRenminbi,:schwedischeKrone,:neuseelaendischerDollar)";
                
                $stmt = $con->prepare($sql);

                session_start();
                echo var_dump($_SESSION['zahlungenListe']);
                    $stmt->execute($_SESSION['zahlungenListe']);
                session_write_close();
                
                
    
                $con = null;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                echo "zahlungen";
                die();
            }  
        }
        
        function updateView()
        {
            $this->zahlungView->render();
        }

    }