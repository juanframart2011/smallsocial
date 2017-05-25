<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();


        // Si el posttext es vacio
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['emailshow']) || empty($_POST['description'])){exit();}


    // Si es un espacio
    if (ctype_space($_POST['nombre']) || ctype_space($_POST['apellido']) || ctype_space($_POST['emailshow']) || ctype_space($_POST['description']) ){exit();}

    // update info
    updatemyinfo($_POST['nombre'],$_POST['apellido'],$_POST['apodo'],$_POST['emailshow'],$_POST['description']);