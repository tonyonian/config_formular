<?php

    class Json
    {
    
        private $pdo;

        function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        function saveToDb($json)
        {
            try
            {
                $con = $this->pdo->connectionToDb();
               
                    $name = $_SESSION['mandantname'];
                session_write_close();
    
                $sql ="INSERT INTO `mandantenliste` (`mandant_name`, `mandant_name_json`) VALUES (:mandantname, :jsondata)";
    
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':mandantname', $name, PDO::PARAM_STR);
                $stmt->bindParam(':jsondata', $json, PDO::PARAM_LOB);
    
                $stmt->execute();
    
                $con =null;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
                echo var_dump($json);
                echo "json";
                die();
            }
          

        }
    }