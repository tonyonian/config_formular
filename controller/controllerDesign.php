<?php

class DesignController
{
    private $model;
   

    function __construct($model)
    {
        $this->model = $model;
    }
    function handleRequest()
    {
        $error = '';
        $designConfig=[];
       

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            foreach($_POST as $key => $val)
            {
                $designConfig[$key]=$val;
            } 

            $action = $_POST['action'];

            if($action === 'weiter')
            {
                    $this->model->setDesignConfig($designConfig);
                    header('Location: index.php?seite=menueSort&'.$_SESSION['sessionName'].'='.$_SESSION['sessionId']);
                    exit();
            }

            if($action === 'zurueck')
            {
                session_write_close();
                header('Location: index.php?seite=emailVorlage&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                exit();
            }

            
        }
        $this->model->updateView($error,$designConfig);
    }
}