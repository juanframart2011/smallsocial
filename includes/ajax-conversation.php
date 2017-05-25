<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();

    // Si el like es vacio
    if (empty($_POST['conversation'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['conversation'])){exit();}

    // Si no es numerico
    if (is_numeric($_POST['conversation'])){}else{exit();}

    // Iniciamos la funcion de borrar comentario
    getchatconver($_POST['conversation']);