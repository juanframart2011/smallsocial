<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();

    // Si el like es vacio
    if (empty($_POST['post'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['post'])){exit();}

    // Si no es numerico
    if (is_numeric($_POST['post'])){}else{exit();}

    // Iniciamos la funcion del like
    deletepost($_POST['post']);