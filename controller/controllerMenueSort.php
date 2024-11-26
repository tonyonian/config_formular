<?php

class MenuSortController
{
    private $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    function handleRequest()
    {
        $menuSortRang = [];
        

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            foreach($_POST as $key => $value)
            {
                $menuSortRang[$key] = $value;
            }

            $action = $_POST['action'] ?? '';

            if($action === 'weiter')
            {

                $this->model->setMenuRang($menuSortRang);
                session_write_close();
                header('Location: index.php?seite=vorgang&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                exit();
            }

            if($action === 'zurueck')
            {
                session_write_close();
                header('Location: index.php?seite=design&'.$_SESSION['sessionName'] . '=' . $_SESSION['sessionId']);
                exit();
            }
            

        }

        $this->model->updateView($menuSortRang);
    }
    
    
}