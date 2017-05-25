<?php

    // Incluimos las funciones del sistema
    require_once 'administrator/ss-functions.php';

    if (empty($_GET['email'])){echo "string";}
    if (ctype_space($_GET['email'])){echo "string";}
    if (empty($_GET['token'])){echo "string";}
    if (ctype_space($_GET['token'])){echo "string";}

    // Activar la cuenta
    activationaccout($_GET['email'],$_GET['token']);

