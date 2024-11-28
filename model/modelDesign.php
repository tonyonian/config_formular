<?php
/**
 * @file        modelDesign.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
class DesignModel
{
    private $pdo,  $designConfig, $designView;

    function __construct($pdo, $designView=null)
    {
        $this->pdo = $pdo;
        $this->designView = $designView;
    }

    function setDesignConfig($designConfig)
    {
        $this->designConfig = $designConfig;
        session_start();
            foreach ($designConfig as $key => $value) 
            {
                $_SESSION['design_config'][$key] = $value;
            }
            unset($_SESSION['design_config']['action']);
            $_SESSION['design_config'] = array_merge(['mandant_name' => $_SESSION['mandantname']],$_SESSION['design_config'] );
        session_write_close();
    }

    function saveToDb()
    {
        try
        {
            $con = $this->pdo->connectionToDb();

            $sql = "INSERT INTO `menuefarben` (`mandant_name`, `hintergrundfarbe`, `schriftfarbe`, `iconfarbe`, `pfeilfarbe`, `hoverfarbe`,
            `headerfarbe`, `headerbuttonfarbe`, `loginhintergrundfarbe`, `loginfensterfarbe`, `loginschriftfarbe`)
            VALUES (:mandant_name, :hintergrundfarbe, :schriftfarbe, :iconfarbe, :pfeilfarbe,:hoverfarbe ,:headerfarbe , :headerbuttonfarbe,
                     :loginhintergrundfarbe, :loginfensterfarbe, :loginschriftfarbe);";
    
            $stmt = $con->prepare($sql);
            session_start();
                $stmt->execute($_SESSION['design_config']);
            session_write_close();
            
    
            $con = null;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            echo var_dump($_SESSION['design_config']);
            echo "design_config";
            die();
        }
       
      

    }

    function updateView($error,)
    {
        session_start();
            $designConfig = $_SESSION['design_config'] ?? '';
        session_write_close();
        $this->designView->render($error,$designConfig);
    }
}