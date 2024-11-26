<?php

class VorgangSortController
{
    private $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    function handleRequest()
    {
        $menuSortRang = [];
        $error = '';

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            foreach($_POST as $key => $value)
            {
                $vorgangSortRang[$key] = $value;
            }

            $action = $_POST['action'] ?? '';

            if($action === 'weiter')
            {
                $this->model->setVorgangRang($vorgangSortRang);
                session_write_close();
                header('Location: index.php?seite=zahlung&'.$_SESSION['sessionName'].'='.$_SESSION['sessionId']);
                exit();
            }

            if($action === 'zurueck')
            {
                session_write_close();
                header('Location: index.php?seite=menueSort&'.$_SESSION['sessionName'].'='.$_SESSION['sessionId']);
            }
            

        }

        $this->model->updateView();
    }
    
    
}