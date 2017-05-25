<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajaxadm();

    // Si el like es vacio
    if (empty($_POST['comentario'])){exit();}

    // Si es un espacio
    if (ctype_space($_POST['comentario'])){exit();}

    // Si no es numerico
    if (is_numeric($_POST['comentario'])){}else{exit();}

    // Iniciamos la funcion de borrar comentario
    deletecommenta($_POST['comentario']);