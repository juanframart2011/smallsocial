<?php

    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();


    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("../images/photos/")) 
        mkdir("../images/photos/", 0777);


    //comprobamos si existe un directorio para subir el archivot emporal
    //si no es así, lo creamos
    if(!is_dir("../images/photos/tmp")) 
        mkdir("../images/photos/tmp", 0777);

    
    // creamos directorio para el usuario
    if(!is_dir("../images/photos/".$_SESSION['ssid'])) 
        mkdir("../images/photos/".$_SESSION['ssid'], 0777);      

 
    //obtenemos el archivo a subir
    $file = $_FILES['profilepicture']['name'];

    // Obtenemos la extension
    $fileext = new SplFileInfo($file);
    $getextension = $fileext->getExtension();


    // convertimos extension a minusculas
    $extension = strtolower($getextension);

    // Verificamos si el archivo que se sube es valido
    if (strcmp($extension, 'jpg') == 0){
        processfilepostpicperfil($file,$_SESSION['ssid']);
        return;
    }else if (strcmp($extension, 'jpeg') == 0){
        processfilepostpicperfil($file,$_SESSION['ssid']);
        return;
    }else if (strcmp($extension, 'png') == 0){
        processfilepostpicperfil($file,$_SESSION['ssid']);
        return;
    }else if (strcmp($extension, 'gif') == 0){
        processfilepostpicperfil($file,$_SESSION['ssid']);
        return;
    }else{
       echo 1;
    }
