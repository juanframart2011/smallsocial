<?php

// Incluimos las funciones del sistema
require_once 'administrator/ss-functions.php';

// si la sesion existe, si no de lo contrario no hace nada
isuserajax();

// Le otorgamos una variable al permalink
$permalink = $_SERVER['QUERY_STRING'];

if (empty($permalink)) {
	header('Location: home.php');
}

if (ctype_space($permalink)) {
	header('Location: home.php');
}

// Funcion para la descarga del archivo
downloadarchive($permalink);


