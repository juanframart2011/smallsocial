<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();


    // Si el posttext es vacio
    if (empty($_POST['posttext'])){exit();}


    // Si es un espacio
    if (ctype_space($_POST['posttext'])){exit();}


    // Hacemos el posteo
    posterposting($_POST['posttext']);