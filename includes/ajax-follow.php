<?php

    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();

     // Si el elemento es vacio
    if (empty($_POST['follow'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['follow'])){exit();}
    
    // Es numerico o no
    if (is_numeric($_POST['follow'])){}else{exit();}

    // Seguir o no
    follower($_POST['follow']);
