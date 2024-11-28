<?php

/**
 * @file        controllerMandant.php
 * @author      Ümit Yildirim <tutorials@elipso.de>
 * @copyright   Copyright (c) 2024, Ümit Yildirim. Alle Rechte vorbehalten.
 * @license     Diese Datei darf nicht ohne Zustimmung des Autors weitergegeben oder verändert werden.
 * @version     1.0.0
 * @since       2024-11-26
 */

    class MandantController
    {
       
        private $mandantModel;
        
       


        function __construct($mandantModel)
        {
            $this->mandantModel = $mandantModel;
            
        }

        public function handleRequest()
        {
            $name =$_POST['name'] ?? '';
            $name =  htmlspecialchars(stripslashes(trim($name)));
            $issetLogo = $_POST['issetLogo'] ?? false;
            $dateiname = '';
            
            $error = '';
            $logo =$_FILES['logo'] ?? null;
            $image =  $_POST['image'] ?? '' ;
            $image = htmlspecialchars(stripslashes(trim($image)));

            session_start();
            $_SESSION['image'] = $image;
            session_write_close();
          
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                
                
                $action = $_POST['action'] ?? '';

                if($action === "hochladen" && !empty($logo['tmp_name']))
                { 
                    // Es kann sein das böswillige Dateinamemen verwendet werden, daher werden Sonderzeichen ersetzt
                    $dateiname = preg_replace('/[^A-Za-z0-9_\-]/', '_', $logo["name"]);


                    $ziel = '../temp/logo/';

                    $dateiname = $ziel.basename($dateiname);
                    

                    // Lösche alle vorhandenen Dateien, am Ende kann sich nur ein Logo im Ordner befinden
                    // der dann hochgeladen wird. Der Ordner wird nach dem beenden, erneut geleert werden.
                    $daten = scandir($ziel);
                    foreach ($daten as $datei) 
                    { 
                        if ($datei != "." && $datei != "..") 
                        { 
                            $zielpfad = $ziel . DIRECTORY_SEPARATOR . $datei; 
                            if (is_file($zielpfad)) 
                            { 
                                unlink($zielpfad);
                            } 
                        } 
                    }

                    //Prüfung des Uploads mit  getimagesize(), auf Größe und Typ
                    $imagesize = getimagesize($logo['tmp_name']); // Bildinformationen

                    if($imagesize === false) // Prüft ob es sich tatsächlich um ein Bild handelt
                    {
                        $dateiname = '';
                        $error = "Bitte ein Bild hochladen.";
                    }
                    else
                    {
                        //Sichere Methode
                        $dateityp = $imagesize['mime']; // Prüft den Inhalt des Bildes und gibt den Typ zurück.
                        $erlaubteTypen = ['image/png','image/jpeg'];

                        if(!in_array($dateityp,$erlaubteTypen))
                        {
                            $dateiname = '';
                            $error = "Es dürfen nur PNG- und JPG-Dateien hochgeladen werden.";
                        }
                        else if ($imagesize[0] >600 || $imagesize[1] > 800)
                        {
                            $dateiname ='';
                            $error = "Die Bildgröße darf max. 600x800 sein.";
                        }
                    }

                    if(empty($error))   
                    {
                        // Alternativ kann auch mit UPLOAD_ERR_OK  geprüft werden
                        if(move_uploaded_file($logo["tmp_name"], $dateiname))
                        {
                            $this->mandantModel->uploadLogo($name,$dateiname);
                            exit();
                        }
                        else
                        {
                            $error = "Bitte laden Sie ein gültiges Logo hoch.";  
                        }
                    }
                    
                    
                    
                }
                else
                {
                    $error = "Bitte ein Bild auswählen.";
                }
               

                if($action ==="weiter")
                {
                    if($name )
                    {
                        if($issetLogo)
                        {
                         
                            $this->mandantModel->setMandantInfo($name,$image);

                            session_start();
                                $x = $_SESSION['sessionName'];
                                $y = $_SESSION['sessionId'];
                            session_write_close();

                            header('Location: index.php?seite=mitarbeiter&' . $x . '=' . $y);
                            exit;
                        }
                        else
                        {
                            $error = "Bitte laden Sie ein Logo hoch!";
                        }
                        
                    }
                    else
                    {
                        if($image)
                        {
                            $dateiname = './temp/logo/'.basename($image);
                        }
                        
                        $error = "Bitte Mandantennamen eingeben.";
                    }
                   
                }

                if($action === "zurück")
                {
                  
                    session_start();
                        $_SESSION = array();
                    session_write_close();
                    header('Location: index.php?seite=start');
                    exit;
                }
            }
           
            $this->mandantModel->updateView($error,$name,$dateiname,$issetLogo);
        }

    }
    
