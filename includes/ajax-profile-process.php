<?php


    // Incluimos las funciones del sistema
    require_once '../administrator/ss-functions.php';

    // Revisamos si existe la sesion o si es valida
    isuserajax();


    if (isset($_POST['process']))
    {
    	
     
     // Asignamos una variable al POST
     $process = $_POST['process'];

     // Si el elemento es vacio
    if (empty($process)){exit();}

    // Si es un espacio
    if (ctype_space($process)){exit();}

    

    // Empezamos a cargar lo que son paginas
    if ($process == 1){
      #.....................................







      #.....................................
    }elseif ($process == 2){
      #.....................................







      #.....................................
    }elseif ($process == 3){
      #.....................................







      #.....................................
    }elseif ($process == 4){
      #.....................................







      #.....................................
    }









    }else
    {

       exit();

    }



