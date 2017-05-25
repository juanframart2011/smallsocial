<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();

    // Si el like es vacio
    if (empty($_POST['like'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['like'])){exit();}

    // Si no es numerico
    if (is_numeric($_POST['like'])){}else{exit();}

    // Iniciamos la funcion del like
    knowthelikeajx($_POST['like']);