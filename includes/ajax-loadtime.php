<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();


    // Si el elemento es vacio
    if (empty($_POST['page'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['page'])){exit();}

    // Si no es numerico
    if (is_numeric($_POST['page'])){}else{exit();}

    // vamos sacando los post restantes
    ajaxloadpst($_POST['page']);

