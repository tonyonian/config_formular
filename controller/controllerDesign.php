<?php
/**
 * @file        controller.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
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
                $val = trim($val) ?? '';
                $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                $designConfig[$key] = $val;
            } 

            $action = $_POST['action'];

            if($action === 'weiter')
            {
                    $this->model->setDesignConfig($designConfig);
                    session_start();
                        $x = $_SESSION['sessionName'];
                        $y = $_SESSION['sessionId'];
                    session_write_close();
                    header('Location: index.php?seite=menueSort&'.$x.'='.$y);
                    exit();
            }

            if($action === 'zurück')
            {
                $this->model->setDesignConfig($designConfig);
                session_start();
                    $x = $_SESSION['sessionName'];
                    $y = $_SESSION['sessionId'];
                session_write_close();
                header('Location: index.php?seite=emailVorlage&'.$x . '=' . $y);
                exit();
            }

            
        }
        $this->model->updateView($error);
    }
}