<?php

session_start();

// Incluimos Archivo de Conexion a Base de Datos
require_once 'administrator/includes/login.class.php';
require_once 'administrator/includes/resize.php';
require_once 'administrator/includes/class.inputfilter.php';
require_once 'administrator/phpmailer/PHPMailerAutoload.php'; 

$conexion = Conexion::singleton_conexion();

$user = $_SESSION['ssid'];

$update_sql = "UPDATE ".SSPREFIX."usuarios set activo = 2 WHERE id = " . $user;
$update_sql = $conexion->prepare( $update_sql );
$update_sql->execute();


$_SESSION['ssid'] = '';
$_SESSION['ssrango'] = '';
session_regenerate_id();
session_destroy();
header('Location: index.php');