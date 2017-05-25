<?php

    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();

    // Si el posttext es vacio
    if (empty($_POST['descripcion'])){exit();}


    // Si es un espacio
    if (ctype_space($_POST['descripcion'])){exit();}

    // Primero el Año
    $theyear = date('Y');

    // Ahora el Mes 
    $themonth = date ('m');

    // creamos directorio para el usuario el año
    if(!is_dir("../attachments/".$_SESSION['ssid'])) 
        mkdir("../attachments/".$_SESSION['ssid'], 0777);

    // creamos directorio para el usuario
    if(!is_dir("../attachments/".$_SESSION['ssid']."/".$theyear)) 
        mkdir("../attachments/".$_SESSION['ssid']."/".$theyear, 0777);    


    // creamos directorio para el usuario el mes
    if(!is_dir("../attachments/".$_SESSION['ssid']."/".$theyear."/".$themonth)) 
        mkdir("../attachments/".$_SESSION['ssid']."/".$theyear."/".$themonth, 0777); 


    //obtenemos el archivo a subir
    $file = $_FILES['archivo']['name'];

    // Obtenemos la extension
    $fileext = new SplFileInfo($file);
    $getextension = $fileext->getExtension();

    // convertimos extension a minusculas
    $extension = strtolower($getextension);

    // Aqui sacamos la lista de extensiones
    $extensionlst = gettheextattachment();

    // Aqui hacemos un explode para cada uno 
    $extexplode = explode("|", $extensionlst);

    // Contamos el total de extensiones
    $exttotal = count($extexplode);

    
    for ($i=0; $i < $exttotal; $i++) { 
        
       if($extension === $extexplode[$i]){
           attachmentfiles($file,$_POST['descripcion']);
           exit();
       }

    }








