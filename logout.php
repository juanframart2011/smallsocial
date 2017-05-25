<?php


session_start();
$_SESSION['ssid'] = '';
$_SESSION['ssrango'] = '';
session_regenerate_id();
session_destroy();
header('Location: index.php');