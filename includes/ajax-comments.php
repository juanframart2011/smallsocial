<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';


    // Revisamos si existe la sesion o si es valida
    isuserajax();

    
    // Hacemos el posteo
    postercomments($_POST['comentario'],$_POST['post']);