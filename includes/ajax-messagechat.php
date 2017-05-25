<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();

    if (empty($_POST['profile'])){
    	// Enviamos los datos para el chat
        insertchatmessage($_POST['message'],$_POST['chater'],0);
    }else{
    	// Enviamos los datos para el chat
        insertchatmessage($_POST['message'],$_POST['chater'],$_POST['profile']);
    }
