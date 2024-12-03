<?php

class StartController
{

    private $start;

    function __construct($start)
    {
        $this->start = $start;
    }

    function handleRequest()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['start']))
        {
            session_start();
                $x = $_SESSION['sessionName'];
                $y = $_SESSION['sessionId'];
            session_write_close();

            header('Location: index.php?seite=mitarbeiter&' . $x . '=' . $y);
            exit;
        }
    }

}