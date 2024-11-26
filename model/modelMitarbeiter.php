<?php 
    
    class Mitarbeiter
    {
       
       
        
        private $pdo;
        private $mitarbeiterView;

        private $name;
        
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
            session_write_close();

            
            if($error)
            {
                $this->updateView($error,$mitabeiterInfo);
            }
        }

        function saveToDb()
        {
            session_start();
                $saltedPasswort =$_SESSION['mitarbeiterInfo']['passwort'];
                $saltedApiKey = $_SESSION['mitarbeiterInfo']['apiSchluessel'];
                $saltedPasswort = password_hash($saltedPasswort, PASSWORD_DEFAULT);
                $saltedApiKey = password_hash($saltedApiKey, PASSWORD_DEFAULT);
                $_SESSION['mitarbeiterInfo']['passwort'] =$saltedPasswort;
                $_SESSION['mitarbeiterInfo']['apiSchluessel'] =$saltedApiKey;
            session_write_close();

            

                try
                {
                    $con = $this->pdo->connectionToDB();
                    
                    $sql = "INSERT INTO `mitarbeiter` (`mandant_name`, `benutzername`, `anrede`, `vorname`, `nachname`, `position`, `email`, 
                            `bccEmail`, `firmaTelefon`, `firmaMobil`, `firmaFax`, `passwort`, `aktiviert`, `anmeldungOk`, `apiZugang`, `apiSchluessel`)
                            VALUES (:mandant_name,:benutzername,  :anrede, :vorname, :nachname, :position, :email,
                             :bccEmail, :firmaTelefon, :firmaMobil, :firmaFax, :passwort, :aktiviert ,:anmeldungOk, :apiZugang, :apiSchluessel)";
                
                    $stmt = $con->prepare($sql);
                    session_start();
                        $stmt->execute($_SESSION['mitarbeiterInfo']);
                    session_write_close();
                    

                    $con = null;
                }
                catch (PDOException $e) 
                {
                    echo "Fehler: " . $e->getMessage();
                }
        }

        function updateView($error)
        {
            session_start();
                if(!empty($_SESSION['mitarbeiterInfo']))
                {
                    $mitInfo = $_SESSION['mitarbeiterInfo'];
                }
                else
                {
                    $mitInfo=[];
                }
                
            session_write_close();

            $this->mitarbeiterView->render($error,$mitInfo);
        }
    }