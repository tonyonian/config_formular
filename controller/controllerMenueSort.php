<?php
/**
 * @file        controllerMenueSort.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
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