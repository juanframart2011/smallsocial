<?php

    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();

        // Si el data es vacio
    if (empty($_POST['data'])){exit();}


    // Si es un espacio
    if (ctype_space($_POST['data'])){exit();}

    // funcion para las imagenes
    showimagemodal($_POST['data']);
