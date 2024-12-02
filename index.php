<?php 
    /**
 * @file        index.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */
    if (session_status() == PHP_SESSION_NONE) 
    {   
        session_save_path('./temp/session');    
        session_start();
            $_SESSION['sessionName'] = session_name(); 
            $_SESSION['sessionId'] = session_id();
        session_write_close();
    }
    
    require './connection.php';
    require './model/modelMandant.php';
    require './model/modelMitarbeiter.php';
    require './model/modelMitarbeiterDaten.php';
    require './model/modelEmailConfig.php';
    require './model/modelMenuSort.php';
    require './model/modelVorgangSort.php';
    require './model/modelZahlung.php';
    require './model/modelDesign.php';
    require './model/modelJson.php';
    require './controller/controllerMandant.php';
    require './controller/controllerMitarbeiter.php';
    require './controller/controllerMitarbeiterDaten.php';
    require './controller/controllerEmailConfig.php';
    require './controller/controllerDesign.php';
    require './controller/controllerMenueSort.php';
    require './controller/controllerVorgangSort.php';
    require './controller/controllerZahlung.php';
    require './controller/controllerStart.php';
    require './view/Startseite.php';
    require './view/mandantView.php';
    require './view/mitarbeiterView.php';
    require './view/mitarbeiterDatenView.php';
    require './view/emailConfigView.php';
    require './view/emailVorlageView.php';
    require './view/designView.php';
    require './view/menuSortView.php';
    require './view/vorgangSortView.php';
    require './view/zahlungView.php';

    $seite = $_GET['seite'] ?? 'start';
    $seite = preg_replace('/[^a-zA-Z]/', '', $seite);
    $seite = trim($seite);
    $seite = htmlspecialchars($seite, ENT_QUOTES, 'UTF-8');

    $pdo = null;

    switch ($seite)
    {
        case 'start': 
            
            session_start();
                $_SESSION = array();
            session_destroy();
           
            $start = new StartSeite();
            $startController = new StartController($start);

            $startController->handleRequest();      
        break;

        case 'mandant':
                    $pdo = new Connection();
                    $mandantView = new MandantView();
                    $mandantModel = new Mandant($pdo,$mandantView);
                    $mandantController = new MandantController($mandantModel);
                    $mandantController->handleRequest();
  
        break;
        
        case 'mitarbeiter':
            $pdo = new Connection();
            $mitarbeiterView = new MitarbeiterView();
            $mitarbeiterModel = new Mitarbeiter($pdo,$mitarbeiterView);
            $mitarbeiterController = new MitarbeiterController($mitarbeiterModel);
            $mitarbeiterController->handleRequest();
        break;

        case 'mitarbeiterDaten':
            $pdo = new Connection();
            $mitarbeiterDatenView = new MitarbeiterDatenView();
            $mitarbeiterDatenModel = new MitarbeiterDaten($pdo,$mitarbeiterDatenView);
            $mitarbeiterDatenController = new MitarbeiterDatenController($mitarbeiterDatenModel);
            $mitarbeiterDatenController->handleRequest();
        break;

        case 'emailConfig':
            $pdo = new Connection();
            $emailConfigView = new EmailConfigView();
            $emailConfigModel = new EmailConfig($pdo,$emailConfigView);
            $emailConfigController = new EmailConfigController($emailConfigModel);
            $emailConfigController->handleRequest();
        break;

        case 'emailVorlage':
            $emailVorlageView = new EmailVorlageView();
            $emailVorlageView->render();
        break;

        case 'design':
            $pdo = new Connection();
            $designView = new DesignView();
            $designModel = new DesignModel($pdo,$designView);
            $designController = new DesignController($designModel);
            $designController->handleRequest();
        break;

        case 'menueSort':
            $pdo = new Connection();
            $menuSortView = new MenuSortView();
            $menuSortModel = new MenuSort($pdo,$menuSortView);
            $menuSortController = new MenuSortController($menuSortModel);
            $menuSortController->handleRequest();
            break;

        case 'vorgang':
            
                $pdo = new Connection();
                $vorgangSortView = new VorgangSortView();
                $vorgangSortModel = new VorgangSort($pdo,$vorgangSortView);
                $vorgangSortController = new VorgangSortController($vorgangSortModel);
                $vorgangSortController->handleRequest();
        break;

        case 'zahlung':
            $pdo = new Connection();
            $zahlungView = new ZahlungView();
            $zahlungModel = new ZahlungModel($pdo,$zahlungView);
            $modelListe=array(new Mandant($pdo),new Mitarbeiter($pdo),new MitarbeiterDaten($pdo),new EmailConfig($pdo),
            new DesignModel($pdo), new MenuSort($pdo), new VorgangSort($pdo),$zahlungModel, new Json($pdo));

            $zahlungController = new ZahlungController($modelListe);
            $zahlungController->handleRequest();
        break;

    }
        