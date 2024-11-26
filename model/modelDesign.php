<?php

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
            echo "Error: ".$e->getMessage();
            echo "design";
            die();
        }
       
      

    }

    function updateView($error,$designConfig)
    {
        $this->designView->render($error,$designConfig);
    }
}