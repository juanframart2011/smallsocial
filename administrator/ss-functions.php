<?php


// Incluimos Archivo de Conexion a Base de Datos
require_once 'includes/login.class.php';
require_once 'includes/resize.php';
require_once 'includes/class.inputfilter.php';
require_once 'phpmailer/PHPMailerAutoload.php'; 


// Revisamos si el usuario ya entro al sistema.
// esta funcion es para paginas que solo pueden ver
// usuarios que aun no han entrado al sistema.
function checklogin(){
    if (isset($_SESSION['ssid'])){
       header("Location: home.php");
    }
}


// Revisamos y restringimos el acceso a usuarios
// que traten de acceder a areas del sistema sin
// autorizacion o sin haber iniciado sesion.
function checkisuser(){
    if (isset($_SESSION['ssid'])){
    }else{
       header("Location: index.php?notaccess");
    }
}


function themailsendphp($email,$mailtoken){


$dataexplode = congifurationmail();
$parsedata = explode("|", $dataexplode);

$htmlhead = '<!DOCTYPE html><html><body>';
$htmlfooter = '</body></html>';
$messageone = '<p>'.$parsedata[6].'</p></p><p></p>';
$activationlink = '<p><label>Activar mi cuenta</label><p></p><a href="'.$parsedata[5].'activate.php?token='.$mailtoken.'&email='.$email.'">'.$parsedata[5].'activate.php?token='.$mailtoken.'&email='.$email.'</a></p>';


$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $parsedata[0];  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $parsedata[3];                // SMTP username
$mail->Password = $parsedata[4];                          // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $parsedata[1];                                    // TCP port to connect to

$mail->setFrom($parsedata[3], $parsedata[2]);
$mail->addAddress($email);         // Name is optional
$mail->isHTML(true);           // Set email format to HTML

$mail->Subject = 'Verificar Correo Electronico';
$mail->Body    = $htmlhead.$messageone.$activationlink.$htmlfooter;
$mail->AltBody = $htmlhead.$messageone.$activationlink.$htmlfooter;
$mail->send();


}





// Fncion para los emoticones
function emoticons($text){
        $icons = array(
                ':)'    =>  '<img style="float:none;" src="images/emoticons/smile.png"  />',
                ':-)'   =>  '<img style="float:none;" src="images/emoticons/squint.png"  />',
                ':D'    =>  '<img style="float:none;" src="images/emoticons/grin.png"  />',
                ';)'    =>  '<img style="float:none;" src="images/emoticons/wink.png"  />',
                ':P'    =>  '<img style="float:none;" src="images/emoticons/tongue.png"  />',
                ':p'    =>  '<img style="float:none;" src="images/emoticons/tongue.png"  />',
                ':('    =>  '<img style="float:none;" src="images/emoticons/frown.png"  />',
                ':o'    =>  '<img style="float:none;" src="images/emoticons/gasp.png"  />',
                ':O'    =>  '<img style="float:none;" src="images/emoticons/gasp.png"  />',
                ':0'    =>  '<img style="float:none;" src="images/emoticons/gasp.png"  />',
                ':|'    =>  '<img style="float:none;" src="images/emoticons/unsure.png"  />',
                ':/'    =>  '<img style="float:none;" src="images/emoticons/unsure.png"  />',
                'B)'    =>  '<img style="float:none;" src="images/emoticons/glasses.png"  />',
                'B|'    =>  '<img style="float:none;" src="images/emoticons/sunglasses.png"  />',
                '3:)'    =>  '<img style="float:none;" src="images/emoticons/devil.png"  />',
                'O:)'    =>  '<img style="float:none;" src="images/emoticons/angel.png"  />',
                ':v'    =>  '<img style="float:none;" src="images/emoticons/pacman.png"  />',
                '>.<'    =>  '<img style="float:none;" src="images/emoticons/upset.png"  />',
                '>..<'    =>  '<img style="float:none;" src="images/emoticons/grumpy.png"  />',
                ':/'    =>  '<img style="float:none;" src="images/emoticons/unsure.png"  />',
                'O.o'    =>  '<img style="float:none;" src="images/emoticons/confused.png"  />',
                'o.O'    =>  '<img style="float:none;" src="images/emoticons/confused.png"  />',
                ':3'    =>  '<img style="float:none;" src="images/emoticons/colonthree.png"  />',
                'ñ_ñ'    =>  '<img style="float:none;" src="images/emoticons/kiki.png"  />',
                ':*'    =>  '<img style="float:none;" src="images/emoticons/kiss.png"  />',
                ":'("    =>  '<img style="float:none;" src="images/emoticons/kiki.png"  />',
                "<3"    =>  '<img style="float:none;" src="images/emoticons/heart.png"  />',
                ':-/'   =>  '<img style="float:none;" src="images/emoticons/unsure.png"  />'
        );
        return strtr($text, $icons);
}



function generateRandomString($length = 6) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function congifurationmailrecover(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'socialconfig WHERE id = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['smtp'].'|'.$key['port'].'|'.$key['fromname'].'|'.$key['mail'].'|'.$key['password'].'|'.$key['url'].'|'.$key['renewmessage'];
        return $data;
      }
   }
}



// Nombre del sitio
function getthesitename(){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT sitename FROM '.SSPREFIX.'socialconfig WHERE id = 1';
   $stn = $conexion -> prepare($SQL);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
   	 $conexion = '';
   	 exit();
   }else{
   	  foreach ($rstl as $key){
   	  	 echo $key['sitename'];
   	  }
   }

   $conexion = '';

}





// Nombre del sitio
function thenameusertitle($permalink){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE permalink = :permalink LIMIT 1';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':permalink',$permalink,PDO::PARAM_STR);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
   }else{
      foreach ($rstl as $key){
         return $key['id'].'|'.$key['nombre'].' '.$key['apellido'];
      }
   }

   $conexion = '';

}







// Acceso a los usuarios
function theloginmemeber($email,$password){

    // Revisamos email y password
    $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
    $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

    if($email_check && $password_check > 0)
    {
        //accedemos al método usuarios y los mostramos
        $nuevoSingleton = Login::singleton_login();
        $usuario = $nuevoSingleton->login_users($email,$password);
    
         if($usuario == TRUE)
         {
             header("Location: home.php");
         }
         if($usuario == FALSE)
        {
        	   header("Location: index.php?error");
        }
    }
    else
    {
    	     header("location: index.php?error");
    }

}


// Tomamos el nombre,apellido y apodo del usuario.
function gettheusername(){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE id = :id';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id', $_SESSION['ssid'] , PDO::PARAM_INT);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
     $conexion = '';
     exit();
   }else{
      foreach ($rstl as $key){
         if (empty($key['apodo'])) {
            $apodo = '';
         }else{
            $apodo = '('.$key['apodo'].')';
         }
         echo '<h3 class="widget-user-username">'.$key['nombre'].' '.$key['apellido'].'</h3><h5 class="widget-user-desc">'.$apodo.'</h5>';
      }
   }
   $conexion = '';
}


// Tomamos el nombre,apellido y apodo del usuario.
function gettheusernameprofileperid($id){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE id = :id';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id', $id , PDO::PARAM_INT);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
     $conexion = '';
     exit();
   }else{
      foreach ($rstl as $key){
         if (empty($key['apodo'])) {
            $apodo = '';
         }else{
            $apodo = '('.$key['apodo'].')';
         }
         echo '<h3 class="widget-user-username">'.$key['nombre'].' '.$key['apellido'].'</h3><h5 class="widget-user-desc">'.$apodo.'</h5>';
      }
   }
   $conexion = '';
}


// Nombre de usuario para el post
function gettheusernamepost(){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE id = :id';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id', $_SESSION['ssid'] , PDO::PARAM_INT);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
     $conexion = '';
     exit();
   }else{
      foreach ($rstl as $key){
         $dataname = $key['nombre'].' '.$key['apellido'];
      }

      return $dataname;
   }

   $conexion = '';

}



// Nombre de usuario para el post
function gettheusernamepostperid($id){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE id = :id';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id', $id , PDO::PARAM_INT);
   $stn -> execute();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){
     $conexion = '';
     exit();
   }else{
      foreach ($rstl as $key){
         $dataname = $key['nombre'].' '.$key['apellido'];
      }

      return $dataname;
   }

   $conexion = '';

}





// Para las peticiones AJAX del usuario
function isuserajax(){
   if (is_null($_SESSION['ssid'])){
     exit();
   }
}

function isuserajaxadm(){
   if (is_null($_SESSION['ssid'])){
     if ($_SESSION['ssrango'] == 2){
     }else{
       exit();
     }
   }
}



// Imagen de perfil
function getmyprofileimage(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT ruta FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario AND type = 1 AND album = 1 ORDER BY fecha DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] , PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
        echo 'images/profile-default.jpg';
    }else{
      foreach ($rstl as $key){
        echo str_replace('normal', 'small', $key['ruta']);
      }
    }
}



function getmyprofileimageperid($id){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT ruta FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario AND type = 1 AND album = 1 ORDER BY fecha DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $id , PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
        echo 'images/profile-default.jpg';
    }else{
      foreach ($rstl as $key){
        echo str_replace('normal', 'small', $key['ruta']);
      }
    }
}



// Funcion para la imagen de perfil
function processfilepostpicperfil($archive,$profile){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    //comprobamos si el archivo ha subido y lo movemos a una ruta temporal
    if ($archive && move_uploaded_file($_FILES['profilepicture']['tmp_name'],"../images/photos/".$profile."/".$archive)){
    }  

    // Creamos ruta del temporal
    $temporal = '../images/photos/'.$profile.'/'.$archive;

    // Creamos un alfanumerico aleatorio.
    $characters = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < 60; $i++) {
     $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Creamos una fecha para combinar con el string
    $date = date("Y-m-d");
    $datesecond  = date("Y-m-d h:i:s");

    // Asignamos una ruta para el proceso de imagen 
    $ruta = '../images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';
    $rutasmall = '../images/photos/'.$profile.'/small-'.$string.$date.'.jpg';  
    $small = '../images/photos/'.$profile.'/small-'.$string.$date.'.jpg';    

    // Asignamos una ruta para la base de datos
    $finalruta = 'images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';

    list($widthimg, $heightimg) = getimagesize($temporal);

    // Procesamos archivo para redimensionar
    smart_resize_image($temporal, null, $widthimg, $heightimg, false , $ruta, true , false ,100);
   
    // Cópiamos imagen
    copy($ruta, $small);

    smart_resize_image($small, null, 128, 128, false , $rutasmall, true , false ,100);


    $permapost = sha1($datesecond.$string);
    $tipoimagen = 1;
    $album = 1;
    
    // Vaciamos a la tabla de imagenes la informacion sobre el archivo y su ruta
    $takepic = 'INSERT INTO '.SSPREFIX.'imagespost (ruta, usuario, fecha, album, type) VALUES (:ruta, :usuario, :fecha, :album, :type)';
    $takepicstn = $conexion -> prepare($takepic);
    $takepicstn -> bindParam(':usuario' ,$_SESSION['ssid'], PDO::PARAM_INT);
    $takepicstn -> bindParam(':fecha', $datesecond, PDO::PARAM_STR);
    $takepicstn -> bindParam(':type' ,$tipoimagen, PDO::PARAM_INT);
    $takepicstn -> bindParam(':ruta',$finalruta, PDO::PARAM_STR);
    $takepicstn -> bindParam(':album' , $album, PDO::PARAM_INT);
    $takepicstn -> execute();
    $lastimageid = $conexion -> lastInsertId();


    // Vaciamos todo a nuestra base de datos
    $SQL = 'INSERT INTO '.SSPREFIX.'posts (post, usuario, permalink, fecha, tipo) VALUES (:post, :usuario, :permalink, :fecha, :tipo)';
    $stn = $conexion->prepare($SQL);                                  
    $stn -> bindParam(':post',$lastimageid,PDO::PARAM_STR);
    $stn -> bindParam(':fecha',$datesecond,PDO::PARAM_STR);
    $stn -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
    $stn -> bindParam(':tipo',$tipoimagen,PDO::PARAM_INT);
    $stn -> bindParam(':permalink', $permapost, PDO::PARAM_INT); 
    $stn ->execute(); 
    $thepostid = $conexion -> lastInsertId();


    // imagen de perfil 
    $profileimg = userprofile($_SESSION['ssid']);
    
    // Fecha
    $fechastronger = fechastring($date,$permapost);

    echo'
        <div id="post-public'.$thepostid.'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.gettheusernamepost().'">
                <span class="username"><a href="profile.php?leanserwebmaster">'.gettheusernamepost().'</a></span>
                '.$fechastronger.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$thepostid.'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

                  
                  list($widthimg, $heightimg) = getimagesize('../'.$finalruta);

                  if ($widthimg >= 700){
                     echo '<div class="col-sm-12 text-center"><img style="width:100%; display:block;margin-bottom: 20px;" src="'.str_replace('../', '', $finalruta).'"></div>';
                  }else{
                     echo '<div class="col-sm-12 text-center"><img style="margin-bottom: 20px;" src="'.str_replace('../', '', $finalruta).'"></div>';
                  }

              echo'<!-- Social sharing buttons -->
              <button id="liker'.$thepostid.'" type="button" data-target="'.$thepostid.'" class="likethis btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>
              <span id="likecomment'.$thepostid.'" class="pull-right text-muted">
                 
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$thepostid.'" id="commentfrm'.$thepostid.'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$profileimg.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$lastid.'" class="box-footer box-comments">

            </div>

          </div>
    ';


    echo"
          <script>
              $('#image-profile').attr('src','".str_replace('../', '', $rutasmall)."');
          </script>
    ";



    $conexion = '';

}



function userprofile($id){

    if ($id == $_SESSION['ssid']) {
      $userdata = $_SESSION['ssid'];
    }else{
      $userdata = $id;
    }

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario AND album = 1 AND type = 1 ORDER BY id DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $userdata ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
         $rtndata = 'images/profile-default.jpg';
    }else{
      foreach ($rstl as $key){
         $rtndata = str_replace('normal', 'small', $key['ruta']);
      }
    }

    return $rtndata;
    $conexion = '';

}




function userprofileportada(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario AND album = 3 AND type = 3 ORDER BY id DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
         $rtndata = str_replace('normal', 'small', $key['ruta']);
         echo'
         
          style="
              background: url('.$rtndata.') no-repeat center center; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
          ";

         ';
      }
    }

    $conexion = '';

}



function userprofileportadaperid($id){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario AND album = 3 AND type = 3 ORDER BY id DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $id ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
         $rtndata = str_replace('normal', 'small', $key['ruta']);
         echo'
         
          style="
              background: url('.$rtndata.') no-repeat center center; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
          ";

         ';
      }
    }

    $conexion = '';

}



function fechastring($fecha,$permalink){
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$time = date('h:i A',strtotime(substr($fecha, 11,8)));
$complete = '<span class="description" title="'.$fecha.'"><a class="alinkfecha" href="post.php?'.$permalink.'"><i class="glyphicon glyphicon-time"></i> '.$dias[$day]." ".$day." de ".$meses[(int)$month]. " del ".$year.'</a></span>';
return $complete;
}



// Fecha string comment
function fechastringcomment($fecha){
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$time = date('h:i A',strtotime(substr($fecha, 11,8)));
$complete = '<span class="text-muted"  title="'.$fecha.'" style="font-size: 10px;"><i class="glyphicon glyphicon-time"></i> '.$dias[$day]." ".$day." de ".$meses[(int)$month]. " del ".$year.'</span>';
return $complete;
}


// Fecha string chat
function fechastringchat($fecha){
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$time = date('h:i A',strtotime(substr($fecha, 11,8)));
$complete = $dias[$day]." ".$day." ".$meses[(int)$month]. " ".$time;
return $complete;
}






function profileimageposttake($idimage){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT ruta FROM '.SSPREFIX.'imagespost WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $idimage ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

          list($widthimg, $heightimg) = getimagesize($key['ruta']);

          if ($widthimg >= 700){
             echo '<div class="col-sm-12 text-center"><img style="width:100%; display:block;margin-bottom: 20px;" src="'.$key['ruta'].'"></div>';
          }else{
             echo '<div class="col-sm-12 text-center"><img style="margin-bottom: 20px;" src="'.$key['ruta'].'"></div>';
          }

      }
    }

    $conexion = '';

}



function profileimageposttakeloader($idimage){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT ruta FROM '.SSPREFIX.'imagespost WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $idimage ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

          list($widthimg, $heightimg) = getimagesize('../'.$key['ruta']);

          if ($widthimg >= 700){
             echo '<div class="col-sm-12 text-center"><img style="width:100%; display:block;margin-bottom: 20px;" src="'.$key['ruta'].'"></div>';
          }else{
             echo '<div class="col-sm-12 text-center"><img style="margin-bottom: 20px;" src="'.$key['ruta'].'"></div>';
          }

      }
    }

    $conexion = '';

}




function portadaimageposttake($idimage){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT ruta FROM '.SSPREFIX.'imagespost WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $idimage ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        echo '<div class="col-sm-12 text-center"><img style="width:100%; display:block;margin-bottom: 20px;" src="'.$key['ruta'].'"></div>';

      }
    }

    $conexion = '';

}

function getattachblock($id,$desc){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'attachment WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id',$id, PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
       
       foreach ($rstl as $key){
        echo '<p></p>
              <div class="attachment-block clearfix">
                <img class="attachment-img" src="images/extensions/'.$key['ext'].'.png" >

                <div class="attachment-pushed">
                  <h4 class="attachment-heading"><a target="_blank" href="attachment.php?'.$key['permalink'].'">'.$key['nombre'].'</a></h4>

                  <div class="attachment-text" style="margin-top: 7px;">
                    <p style="margin: 0px;"><label>Fecha de Creación:</label>'.fechastringchat($key['fecha']).'</p>
                    <p><label>Descripción:</label> '.emoticons($desc).'</p>
                    <p><label>Peso: </label> '.formatSizeUnits($key['peso']).'</p>
                    <a target="_blank" class="btn btn-sm btn-danger pull-right" href="attachment.php?'.$key['permalink'].'"><i class="fa fa-download" aria-hidden="true"></i> Descargar</a>
                  </div>
                  <!-- /.attachment-text -->
                </div>
                <!-- /.attachment-pushed -->
              </div>
         ';
       }
    }
}



// Tomamos los ultimos 6 post
function takemylast6post(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario = :usuario ORDER BY '.SSPREFIX.'posts.id DESC LIMIT 6';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario' , $_SESSION['ssid'], PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$key['postingid'].'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttake($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklike($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}

// Tomamos los ultimos 6 post
function takemylast6postprofile($idprofile){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario = :usuario ORDER BY '.SSPREFIX.'posts.id DESC LIMIT 6';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario' , $idprofile, PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttake($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklike($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}

function liker($like){


   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();


   $SQL = 'SELECT * FROM '.SSPREFIX.'likepost WHERE post = :post AND usuario = :usuario LIMIT 1';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':post',$like,PDO::PARAM_INT);
   $stn -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
   $stn -> execute();
   $rstl = $stn -> fetchAll();

    // Para las notificaciones
    // Primero sacamos a quien le pertenece el post
    $dequienes = knowthispostuserid($like);

    // Como es un "Me Gusta" el tipo es 2
    $tipontf = 2;

   if (empty($rstl)){


    $likesql = 'INSERT INTO '.SSPREFIX.'likepost (post,usuario) VALUES (:post,:usuario)';
    $likestn = $conexion -> prepare($likesql);
    $likestn -> bindParam(':post',$like,PDO::PARAM_INT);
    $likestn -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
    $likestn -> execute();


    // Luego hacemos un if para canalizar si hay o no notificacion
    if ($dequienes == $_SESSION['ssid']){
    }
    else{
       $datesecond = date('Y-m-d h:i:s');
       $leidonew = 1;
       $NTF = 'INSERT INTO '.SSPREFIX.'notifications (para, de, tipo, post, leido ,fecha) VALUES (:para, :de, :tipo, :post, :leido, :fecha)';
       $ntfstn = $conexion -> prepare($NTF);
       $ntfstn -> bindParam(':para',$dequienes,PDO::PARAM_INT);
       $ntfstn -> bindParam(':de', $_SESSION['ssid'],PDO::PARAM_INT);
       $ntfstn -> bindParam(':tipo',$tipontf,PDO::PARAM_INT);
       $ntfstn -> bindParam(':post',$like,PDO::PARAM_INT);
       $ntfstn -> bindParam(':leido',$leidonew,PDO::PARAM_INT);
       $ntfstn -> bindParam(':fecha',$datesecond,PDO::PARAM_STR);
       $ntfstn -> execute();
    }



   }else{


    $dislikesql = 'DELETE FROM '.SSPREFIX.'likepost WHERE post = :post AND usuario = :usuario';
    $dislikesql = $conexion -> prepare($dislikesql);
    $dislikesql -> bindParam(':post',$like,PDO::PARAM_INT);
    $dislikesql -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
    $dislikesql -> execute();


    // Luego hacemos un if para canalizar si hay o no notificacion
    if ($dequienes == $_SESSION['ssid']){
    }
    else{

       $NTF = 'DELETE FROM '.SSPREFIX.'notifications WHERE de = :de AND post = :post AND tipo = :tipo';
       $ntfstn = $conexion -> prepare($NTF);
       $ntfstn -> bindParam(':de',$_SESSION['ssid'],PDO::PARAM_INT);
       $ntfstn -> bindParam(':post',$like,PDO::PARAM_INT);
       $ntfstn -> bindParam(':tipo',$tipontf,PDO::PARAM_INT);
       $ntfstn -> execute();
    }



   }

   $conexion = '';

}




// Para hacer la publicacion
function posterposting($data){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // Creamos un alfanumerico aleatorio.
    $characters = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < 60; $i++) {
     $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Tomamos la fecha y hora con segundos
    $fechaseconds = date('Y-m-d h:i:s');
    $fechanormal =  date('Y-m-d');

    // Creamos el permalink de la publicacion
    $permalink = sha1($string.$fechaseconds);

    // Limitamos las publicaciones a tan solo 1000 caracteres
    $postparse = substr($data, 0,1000);

    // Filtramos para evitar XSS Injection
    $filtro = new InputFilter();
    $finalpost = $filtro->process($postparse);


    // Revisamos si el resultado es vacio para no tener que postearlo
    if (empty($finalpost)){
       exit();
    }

    if (is_null($finalpost)){
       exit();
    }


    // Como es un post normal es el 2
    $tipo = 2;

    $SQL = 'INSERT INTO '.SSPREFIX.'posts (post, usuario, permalink, fecha, tipo) VALUES (:post, :usuario, :permalink, :fecha, :tipo)';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':post', $finalpost ,PDO::PARAM_STR);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> bindParam(':permalink', $permalink ,PDO::PARAM_STR);
    $stn -> bindParam(':fecha', $fechaseconds ,PDO::PARAM_STR);
    $stn -> bindParam(':tipo', $tipo ,PDO::PARAM_INT);
    $stn -> execute();
    $lastid = $conexion -> lastInsertId();

    // imagen de perfil 
    $profileimg = userprofile($_SESSION['ssid']);
    
    // Fecha
    $fechastronger = fechastring($fechanormal,$permalink);

    echo'
        <div id="post-public'.$lastid.'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.gettheusernamepost().'">
                <span class="username"><a href="profile.php?leanserwebmaster">'.gettheusernamepost().'</a></span>
                '.$fechastronger.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$lastid.'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->

              <p>'.emoticons($finalpost).'</p>

              <!-- Social sharing buttons -->
              <button id="liker'.$lastid.'" type="button" data-target="'.$lastid.'" class="likethis btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>
              <span id="likecomment'.$lastid.'" class="pull-right text-muted">
                 
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$lastid.'" id="commentfrm'.$lastid.'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$profileimg.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$lastid.'" class="box-footer box-comments">

            </div>

          </div>
    ';


    $conexion = '';


}


// Function para Checar los Likes
function checklike($post){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'likepost WHERE post = :post AND usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':post', $post ,PDO::PARAM_INT);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();

    if (empty($rstl)){
        echo '<button id="liker'.$post.'" type="button" data-target="'.$post.'" class="likethis btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>';
    }else{
        echo '<button id="liker'.$post.'" type="button" data-target="'.$post.'" class="likethis btn btn-xs active btn-primary"><i class="fa fa-thumbs-o-down"></i> Ya no me gusta</button>';
    }

    $conexion = '';

}



// Function para Checar los Likes
function checklikeloadtime($post){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'likepost WHERE post = :post AND usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':post', $post ,PDO::PARAM_INT);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();

    if (empty($rstl)){
        echo '<button id="liker'.$post.'" type="button" data-target="'.$post.'" onclick="thelikeloadtimeclick('.$post.');" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>';
    }else{
        echo '<button id="liker'.$post.'" type="button" data-target="'.$post.'" onclick="thelikeloadtimeclick('.$post.');" class="btn btn-xs active btn-primary"><i class="fa fa-thumbs-o-down"></i> Ya no me gusta</button>';
    }

    $conexion = '';

}


function checklikeandcomments($post){


    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    // Contamos los likes
    $likesql = 'SELECT * FROM '.SSPREFIX.'likepost WHERE post = :post';
    $likestn = $conexion -> prepare($likesql);
    $likestn -> bindParam(':post' , $post , PDO::PARAM_INT);
    $likestn -> execute();
    $liketotal = $likestn -> rowCount();


    // Contar Comentarios
    $commentsql = 'SELECT * FROM '.SSPREFIX.'comments WHERE post = :post';
    $commentstn = $conexion -> prepare($commentsql);
    $commentstn -> bindParam(':post' , $post , PDO::PARAM_INT);
    $commentstn -> execute();
    $commnettotal = $commentstn -> rowCount();


    if ($liketotal <= 0){
      echo'';
    }else{
      echo '<a class="knowthelike" data-like="'.$post.'"><i class="fa fa-thumbs-o-up"></i> '.$liketotal .' </a> ';
    }

    if ($commnettotal <= 0){
      echo'';
    }else{
      echo '<a><i class="fa fa-comment-o"></i> '.$commnettotal.' </a> ';
    }


    $conexion = '';

}






function likercheck($post){


    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    // Contamos los likes
    $likesql = 'SELECT COUNT(*) AS theknowlike FROM '.SSPREFIX.'likepost WHERE post = :post';
    $likestn = $conexion -> prepare($likesql);
    $likestn -> bindParam(':post' , $post , PDO::PARAM_INT);
    $likestn -> execute();
    $liketotal = $likestn -> fetchAll();
    foreach ($liketotal as $keylike){
       $datalike = $keylike['theknowlike'];
    }


    // Contar Comentarios
    $commentsql = 'SELECT COUNT(*) AS theknowcomment  FROM '.SSPREFIX.'comments WHERE post = :post';
    $commentstn = $conexion -> prepare($commentsql);
    $commentstn -> bindParam(':post' , $post , PDO::PARAM_INT);
    $commentstn -> execute();
    $commnettotal = $commentstn -> fetchAll();
    foreach ($commnettotal as $keylike){
       $datacomments = $keycomment['theknowcomment'];
    }

    if ($datalike <= 0){
      echo ' ';
    }else{
      echo '<a class="knowthelike"  data-like="'.$post.'"><i class="fa fa-thumbs-o-up"></i> '.$datalike.' </a> ';
    }

    if ($datacomments <= 0){
      echo ' ';
    }else{
      echo '<a><i class="fa fa-comment-o"></i> '.$datacomments.' </a> ';
    }

    $conexion = '';

}




// Funcion para el borrado de los comentarios
function checkdelcomment($usuario,$comentario){
        if($_SESSION['ssrango'] == 2){
            $data = ' <a data-comment="'.$comentario.'" class="deletecommentadmin pull-right"><i class="fa fa-times"></i></a>';
            return $data;
        }elseif ($usuario == $_SESSION['ssid']){
            $data = ' <a data-comment="'.$comentario.'" class="deletecomment pull-right"><i class="fa fa-times"></i></a>';
            return $data;
        }
}


// Sacar los comentarios
function comments($post,$permalink){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT '.SSPREFIX.'comments.id AS commentid, '.SSPREFIX.'comments.usuario, '.SSPREFIX.'comments.comentario, '.SSPREFIX.'comments.post, '.SSPREFIX.'comments.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink FROM '.SSPREFIX.'comments INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'comments.usuario = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'comments.post = :post ORDER BY '.SSPREFIX.'comments.fecha ASC';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':post',$post,PDO::PARAM_INT);
   $stn -> execute();
   $cuantoscomments = $stn -> rowCount();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){


   }else{
        $countcomments = 0;
       foreach ($rstl as $key){

         // imagen de perfil 
         $profileimg = userprofile($key['usuario']);

         if ($countcomments > 5){
             $faltantes = $cuantoscomments - 5;
           echo '
            <a href="post.php?'.$permalink.'" class="btn btn-xs btn-block btn-primary"><i class="fa fa-comment-o"></i> Ver mas comentarios  <b>['.$faltantes.' de '.$cuantoscomments .']</b></a>
           ';
           return;
         }else{

            echo'
               <div id="commentario-per-'.$key['commentid'].'" class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm user" src="'.$profileimg.'">
                <div class="comment-text">
                      <span class="username">
                        <a href="profile.php?'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].' '.fechastringcomment($key['fecha']).'</a>
                        '.checkdelcomment($key['usuario'],$key['commentid']).'
                      </span><!-- /.username -->
                    <p>'.emoticons($key['comentario']).'</p>
                </div>
                <!-- /.comment-text -->
              </div>
            ';

         }


        $countcomments++;

       }

    }

    $conexion = '';

}


// Ver mas comentarios pero ajax :P
function commentsajx($post,$permalink){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT '.SSPREFIX.'comments.id AS commentid, '.SSPREFIX.'comments.usuario, '.SSPREFIX.'comments.comentario, '.SSPREFIX.'comments.post, '.SSPREFIX.'comments.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink FROM '.SSPREFIX.'comments INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'comments.usuario = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'comments.post = :post ORDER BY '.SSPREFIX.'comments.fecha ASC';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':post',$post,PDO::PARAM_INT);
   $stn -> execute();
   $cuantoscomments = $stn -> rowCount();
   $rstl = $stn -> fetchAll();
   if (empty($rstl)){


   }else{
        $countcomments = 0;
       foreach ($rstl as $key){

         // imagen de perfil 
         $profileimg = userprofile($key['usuario']);

            echo'
               <div id="commentario-per-'.$key['commentid'].'" class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm user" src="'.$profileimg.'">
                <div class="comment-text">
                      <span class="username">
                        <a href="profile.php?'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].' '.fechastringcomment($key['fecha']).'</a>
                        '.checkdelcomment($key['usuario'],$key['commentid']).'
                      </span><!-- /.username -->
                    <p>'.emoticons($key['comentario']).'</p>
                </div>
                <!-- /.comment-text -->
              </div>
            ';

        $countcomments++;

       }

    }

    $conexion = '';

}




// Para eliminar imagenes
function elimiateimagepst($idimg){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id',$idimg,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{

      foreach ($rstl as $key){

             $namearchive = $key['ruta'];
             $namearchsmall = str_replace('normal', 'small', $namearchive);

             // Borramos la imagen normal
             unlink('../'.$namearchive);
             //Borramos imagen small
             unlink('../'.$namearchsmall);

             // Sentencia para eliminar registro de imagenes
             $SQLImagesdel = 'DELETE FROM '.SSPREFIX.'imagespost WHERE id = :id';
             $stnimagesdel = $conexion -> prepare($SQLImagesdel);
             $stnimagesdel -> bindParam(':id', $idimg ,PDO::PARAM_INT);
             $stnimagesdel -> execute(); 

       }

    }
}

// Eliminar archivo del post
function eliminatefilepost($post){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // Parseamos el archivo
    $parseexplode = explode('|', $post);

    $SQL = 'SELECT * FROM '.SSPREFIX.'attachment WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id',$parseexplode[0],PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{

      foreach ($rstl as $key){

             $namearchive = $key['ruta'];

             // Borramos la imagen normal
             unlink($namearchive);

             // Sentencia para eliminar registro de imagenes
             $SQLFileDel = 'DELETE FROM '.SSPREFIX.'attachment WHERE id = :id';
             $stnfiledelete = $conexion -> prepare($SQLFileDel);
             $stnfiledelete -> bindParam(':id', $parseexplode[0] ,PDO::PARAM_INT);
             $stnfiledelete -> execute(); 

       }

    }

}

function deletepost($post){


    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // Revisamos que tipo de publicacion es, mas que nada para
    // Que en el momento en que eliminamos una publicacion que sea
    // una imagen, esta sea borrada del servidor.

    $CHKPST = 'SELECT * FROM '.SSPREFIX.'posts WHERE id = :id';
    $stnchk = $conexion -> prepare($CHKPST);
    $stnchk -> bindParam(':id',$post,PDO::PARAM_INT);
    $stnchk -> execute();
    $rstl = $stnchk -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
         
         if ($key['tipo'] == 1){
             elimiateimagepst($key['post']);
         }elseif ($key['tipo'] == 3){
             elimiateimagepst($key['post']);
         }elseif ($key['tipo'] == 4){
             eliminatefilepost($key['post']);
         }


         $SQL = 'DELETE FROM '.SSPREFIX.'posts WHERE id = :id AND usuario = :usuario';
         $stn = $conexion -> prepare($SQL);
         $stn -> bindParam(':id', $post ,PDO::PARAM_INT);
         $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
         $stn -> execute();

         $SQLike = 'DELETE FROM '.SSPREFIX.'likepost WHERE post = :post';
         $stnlike = $conexion -> prepare($SQLike);
         $stnlike -> bindParam(':post', $post ,PDO::PARAM_INT);
         $stnlike -> execute();

         $SQLcomments = 'DELETE FROM '.SSPREFIX.'comments WHERE post = :post';
         $stncomments = $conexion -> prepare($SQLcomments);
         $stncomments -> bindParam(':post', $post ,PDO::PARAM_INT);
         $stncomments -> execute(); 



      }
    }


    $conexion = '';


}




///////////////////////////////////////////////////////////////////////////////////////////////////

function processfilepostpicportada($archive,$profile){
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    //comprobamos si el archivo ha subido y lo movemos a una ruta temporal
    if ($archive && move_uploaded_file($_FILES['portadaupload']['tmp_name'],"../images/photos/".$profile."/".$archive)){
    }  

    // Creamos ruta del temporal
    $temporal = '../images/photos/'.$profile.'/'.$archive;

    // Creamos un alfanumerico aleatorio.
     $characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
     $string = '';
     for ($i = 0; $i < 75; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
     }

     // Creamos una fecha para combinar con el string
     $date = date("Y-m-d");
     $datesecond = date("Y-m-d h:i:s");

    // Asignamos una ruta para el proceso de imagen 
    $ruta = '../images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';
    $rutasmall = '../images/photos/'.$profile.'/small-'.$string.$date.'.jpg';  
    $small = '../images/photos/'.$profile.'/small-'.$string.$date.'.jpg';    

    // Asignamos una ruta para la base de datos
    $finalruta = 'images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';

    list($widthimg, $heightimg) = getimagesize($temporal);

    // Procesamos archivo para redimensionar
    smart_resize_image($temporal, null, $widthimg, $heightimg, false , $ruta, true , false ,50);
   
    // Cópiamos imagen
    copy($ruta, $small);

    smart_resize_image($small, null, 810, 200, false , $rutasmall, true , false ,50);


    $permapost = sha1($datesecond.$string);
    $tipoimagen = 3;
    $album = 3;
    
    // Vaciamos a la tabla de imagenes la informacion sobre el archivo y su ruta
    $takepic = 'INSERT INTO '.SSPREFIX.'imagespost (ruta, usuario, fecha, album, type) VALUES (:ruta, :usuario, :fecha, :album, :type)';
    $takepicstn = $conexion -> prepare($takepic);
    $takepicstn -> bindParam(':usuario' ,$_SESSION['ssid'], PDO::PARAM_INT);
    $takepicstn -> bindParam(':fecha', $datesecond, PDO::PARAM_STR);
    $takepicstn -> bindParam(':type' ,$tipoimagen, PDO::PARAM_INT);
    $takepicstn -> bindParam(':ruta',$finalruta, PDO::PARAM_STR);
    $takepicstn -> bindParam(':album' , $album, PDO::PARAM_INT);
    $takepicstn -> execute();
    $lastimageid = $conexion -> lastInsertId();


    // Vaciamos todo a nuestra base de datos
    $SQL = 'INSERT INTO '.SSPREFIX.'posts (post, usuario, permalink, fecha, tipo) VALUES (:post, :usuario, :permalink, :fecha, :tipo)';
    $stn = $conexion->prepare($SQL);                                  
    $stn -> bindParam(':post',$lastimageid,PDO::PARAM_STR);
    $stn -> bindParam(':fecha',$datesecond,PDO::PARAM_STR);
    $stn -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
    $stn -> bindParam(':tipo',$tipoimagen,PDO::PARAM_INT);
    $stn -> bindParam(':permalink', $permapost, PDO::PARAM_INT); 
    $stn ->execute(); 
    $thepostid = $conexion -> lastInsertId();


    // imagen de perfil 
    $profileimg = userprofile($_SESSION['ssid']);
    
    // Fecha
    $fechastronger = fechastring($date,$permapost);

    echo'
        <div id="post-public'.$thepostid.'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.gettheusernamepost().'">
                <span class="username"><a href="profile.php?leanserwebmaster">'.gettheusernamepost().'</a></span>
                '.$fechastronger.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$thepostid.'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              echo '<div class="col-sm-12 text-center"><img style="width:100%; display:block;margin-bottom: 20px;" src="'.$finalruta.'"></div>';

              echo'<!-- Social sharing buttons -->
              <button id="liker'.$thepostid.'" type="button" data-target="'.$thepostid.'" class="likethis btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>
              <span id="likecomment'.$thepostid.'" class="pull-right text-muted">
                 
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$thepostid.'" id="commentfrm'.$thepostid.'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$profileimg.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$lastid.'" class="box-footer box-comments">

            </div>

          </div>
    ';


    echo"
          <script>
              $('#portada').attr('style','background: url(".str_replace('../', '', $rutasmall).") no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;');
          </script>
    ";


    $conexion = '';
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}

// Sacamos la informacion basica del usaurio, permalink, nombre y apellido
function datapercommentuser(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE id = :id LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      exit();
    }else{
       foreach ($rstl as $key){
         $datauser = $key['permalink'].'|'.$key['nombre'].'|'.$key['apellido'];
       }
       return $datauser;
    }

    $conexion = '';

}

// Saber de quien es el post
function knowthispostuserid($post){
   
    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT usuario FROM '.SSPREFIX.'posts WHERE id = :id LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $post ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    foreach ($rstl as $key){
       $idpostuser = $key['usuario'];
       return $idpostuser;
    }
}


// Sacar los comentarios
function postercomments($comment,$post){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $datesecond = date('Y-m-d h:i:s');

    // Limitamos las publicaciones a tan solo 1000 caracteres
    $postparse = substr($comment, 0,1000);

    // Filtramos para evitar XSS Injection
    $filtro = new InputFilter();
    $finalpost = $filtro->process($postparse);

    // Si el resultado final de limpiar el texto de comentario
    // en caso de que solo sea codigo o intentos de XSS
    // revisamos, si esta vacio simplemente no se inserta :)
    if (empty($finalpost)){
       exit();
    }

    if (ctype_space($finalpost)){
       exit();
    }

    if (is_null($finalpost)){
       exit();
    }


    // Vaciamos todo a nuestra base de datos
    $SQL = 'INSERT INTO '.SSPREFIX.'comments (comentario, post, usuario, fecha) VALUES (:comentario, :post, :usuario, :fecha)';
    $stn = $conexion->prepare($SQL);                                  
    $stn -> bindParam(':post',$post,PDO::PARAM_INT);
    $stn -> bindParam(':fecha',$datesecond,PDO::PARAM_STR);
    $stn -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
    $stn -> bindParam(':comentario',$finalpost,PDO::PARAM_INT);
    $stn ->execute(); 
    $thecommentid = $conexion -> lastInsertId();

    // imagen de perfil 
    $profileimg = userprofile($_SESSION['ssid']);

    // Datos del usuario
    $userdatacomment = datapercommentuser();

    // Hacemos explode a los datos
    $explodedata = explode("|", $userdatacomment);


    // Para las notificaciones
    // Primero sacamos a quien le pertenece el post
    $dequienes = knowthispostuserid($post);

    // Luego hacemos un if para canalizar si hay o no notificacion
    if ($dequienes == $_SESSION['ssid']){
    }
    else{
       $tipontf = 1;
       $leidonew = 1;
       $NTF = 'INSERT INTO '.SSPREFIX.'notifications (para, de, tipo, post, leido ,fecha) VALUES (:para, :de, :tipo, :post, :leido, :fecha)';
       $ntfstn = $conexion -> prepare($NTF);
       $ntfstn -> bindParam(':para',$dequienes,PDO::PARAM_INT);
       $ntfstn -> bindParam(':de',$_SESSION['ssid'],PDO::PARAM_INT);
       $ntfstn -> bindParam(':tipo',$tipontf,PDO::PARAM_INT);
       $ntfstn -> bindParam(':post',$post,PDO::PARAM_INT);
       $ntfstn -> bindParam(':leido',$leidonew,PDO::PARAM_INT);
       $ntfstn -> bindParam(':fecha',$datesecond,PDO::PARAM_STR);
       $ntfstn -> execute();
    }


    echo'
       <div id="thecomment'.$thecommentid.'" class="box-comment">
        <!-- User image -->
        <img class="img-circle img-sm user" src="'.$profileimg.'">

        <div class="comment-text">
               <span class="username">
                 <a href="profile.php?'.$explodedata[0].'">'.$explodedata[1].' '.$explodedata[2].' '.fechastringcomment($datesecond).'</a>
                '.checkdelcomment($_SESSION['ssid'],$thecommentid).'
              </span><!-- /.username -->
            '.emoticons($finalpost).'
        </div>
        <!-- /.comment-text -->
      </div>
    ';

    $conexion = '';
}


// Borrar comentario administrador
function deletecommenta($id){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $dislikesql = 'DELETE FROM '.SSPREFIX.'comments WHERE id = :id';
      $dislikesql = $conexion -> prepare($dislikesql);
      $dislikesql -> bindParam(':id',$id,PDO::PARAM_INT);
      $dislikesql -> execute();

}


// Borrar comentario administrador
function deletecommentu($id){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $dislikesql = 'DELETE FROM '.SSPREFIX.'comments WHERE id = :id AND usuario = :usuario';
      $dislikesql = $conexion -> prepare($dislikesql);
      $dislikesql -> bindParam(':id',$id,PDO::PARAM_INT);
      $dislikesql -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
      $dislikesql -> execute();

}


function checkconversationlist($profile){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT * FROM '.SSPREFIX.'conversation WHERE ( de = :para OR para = :para )';
      $stn = $conexion -> prepare($SQL);
      //$stn -> bindParam(':para', $profile ,PDO::PARAM_INT);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();

      $dataname = gettheusernamepostperid($profile);

      if (empty($rstl)){
          echo '<a  class="chatdatalink btn btn-sm btn-default" data-chat="1" data-name="'.$dataname.'"><i class="fa fa-envelope-o"></i> Mensaje</a>';
      }else{
        foreach ($rstl as $key){
          $themessageid = $key['id'];
          echo '<a  class="chatdatalink btn btn-sm btn-default" data-chat="'.$themessageid.'" data-name="'.$dataname.'"><i class="fa fa-envelope-o"></i> Mensaje</a>';
        }

      }

}


function conversationlst(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.id AS usuarioid, '.SSPREFIX.'conversation.para, '.SSPREFIX.'usuarios.permalink, '.SSPREFIX.'conversation.fecha, '.SSPREFIX.'conversation.id AS converid FROM '.SSPREFIX.'conversation INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'conversation.de WHERE ( '.SSPREFIX.'conversation.de = :para OR '.SSPREFIX.'conversation.para = :para ) ORDER BY '.SSPREFIX.'conversation.fecha DESC LIMIT 10';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){

        // Fecha
        $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['fecha'])));

        // Para saber a quien se la envias xD
        if ($key['para'] == $_SESSION['ssid']) {
          $dataname = gettheusernamepostperid($key['usuarioid']);
          // imagen de perfil 
          $profileimg = userprofile($key['usuarioid']);
        }else{
          $dataname = gettheusernamepostperid($key['para']);
          // imagen de perfil 
          $profileimg = userprofile($key['para']);
        }


        echo'
         <li><!-- start message -->
            <a class="chatdatalink" data-chat ="'.$key['converid'].'" data-name="'.$dataname.'" >
              <div class="pull-left">
                <!-- User Image -->
                <img src="'.$profileimg.'" class="img-circle">
              </div>
              <!-- Message title and timestamp -->
              <h4>
                 '.$dataname.'
                 <small><i class="fa fa-clock-o"></i> '.$fecha.'</small>
              </h4>
              <!-- The message -->
              <p>'.lastmessage($key['converid']).'</p>
            </a>
          </li>
          ';

        }
    }
}





function conversationlstbig(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.id AS usuarioid, '.SSPREFIX.'conversation.para, '.SSPREFIX.'usuarios.permalink, '.SSPREFIX.'conversation.fecha, '.SSPREFIX.'conversation.id AS converid FROM '.SSPREFIX.'conversation INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'conversation.de WHERE ( '.SSPREFIX.'conversation.de = :para OR '.SSPREFIX.'conversation.para = :para ) ORDER BY '.SSPREFIX.'conversation.fecha DESC LIMIT 10';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){

        // Fecha
        $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['fecha'])));

        // Para saber a quien se la envias xD
        if ($key['para'] == $_SESSION['ssid']) {
          $dataname = gettheusernamepostperid($key['usuarioid']);
          // imagen de perfil 
          $profileimg = userprofile($key['usuarioid']);
        }else{
          $dataname = gettheusernamepostperid($key['para']);
          // imagen de perfil 
          $profileimg = userprofile($key['para']);
        }


        echo'
         <li><!-- start message -->
            <a class="chatdatalinkfull" data-chat ="'.$key['converid'].'" data-name="'.$dataname.'" >
              <div class="pull-left">
                <!-- User Image -->
                <img src="'.$profileimg.'" class="img-circle">
              </div>
              <!-- Message title and timestamp -->
              <h4>
                 '.$dataname.'
                 <small><i class="fa fa-clock-o"></i> '.$fecha.'</small>
              </h4>
              <!-- The message -->
              <p>'.lastmessage($key['converid']).'</p>
            </a>
          </li>
          ';

        }
    }
}





function lastmessage($conversation){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT * FROM '.SSPREFIX.'conversationreply WHERE conversation = :conversation ORDER BY fecha DESC LIMIT 1';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':conversation', $conversation ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){

            $data = substr($key['mensaje'], 0,35).'...';
            return $data;
        }
    }
}


function getchatconver($conver){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();
      
      $SQL = 'SELECT * FROM (SELECT * FROM '.SSPREFIX.'conversationreply WHERE conversation = :conversation ORDER BY fecha DESC LIMIT 25) T ORDER BY fecha ASC';

      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':conversation', $conver ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      $countrows = $stn -> rowCount();
      if (empty($rstl)){
      }else{



        // Tamaño de pagina
        $resultados = 25;
        // total parginado
        $totalmenssagesconver = ceil($countrows / $resultados);
            
        echo'<p></p><button  id="getconverbtn2" onclick="loadmorechatmessages('.$conver.',2)" class="getmoreconver btn btn-xs btn-block btn-success">Cargar Conversaciones Anteriores</button>
            ';

        foreach ($rstl as $key){
            

            $fecha = fechastringchat($key['fecha']);

            if ($key['usuario'] == $_SESSION['ssid']) {

                echo'
                <div class="direct-chat-msg right">
                  <!-- /.direct-chat-info -->
                  <div class="direct-chat-text" title="'.$fecha.'">
                    '.emoticons($key['mensaje']).'
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                ';
            }else{
                 
                echo'
                 <div class="direct-chat-msg">
                  <!-- /.direct-chat-info -->
                  <div class="direct-chat-text" title="'.$fecha.'">
                    '.emoticons($key['mensaje']).'
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                ';
            }
        }
    }
}



// Para sacar la linea de mensajes
function getchatconvermore($conver,$pagina){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $resultados = 25;
      $inicial = ($pagina - 1) * $resultados;

      //$SQL = 'SELECT * FROM '.SSPREFIX.'conversationreply WHERE conversation = :conversation ORDER BY id ASC LIMIT '.$inicial.', 25';

      $SQL = 'SELECT * FROM (SELECT * FROM '.SSPREFIX.'conversationreply  WHERE conversation = :conversation  ORDER BY fecha DESC LIMIT '.$inicial.',25) T ORDER BY fecha ASC';

      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':conversation', $conver ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      $countrows = $stn -> rowCount();
      if (empty($rstl)){
      }else{



      // total parginado
      $totalmenssagesconver = ceil($countrows / $resultados);
      $finalcount = $pagina + 1;

      echo'<p></p><button id="getconverbtn'.$finalcount.'" onclick="loadmorechatmessages('.$conver.','.$finalcount.')" class="btn btn-xs btn-block btn-success">Cargar Conversaciones Anteriores</button>';



        foreach ($rstl as $key){
            

            $fecha = fechastringchat($key['fecha']);

            if ($key['usuario'] == $_SESSION['ssid']) {

                echo'
                <div class="direct-chat-msg right">
                  <!-- /.direct-chat-info -->
                  <div class="direct-chat-text" title="'.$fecha.'">
                    '.emoticons($key['mensaje']).'
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                ';
            }else{
                 
                echo'
                 <div class="direct-chat-msg">
                  <!-- /.direct-chat-info -->
                  <div class="direct-chat-text" title="'.$fecha.'">
                    '.emoticons($key['mensaje']).'
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                ';
            }
        }
    }
}





function insertchatmessage($message,$chat,$profilegetnew){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      
      if (empty($message) || empty($chat)){
        return;
      }

      if (ctype_space($message) || ctype_space($chat)){
        return;
      }

      // Filtramos para evitar XSS Injection
      $filtro = new InputFilter();
      $finalpost = $filtro->process($message);

      // Si el resultado final de limpiar el texto de comentario
      // en caso de que solo sea codigo o intentos de XSS
      // revisamos, si esta vacio simplemente no se inserta :)
      if (empty($finalpost)){
         exit();
      }

      if (ctype_space($finalpost)){
         exit();
      }

      if (is_null($finalpost)){
         exit();
      }

       
      // Fecha
      $dater = date('Y-m-d h:i:s');

      // Visto
      $visto = 1;

      // si la conversacion es nueva vamos a cambiar varias cosas
      // mas que nada por la necesidad de que la ventana de char sirva
      // para integrar una conversacion, sin la necesidad de usar un modal
      // u otro tipo de cosas, es por eso que separaremos las cosas
      if ($chat == 1){
        
        // Creamos una nueva conversacion
        $fechaNewCV = date('Y-m-d h:i:s');
        $newCv = 'INSERT INTO '.SSPREFIX.'conversation (de,para,fecha) VALUES (:de,:para,:fecha)';
        $newCvstn = $conexion -> prepare($newCv);
        $newCvstn -> bindParam(':de',$_SESSION['ssid'],PDO::PARAM_INT);
        $newCvstn -> bindParam(':para',$profilegetnew,PDO::PARAM_INT);
        $newCvstn -> bindParam(':fecha',$fechaNewCV,PDO::PARAM_STR);
        $newCvstn -> execute();
        $theNewCVId = $conexion -> lastInsertId();

        // Insertar en Base de datos
        $SQL = 'INSERT INTO '.SSPREFIX.'conversationreply (conversation, mensaje, usuario, fecha, visto) VALUES (:conversation, :mensaje, :usuario, :fecha, :visto)';
        $stn = $conexion -> prepare($SQL);
        $stn -> bindParam(':conversation', $theNewCVId ,PDO::PARAM_INT);
        $stn -> bindParam(':mensaje', $finalpost ,PDO::PARAM_STR);
        $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
        $stn -> bindParam(':fecha', $dater ,PDO::PARAM_STR);
        $stn -> bindParam(':visto', $visto ,PDO::PARAM_STR);
        $stn -> execute();

        $fechaparse = fechastringchat($dater);
        echo'
        <div class="direct-chat-msg right">
          <!-- /.direct-chat-info -->
          <div class="direct-chat-text" title="'.$fechaparse.'">
            '.emoticons($finalpost).'
          </div>
          <!-- /.direct-chat-text -->
        </div>
        <script>
            $(".chatdatalink").attr("data-chat", "'.$theNewCVId.'");
            $("#chatfrm1").attr("data-idfrmchat", "'.$theNewCVId.'");
            $("#chatfrm1").attr("id", "chatfrm'.$theNewCVId.'");
            $(".chatdatalink").click();
        </script>
        ';

      }else{

      // Insertar en Base de datos
      $SQL = 'INSERT INTO '.SSPREFIX.'conversationreply (conversation, mensaje, usuario, fecha, visto) VALUES (:conversation, :mensaje, :usuario, :fecha, :visto)';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':conversation', $chat ,PDO::PARAM_INT);
      $stn -> bindParam(':mensaje', $finalpost ,PDO::PARAM_STR);
      $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> bindParam(':fecha', $dater ,PDO::PARAM_STR);
      $stn -> bindParam(':visto', $visto ,PDO::PARAM_STR);
      $stn -> execute();

      $fechaparse = fechastringchat($dater);
      echo'
      <div class="direct-chat-msg right">
        <!-- /.direct-chat-info -->
        <div class="direct-chat-text" title="'.$fechaparse.'">
          '.emoticons($finalpost).'
        </div>
        <!-- /.direct-chat-text -->
      </div>
      ';

    }

}



// Para las notificaciones
function checknotifications(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'notifications.tipo, '.SSPREFIX.'notifications.id AS notifid, '.SSPREFIX.'notifications.leido  FROM '.SSPREFIX.'notifications INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'notifications.de = '.SSPREFIX.'usuarios.id INNER JOIN '.SSPREFIX.'posts ON '.SSPREFIX.'notifications.post = '.SSPREFIX.'posts.id WHERE '.SSPREFIX.'notifications.para = :para ORDER BY '.SSPREFIX.'notifications.fecha DESC LIMIT 20';

      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){


          if ($key['leido'] == 1){
            $theclassreadnotification = 'noreadnotification';
            $thedatanotif = 'data-notif="'.$key['notifid'].'"';
          }else{
            $theclassreadnotification = '';
          }


          if ($key['tipo'] == 1){
            
             echo'
                    <li><!-- start notification -->
                      <a href="post.php?'.$key['permalink'].'" class="'.$theclassreadnotification.'" '.$thedatanotif.'>
                        <i class="fa fa-comment-o text-yellow"></i> <b class="text-muted">'.$key['nombre'].' '.$key['apellido'].'</b> comento en tu publicación
                      </a>
                    </li>
             ';

          }elseif ($key['tipo'] == 2){
            
             echo'
                    <li><!-- start notification -->
                      <a href="post.php?'.$key['permalink'].'" class="'.$theclassreadnotification.'" '.$thedatanotif.'>
                        <i class="fa fa-thumbs-o-up text-aqua"></i> <b class="text-muted">'.$key['nombre'].' '.$key['apellido'].'</b> le gusta tu publicación
                      </a>
                    </li>
             ';

          }

        }
      }
}



function noreadnotifications(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'notifications WHERE leido = 1 AND para = :para ';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    $cuantos = $stn -> rowCount();
    if (empty($rstl)){
    }else{
      echo '<span class="notificationnumber animated infinite flash">'.$cuantos.'</span>'; 
    }
}



function knowthelikeajx(){

echo'
<!-- Modal -->
<div class="modal fade modal-primary animated fadeIn" id="thelikesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="likemodalbox" class="modal-dialog" role="document" style="margin-top: 250px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-up"></i> Me gusta</h4>
      </div>
      <div id="boxuserslike" class="modal-body text-center">
        <div class="loader-inner line-scale-party"><div></div><div></div><div></div><div></div></div>
      </div>
    </div>
  </div>
</div>
';

}


function boxuserslike($post){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT '.SSPREFIX.'usuarios.id, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink FROM '.SSPREFIX.'likepost INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'likepost.usuario = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'likepost.post = :post ORDER BY '.SSPREFIX.'likepost.id DESC';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':post', $post ,PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
        // imagen de perfil 
        $profileimg = userprofile($key['id']);

        echo '
               <div class="item itemknowthelike">
                  <a href="profile.php?'.$key['permalink'].'" class="name"><img width="50" src="'.$profileimg.'">'.$key['nombre'].' '.$key['apellido'].'</a>
              </div>
        ';
      }
    }

}


// Sacamos las extensiones permitidas para los archivos que se suben
function gettheextattachment(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT archiveextensions FROM '.SSPREFIX.'socialconfig WHERE id = 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
        $fileext = $key['archiveextensions'];
        return $fileext;
      }
    }
}


function validextlist(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT archiveextensions FROM '.SSPREFIX.'socialconfig WHERE id = 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
         echo '<b>'.str_replace('|', ' / ', $key['archiveextensions']).'</b>';
      }
    }

}


function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


// Para subir un archivo
function attachmentfiles($file,$description){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // Primero el Año
    $theyear = date('Y');

    // Ahora el Mes 
    $themonth = date ('m');

    // Ahora usamos la sesion del usuario para su respectiva carpeta
    $theuser = $_SESSION['ssid'];

    // Creamos un alfanumerico aleatorio.
    $characters = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < 60; $i++) {
     $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Tomamos la fecha y hora con segundos
    $fechaseconds = date('Y-m-d h:i:s');
    $fechanormal =  date('Y-m-d');

    // Nuevo nombre del Archivo
    $thenewname = sha1($fechaseconds.$theuser.$string);

    // Obtenemos la extension
    $fileext = new SplFileInfo($file);
    $getextension = $fileext->getExtension();

    // convertimos extension a minusculas
    $extension = strtolower($getextension);

    //comprobamos si el archivo ha subido y lo movemos a una su respectiva ruta
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"../attachments/".$theuser."/".$theyear."/".$themonth."/".$thenewname.".".$extension)){
    }  

    // Creamos ruta del temporal
    $temporal = "../attachments/".$theuser."/".$theyear."/".$themonth."/".$thenewname.".".$extension;


    // Creamos el permalink de la publicacion
    $permalink = sha1($string.$fechaseconds);


    // Limitamos las publicaciones a tan solo 1000 caracteres
    $postparse = substr($description, 0,1000);

    // Filtramos para evitar XSS Injection
    $filtro = new InputFilter();
    $finalpost = $filtro->process($postparse);

    // Tamaño del archivo
    $filesize = $_FILES['archivo']['size'];

    // Nombre del Archivo
    $filename = $_FILES['archivo']['name'];

    // Revisamos si el resultado es vacio para no tener que postearlo
    if (empty($finalpost)){
       exit();
    }

    if (is_null($finalpost)){
       exit();
    }

    // Hacemos el registro del Archivo
    $FileAttch = 'INSERT INTO '.SSPREFIX.'attachment (ruta, nombre, usuario, fecha, ext, peso, permalink) VALUES (:ruta, :nombre, :usuario, :fecha, :ext, :peso, :permalink)';
    $stnfile = $conexion -> prepare($FileAttch);
    $stnfile -> bindParam(':ruta', $temporal ,PDO::PARAM_STR);
    $stnfile -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_STR);
    $stnfile -> bindParam(':nombre', $filename ,PDO::PARAM_INT);
    $stnfile -> bindParam(':fecha', $fechaseconds ,PDO::PARAM_STR);
    $stnfile -> bindParam(':ext', $extension ,PDO::PARAM_STR);
    $stnfile -> bindParam(':peso', $filesize ,PDO::PARAM_STR);
    $stnfile -> bindParam(':permalink', $thenewname ,PDO::PARAM_STR);
    $stnfile -> execute();
    $lastidfile = $conexion -> lastInsertId();

    // Post con archivo
    $thepostpostarchive = $lastidfile.'|'.$finalpost;

    // Como es un post de archivo es 4
    $tipo = 4;

    $SQL = 'INSERT INTO '.SSPREFIX.'posts (post, usuario, permalink, fecha, tipo) VALUES (:post, :usuario, :permalink, :fecha, :tipo)';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':post', $thepostpostarchive ,PDO::PARAM_STR);
    $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $stn -> bindParam(':permalink', $permalink ,PDO::PARAM_STR);
    $stn -> bindParam(':fecha', $fechaseconds ,PDO::PARAM_STR);
    $stn -> bindParam(':tipo', $tipo ,PDO::PARAM_INT);
    $stn -> execute();
    $lastid = $conexion -> lastInsertId();

    // imagen de perfil 
    $profileimg = userprofile($_SESSION['ssid']);
    
    // Fecha
    $fechastronger = fechastring($fechanormal,$permalink);

    echo'
        <div id="post-public'.$lastid.'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.gettheusernamepost().'">
                <span class="username"><a href="profile.php?leanserwebmaster">'.gettheusernamepost().'</a></span>
                '.$fechastronger.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$lastid.'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

                $postexplode = explode('|', $thepostpostarchive);
                getattachblock($postexplode[0],$postexplode[1]);

         echo'<!-- Social sharing buttons -->
              <button id="liker'.$lastid.'" type="button" data-target="'.$lastid.'" onclick="thelikeloadtimeclick('.$lastid.');" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Me gusta</button>
              <span id="likecomment'.$lastid.'" class="pull-right text-muted">
                 
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$lastid.'" id="commentfrm'.$lastid.'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$profileimg.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$lastid.'" class="box-footer box-comments">

            </div>

          </div>
    ';


    $conexion = '';



}



function downloadarchive($permalink){

     // conexion de base de datos
     $conexion = Conexion::singleton_conexion();

     $SQL = 'SELECT * FROM '.SSPREFIX.'attachment WHERE permalink = :permalink LIMIT 1';
     $stn = $conexion -> prepare($SQL);
     $stn -> bindParam(':permalink', $permalink ,PDO::PARAM_STR);
     $stn -> execute();
     $rstl = $stn -> fetchAll();
     if (empty($rstl)){
       header('Location: 404.php');
     }else{
       foreach ($rstl as $key){
          $ruta = str_replace('../', '', $key['ruta']);
          $nombre = $key['nombre'];
       }
     }

     header("Content-type: application/octet-stream"); 
     header("Content-Type: application/force-download"); 
     header("Content-Disposition: attachment; filename=\"$nombre\"\n"); readfile($ruta); 


}





// Tomamos los ultimos 6 post
function takepostperpermalink($permalink){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.permalink = :permalink ORDER BY '.SSPREFIX.'posts.fecha DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':permalink' , $permalink, PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttake($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklike($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               commentsajx($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}


function theposttitlepage($permalink){

     // conexion de base de datos
     $conexion = Conexion::singleton_conexion();

     $SQL = 'SELECT * FROM '.SSPREFIX.'posts WHERE permalink = :permalink LIMIT 1';
     $stn = $conexion -> prepare($SQL);
     $stn -> bindParam(':permalink', $permalink ,PDO::PARAM_STR);
     $stn -> execute();
     $rstl = $stn -> fetchAll();
     if (empty($rstl)){
       header('Location: 404.php');
     }else{
       foreach ($rstl as $key){
          
          if ($key['tipo'] == 1){
            return "Imagen de Perfil";
          }elseif ($key['tipo'] == 2){
            return substr($key['post'], 0,20).'...';
          }elseif ($key['tipo'] == 3){
            return "Imagen de Portada";
          }elseif ($key['tipo'] == 4) {
            $explodedata = explode('|', $key['post']);
            return substr($explodedata[1], 0,20).'...';
          }

       }
    }
}



// Mis imagenes
function mypicturespage(){

     // conexion de base de datos
     $conexion = Conexion::singleton_conexion();

     $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario ORDER BY id DESC';
     $stn = $conexion -> prepare($SQL);
     $stn -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
     $stn -> execute();
     $rstl = $stn -> fetchAll();
     if (empty($rstl)){
     }else{
       foreach ($rstl as $key){
          
          if ($key['type'] == 1){
           echo '
           <a class="showthepictureitem" data-toggle="modal" data-id="'.$key['id'].'" data-target="#myModal">
             <img width="128" src="'.str_replace('normal', 'small', $key['ruta']).'" >
           </a>
           ';
          }else{
           echo '
           <a class="showthepictureitem" data-toggle="modal" data-id="'.$key['id'].'" data-target="#myModal">
             <img width="400" src="'.str_replace('normal', 'small', $key['ruta']).'" >
           </a>
           ';
          }

       }
    }
}


// Imagenes del usuario
function mypicturespageperid($iduser){

     // conexion de base de datos
     $conexion = Conexion::singleton_conexion();

     $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE usuario = :usuario ORDER BY id DESC';
     $stn = $conexion -> prepare($SQL);
     $stn -> bindParam(':usuario', $iduser ,PDO::PARAM_INT);
     $stn -> execute();
     $rstl = $stn -> fetchAll();
     if (empty($rstl)){
       exit();
     }else{
       foreach ($rstl as $key){
          
          if ($key['type'] == 1){
           echo '
           <a class="showthepictureitem" data-toggle="modal" data-id="'.$key['id'].'" data-target="#myModal">
             <img width="128" src="'.str_replace('normal', 'small', $key['ruta']).'" >
           </a>
           ';
          }else{
           echo '
           <a class="showthepictureitem" data-toggle="modal" data-id="'.$key['id'].'" data-target="#myModal">
             <img width="400" src="'.str_replace('normal', 'small', $key['ruta']).'" >
           </a>
           ';
          }

       }
    }
}




function knowtimelinepost(){

  $conexion = Conexion::singleton_conexion();

  $RowCount = 'SELECT * FROM '.SSPREFIX.'posts WHERE usuario = :usuario';
  $counsentence = $conexion -> prepare($RowCount);
  $counsentence -> bindParam(':usuario',$_SESSION['ssid'],PDO::PARAM_INT);
  $counsentence -> execute();
  $cuantos = $counsentence -> rowCount();

  // Tamaño de pagina
  $resultados = 6;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // Total de paginas
  echo'
     var initial = 1;
     var totalposts = '.$totalpaginas.';
  ';
}




function knowtimelinepostprofile($idprofile){

  $conexion = Conexion::singleton_conexion();

  $RowCount = 'SELECT * FROM '.SSPREFIX.'posts WHERE usuario = :usuario';
  $counsentence = $conexion -> prepare($RowCount);
  $counsentence -> bindParam(':usuario',$idprofile,PDO::PARAM_INT);
  $counsentence -> execute();
  $cuantos = $counsentence -> rowCount();

  // Tamaño de pagina
  $resultados = 6;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // Total de paginas
  echo'
     var initialprofile = 1;
     var totalpostsprofile = '.$totalpaginas.';
     var tokenprofile = '.$idprofile.';
  ';
}

//////// Load pots bottom mouse
// Tomamos los ultimos 6 post
function ajaxloadpst($page){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $resultados = 6;
    $inicial = ($page - 1) * $resultados;

    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario = :usuario ORDER BY '.SSPREFIX.'posts.id DESC LIMIT '.$inicial.',6';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario' , $_SESSION['ssid'], PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$key['postingid'].'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttakeloader($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklikeloadtime($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}


// Tomamos los ultimos 6 post
function ajaxloadpstprofile($page,$idprofile){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $resultados = 6;
    $inicial = ($page - 1) * $resultados;

    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario = :usuario ORDER BY '.SSPREFIX.'posts.id DESC LIMIT '.$inicial.',6';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario' , $idprofile, PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttakeloader($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklikeloadtime($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}



function takepostperidmodal($ruta,$idpost){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();


    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.id = :id ORDER BY '.SSPREFIX.'posts.fecha DESC LIMIT 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id' , $idpost, PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="thepicturediv" class="col-sm-8 text-center" style="background:#000;">
           <img src="'.$ruta.'" style="width:100%;" >
        </div>

        <div id="thecomentsdiv" class="col-sm-4">
        

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';



              echo'<!-- Social sharing buttons -->
              ';

              checklikeloadtime($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               commentsajx($key['postingid'],$key['permalink']);

             echo'</div>
          </div>
</div>
        ';

      }
    }


    $conexion = '';

}


function showimagemodal($data){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // SQL
    $SQL = 'SELECT * FROM '.SSPREFIX.'imagespost WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $data , PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
    }else{
      foreach ($rstl as $key){
         $tipo = $key['type'];
         $ruta = $key['ruta'];
      }
    }


    // SQL del post
    $SQLPost = 'SELECT * FROM  '.SSPREFIX.'posts WHERE post = :post AND tipo = :tipo LIMIT 1';
    $stnpst = $conexion -> prepare($SQLPost);
    $stnpst -> bindParam(':post',$data,PDO::PARAM_INT);
    $stnpst -> bindParam(':tipo',$tipo,PDO::PARAM_INT);
    $stnpst -> execute();
    $stnrstl = $stnpst -> fetchAll();
    if (empty($stnrstl)){
    }else{
      foreach ($stnrstl as $key){
        $theidpost = $key['id'];
      }
    } 
    
    takepostperidmodal($ruta,$theidpost);

    $conexion = '';

}


function checkthefollow($user){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // SQL
    $SQL = 'SELECT * FROM '.SSPREFIX.'followers WHERE follow = :follow AND fromthe = :fromthe';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':fromthe', $_SESSION['ssid'] , PDO::PARAM_INT);
    $stn -> bindParam(':follow', $user , PDO::PARAM_INT);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      echo'<button data-follow="'.$user.'" data-item="1" class="clickfollow btn btn-xs btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Seguir</button>';
    }else{
      echo'<button data-follow="'.$user.'" data-item="2" class="clickfollow btn btn-xs btn-warning"><i class="fa fa-user-times" aria-hidden="true"></i> Dejar de Seguir</button>';
    }
}



function follower($follow){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQLFollow = 'SELECT * FROM '.SSPREFIX.'followers WHERE follow = :follow AND fromthe = :fromthe';
    $stnfollow = $conexion -> prepare($SQLFollow);
    $stnfollow -> bindParam(':fromthe', $_SESSION['ssid'] , PDO::PARAM_INT);
    $stnfollow -> bindParam(':follow', $follow , PDO::PARAM_INT);
    $stnfollow -> execute();
    $rslfollow = $stnfollow -> fetchAll();
    if (empty($rslfollow)){

      # Insertamos entrada
      $SQL = 'INSERT INTO '.SSPREFIX.'followers(fromthe,follow) VALUES (:fromthe,:follow)';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':fromthe', $_SESSION['ssid'] , PDO::PARAM_INT);
      $stn -> bindParam(':follow', $follow , PDO::PARAM_INT);
      $stn -> execute();
      echo 1;

    }else{

      # Si ya existe la eliminamos
      $SQL = 'DELETE FROM '.SSPREFIX.'followers WHERE follow = :follow AND fromthe = :fromthe';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':fromthe', $_SESSION['ssid'] , PDO::PARAM_INT);
      $stn -> bindParam(':follow', $follow , PDO::PARAM_INT);
      $stn -> execute();
      echo 2;

    }

}


function GetAge($dob){ 
        $dob=explode("-",$dob); 
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[0]; 
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
        $age--; 
        return $age; 
}

function congifurationmail(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'socialconfig WHERE id = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['smtp'].'|'.$key['port'].'|'.$key['fromname'].'|'.$key['mail'].'|'.$key['password'].'|'.$key['url'].'|'.$key['messagemail'];
        return $data;
      }
   }
}



// Con esta funcion sabemos si es requerido el registro por medio de email
function checkregisterrequired(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM '.SSPREFIX.'socialconfig WHERE id = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['requiredemail'];
        return $data;
      }
   }
}




function register($nombre,$apellido,$email,$password,$fecha, $type_user, $type_equipo, $gender, $position, $localidad){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();
  

  $nombrecheck = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $nombre);
  $apellidocheck = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $apellido);
  $emailcheck = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);

  $edad = GetAge($fecha);
  if ($edad < 18){
     header('Location: register.php?noage');
     exit();
  }


  $filtrar = new InputFilter();

  $finalname = $filtrar->process($nombre);
  $finalapellido = $filtrar->process($apellido);
  $finalemail = $filtrar->process($email);

  if (empty($finalname)){
     header('Location: register.php?error');
  }

  if (empty($finalapellido)) {
     header('Location: register.php?error');
  }

  if (empty($finalemail)) {
     header('Location: register.php?error');
  }


        $regcrypt = sha1(SALT.$password.PEPER);
        $regdate = date('Y-m-d');
        $permalink = substr(sha1($email.$regdate), 0,15);


        // Checamos si es necesario enviar el email
        $requiredsendmail = checkregisterrequired();


        $Check = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE email = :email';
        $checksente = $conexion -> prepare($Check);
        $checksente -> bindParam(':email',$email,PDO::PARAM_STR);
        $checksente -> execute();
        $resultcheck = $checksente -> fetchAll();
        if(empty($resultcheck)){
        #------------------------------------------------------------
        $rankreginew = 1;
        // Registro de nuevo usuario
        $SQLReg = 'INSERT INTO '.SSPREFIX.'usuarios (nombre, apellido, email, password, nacimiento, registro, permalink, rango, activo, type_user, type_equipo, gender, position, localidad) VALUES (:nombre, :apellido, :email, :password, :nacimiento, :registro, :permalink, :rango, :activo, :type_user, :type_equipo, :gender, :position, :localidad)';

        $sentence = $conexion -> prepare($SQLReg);
        $sentence -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $sentence -> bindParam(':apellido',$apellido,PDO::PARAM_STR);
        $sentence -> bindParam(':email',$email,PDO::PARAM_STR);
        $sentence -> bindParam(':password',$regcrypt,PDO::PARAM_STR);
        $sentence -> bindParam(':permalink',$permalink,PDO::PARAM_STR);
        $sentence -> bindParam(':activo',$requiredsendmail,PDO::PARAM_INT);
        $sentence -> bindParam(':rango',$rankreginew,PDO::PARAM_INT);
        $sentence -> bindParam(':registro',$regdate,PDO::PARAM_INT);
        $sentence -> bindParam(':nacimiento',$fecha,PDO::PARAM_STR);

        $sentence -> bindParam(':type_user',$type_user,PDO::PARAM_STR);
        $sentence -> bindParam(':type_equipo',$type_equipo,PDO::PARAM_STR);
        $sentence -> bindParam(':gender',$gender,PDO::PARAM_STR);
        $sentence -> bindParam(':position',$position,PDO::PARAM_STR);
        $sentence -> bindParam(':localidad',$localidad,PDO::PARAM_STR);

        $sentence -> execute();
        $lastiduser = $conexion -> lastInsertId();


        // Insertar para informacion del usuario
        $desripcionrow = 'Aqui puedes editar tu información :)';
        $emailrowshow = 1;
        $infosentenceSQL = 'INSERT INTO '.SSPREFIX.'information (usuario, description, emailshow) VALUES (:usuario, :description, :emailshow)';
        $infosentence = $conexion -> prepare($infosentenceSQL);
        $infosentence -> bindParam(':usuario',$lastiduser,PDO::PARAM_STR);
        $infosentence -> bindParam(':description',$desripcionrow,PDO::PARAM_STR);
        $infosentence -> bindParam(':emailshow',$emailrowshow,PDO::PARAM_STR);
        $infosentence -> execute();




        
        if ($requiredsendmail == 1){


        // Insertar para Verificar
        $mailtoken = sha1($email.TOKENMAIL);
        $ver = 'INSERT INTO '.SSPREFIX.'verify (token,email,fecha) VALUES (:token,:email,:fecha)';
        $versentence = $conexion -> prepare($ver);
        $versentence -> bindParam(':token',$mailtoken,PDO::PARAM_STR);
        $versentence -> bindParam(':email',$email,PDO::PARAM_STR);
        $versentence -> bindParam(':fecha',$regdate,PDO::PARAM_STR);
        $versentence -> execute();
        
        themailsendphp($email,$mailtoken);


        }
   
         header('Location: register.php?success');

         #------------------------------------------------------------
         }else{
         #------------------------------------------------------------
           header('Location: register.php?nomail');
         #------------------------------------------------------------  
         }


}




function theinformation($profile){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.email,'.SSPREFIX.'usuarios.apodo, '.SSPREFIX.'information.description, '.SSPREFIX.'information.emailshow FROM '.SSPREFIX.'information INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'information.usuario = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'usuarios.id = :id';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':id', $profile ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      foreach ($rstl as $key){

         if (is_null($key['apodo'])) {
           $apodo = '(Sin Apodo)';
         }else{
           $apodo = $key['apodo'];
         }

         if ($key['emailshow'] == 1) {
           $emailshow = $key['email'];
         }else{
           $emailshow = '(Privado)';
         }

        echo'
            <!-- ### LEFT ### -->
            <div class="col-sm-6 col-xs-12">
              <label><i class="fa fa-user" aria-hidden="true"></i> Nombre:</label>
              <p>'.$key['nombre'].' '.$key['apellido'].'</p>
              <p></p>
              <label><i class="fa fa-user" aria-hidden="true"></i> Apodo:</label>
              <p>'.$apodo.'</p>
              <p></p>
              <label><i class="fa fa-envelope-o" aria-hidden="true"></i> Email:</label>
              <p>'.$emailshow.'</p>
            </div>
            <!-- ### LEFT ### -->

            <!-- ### MAPA ### -->
            <div class="col-sm-6 col-xs-12">
              <label><i class="fa fa-file-text-o" aria-hidden="true"></i> Descripción:</label>
              <p>'.emoticons($key['description']).'</p>
            </div>
            <!-- ### MAPA ### -->
        ';

      }
}


function thefollowersperid($follow){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT '.SSPREFIX.'usuarios.id, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink FROM '.SSPREFIX.'followers INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'followers.fromthe = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'followers.follow = :follow ORDER BY '.SSPREFIX.'followers.id DESC';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> bindParam(':follow', $follow ,PDO::PARAM_INT);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
     echo "";
   }else{
      foreach ($resultados as $key){
        
        // imagen de perfil 
        $profileimg = userprofile($key['id']);

        echo '
              <div class="col-sm-4 text-center">
              <div class="item itemknowthelike" style="text-align:center;float: left;width: 100%;">
                  <a href="profile.php?'.$key['permalink'].'" class="name" style="font-size: 12px;display: block;width: 100%;float: left;text-align: center;">
                      <img style="margin: 0 auto;" width="50" src="'.$profileimg.'">
                      <p>'.$key['nombre'].' '.$key['apellido'].'</p>
                  </a>
              </div>
              </div>
        ';

      }
   }
}



function thefollowers(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT '.SSPREFIX.'usuarios.id, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink FROM '.SSPREFIX.'followers INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'followers.fromthe = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'followers.follow = :follow ORDER BY '.SSPREFIX.'followers.id DESC';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> bindParam(':follow', $_SESSION['ssid'] ,PDO::PARAM_INT);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
     echo "";
   }else{
      foreach ($resultados as $key){
        
        // imagen de perfil 
        $profileimg = userprofile($key['id']);

        echo '
              <div class="col-sm-4 text-center">
              <div class="item itemknowthelike" style="text-align:center;float: left;width: 100%;">
                  <a href="profile.php?'.$key['permalink'].'" class="name" style="font-size: 12px;display: block;width: 100%;float: left;text-align: center;">
                      <img style="margin: 0 auto;" width="50" src="'.$profileimg.'">
                      <p>'.$key['nombre'].' '.$key['apellido'].'</p>
                  </a>
              </div>
              </div>
        ';

      }
   }
}


function thefinderuserperfunction($find){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();


   if ($find == 1){
     echo "Sin Resultados";
   }


   $SQL = 'SELECT
     '.SSPREFIX.'usuarios.id,
     '.SSPREFIX.'usuarios.nombre,
     '.SSPREFIX.'usuarios.apellido,
     '.SSPREFIX.'usuarios.permalink
     FROM '.SSPREFIX.'usuarios
     WHERE ('.SSPREFIX.'usuarios.nombre LIKE "%'.$find.'%" OR '.SSPREFIX.'usuarios.apellido LIKE "%'.$find.'%")
     ORDER BY '.SSPREFIX.'usuarios.id DESC
     ';

   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
     echo "";
   }else{
      foreach ($resultados as $key){
        
        // imagen de perfil 
        $profileimg = userprofile($key['id']);

        echo '
              <div class="col-sm-4 text-center">
              <div class="item itemknowthelike" style="text-align:center;float: left;width: 100%;">
                  <a href="profile.php?'.$key['permalink'].'" class="name" style="font-size: 12px;display: block;width: 100%;float: left;text-align: center;">
                      <img style="margin: 0 auto;" width="50" src="'.$profileimg.'">
                      <p>'.$key['nombre'].' '.$key['apellido'].'</p>
                  </a>
              </div>
              </div>
        ';

      }
   }
}



function conversationlsttable(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.id AS usuarioid, '.SSPREFIX.'conversation.para, '.SSPREFIX.'usuarios.permalink, '.SSPREFIX.'conversation.fecha, '.SSPREFIX.'conversation.id AS converid FROM '.SSPREFIX.'conversation INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'conversation.de WHERE ( '.SSPREFIX.'conversation.de = :para OR '.SSPREFIX.'conversation.para = :para ) ORDER BY '.SSPREFIX.'conversation.fecha DESC';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){

        // Fecha
        $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['fecha'])));

        // Para saber a quien se la envias xD
        if ($key['para'] == $_SESSION['ssid']) {
          $dataname = gettheusernamepostperid($key['usuarioid']);
        }else{
          $dataname = gettheusernamepostperid($key['para']);
        }

        echo'
                  <tr>
                    <td class="mailbox-name"><a class="chatdatalink" data-chat ="'.$key['converid'].'" data-name="'.$dataname.'" >'.$dataname.'</a></td>
                    <td class="mailbox-subject">'.lastmessage($key['converid']).'
                    </td>
                    <td class="mailbox-date"><i class="fa fa-clock-o"></i> '.$fecha.'</td>
                  </tr>
          ';
        }
    }
}


function myseguidores(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM '.SSPREFIX.'followers WHERE follow = :follow';
    $sentence = $conexion -> prepare($SQL);
    $sentence -> bindParam(':follow', $_SESSION['ssid'] ,PDO::PARAM_INT);
    $sentence -> execute();
    $results = $sentence -> fetchAll();
    foreach ($results as $key){
        $thedata .= $key['fromthe'].',';
    }
    return $thedata;
}



// Tomamos los ultimos 6 post
function takemylast6postfeed(){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // los seguidores
    $misseguidores = myseguidores();
    $misfollow = substr($misseguidores, 0,-1);



    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario IN('.$misfollow.') ORDER BY '.SSPREFIX.'posts.id DESC LIMIT 6';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-post="'.$key['postingid'].'" class="eliminarthispost btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttake($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklike($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}


function knowtimelinepostfeed(){

  $conexion = Conexion::singleton_conexion();

  // los seguidores
  $misseguidores = myseguidores();
  $misfollow = substr($misseguidores, 0,-1);

  $RowCount = 'SELECT * FROM '.SSPREFIX.'posts WHERE usuario IN('.$misfollow.')';
  $counsentence = $conexion -> prepare($RowCount);
  $counsentence -> execute();
  $cuantos = $counsentence -> rowCount();

  // Tamaño de pagina
  $resultados = 6;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // Total de paginas
  echo'
     var initialfeed = 1;
     var totalpostsfeed = '.$totalpaginas.';
  ';
}



// Tomamos los ultimos 6 post
function ajaxloadpstfeed($page){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // los seguidores
    $misseguidores = myseguidores();
    $misfollow = substr($misseguidores, 0,-1);

    $resultados = 6;
    $inicial = ($page - 1) * $resultados;

    $SQL = 'SELECT '.SSPREFIX.'usuarios.id AS userid, '.SSPREFIX.'posts.tipo AS posttipo, '.SSPREFIX.'posts.id AS postingid, '.SSPREFIX.'posts.post, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'posts.fecha, '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.permalink AS userperma FROM '.SSPREFIX.'posts INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'usuarios.id = '.SSPREFIX.'posts.usuario WHERE '.SSPREFIX.'posts.usuario IN ('.$misfollow.') ORDER BY '.SSPREFIX.'posts.id DESC LIMIT '.$inicial.',6';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $rstl = $stn -> fetchAll();
    if (empty($rstl)){
      # code...
    }else{
      foreach ($rstl as $key){

        
        // imagen de perfil 
        $profileimg = userprofile($key['userid']);

        // Fecha
        $fecha = fechastring($key['fecha'],$key['permalink']);

        // Imagen de perfil en el post
        $perfilactual = userprofile($_SESSION['ssid']);


        echo'

        <div id="post-public'.$key['postingid'].'" class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.$profileimg.'" alt="'.$key['nombre'].' '.$key['apellido'].'">
                <span class="username"><a href="profile.php?'.$key['userperma'].'">'.$key['nombre'].' '.$key['apellido'].'</a></span>
                '.$fecha.'
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->';

              if ($key['posttipo'] == 1){
                profileimageposttakeloader($key['post']);
              }elseif ($key['posttipo'] == 3) {
                portadaimageposttake($key['post']);
              }elseif ($key['posttipo'] == 4) {

                $postexplode = explode('|', $key['post']);
                getattachblock($postexplode[0],$postexplode[1]);

              }else{
                echo'<p>'.emoticons($key['post']).'</p>';
              }

              echo'<!-- Social sharing buttons -->
              ';

              checklikeloadtime($key['postingid']);

              echo'

              <span id="likecomment'.$key['postingid'].'" class="pull-right text-muted">
                 ';

                      checklikeandcomments($key['postingid']);

                 echo'
              </span>
            </div>

            <!-- /.box-footer -->
            <div class="box-footer">
              <form class="commentfrm" data-form="'.$key['postingid'].'" id="commentfrm'.$key['postingid'].'">
                <img  id="mypiccomment" class="img-responsive img-circle img-sm" src="'.$perfilactual.'">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" name="comentario" placeholder="Comentar...">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->

            <!-- /.box-body -->
            <div id="box-commets-body-'.$key['postingid'].'" class="box-footer box-comments">';
 
               comments($key['postingid'],$key['permalink']);

             echo'</div>
          </div>

        ';

      }
    }


    $conexion = '';

}


function users_list( $sql = null ){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    if( empty( $sql ) ){

        $SQL = 'SELECT u.nombre, u.permalink, u.apellido, u.email, img.ruta FROM '.SSPREFIX.'usuarios as u LEFT JOIN '.SSPREFIX.'imagespost as img on img.usuario = u.id WHERE u.rango = 1 order by registro';
    }
    else{

        $SQL = $sql;
    }
    
    $stn = $conexion -> prepare( $SQL );
    $stn -> execute();
    $rstl = $stn -> fetchAll();

    return $rstl;
    /*foreach( $rstl as $key ){

        if ( is_null( $key['apodo'] ) ) {
        
            $apodo = '(Sin Apodo)';
        }
        else{
            
            $apodo = $key['apodo'];
        }

        if( $key['emailshow'] == 1 ){
            
            $emailshow = $key['email'];
            $theoptionsselect = '
            <option value="1">Visible</option>
            <option value="2">Privado</option>
            ';
        }
        else{
            
            $emailshow = '(Privado)';
            $theoptionsselect = '
            <option value="2">Privado</option>
            <option value="1">Visible</option>
            ';
        }
    }*/
}



function mytheinformation(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'usuarios.email,'.SSPREFIX.'usuarios.apodo, '.SSPREFIX.'information.description, '.SSPREFIX.'information.emailshow FROM '.SSPREFIX.'information INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'information.usuario = '.SSPREFIX.'usuarios.id WHERE '.SSPREFIX.'usuarios.id = :id';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':id', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      foreach ($rstl as $key){

         if (is_null($key['apodo'])) {
           $apodo = '(Sin Apodo)';
         }else{
           $apodo = $key['apodo'];
         }

         if ($key['emailshow'] == 1) {
           $emailshow = $key['email'];
           $theoptionsselect = '
             <option value="1">Visible</option>
             <option value="2">Privado</option>
           ';
         }else{
           $emailshow = '(Privado)';
           $theoptionsselect = '
             <option value="2">Privado</option>
             <option value="1">Visible</option>
           ';
         }

        echo'
            <!-- ### LEFT ### -->
            <form id="theinformationeditfrm">
            <div id="theinformationparentp" class="col-sm-6 col-xs-12">
              <label><i class="fa fa-user" aria-hidden="true"></i> Nombre:</label>
              <p>'.$key['nombre'].' '.$key['apellido'].'</p>

              <div id="thenamedivedit" style="margin-bottom:5px;">
                <span><strong>Nombre:</strong></span>
                <input name="nombre" class="form-control" type="text" value="'.$key['nombre'].'">
                <span><strong>Apellido:</strong></span>
                <input name="apellido" class="form-control" type="text" value="'.$key['apellido'].'">
              </div>

              <p></p>
              <p></p>
              <label><i class="fa fa-user" aria-hidden="true"></i> Apodo:</label>
              <p>'.$apodo.'</p>

              <div id="theapododiv"  style="margin-bottom:5px;">
               <span><strong>Apodo:</strong></span>
               <input name="apodo" class="form-control" type="text" value="'.$apodo.'">
              </div>


              <p></p>
              <label><i class="fa fa-envelope-o" aria-hidden="true"></i> Email:</label>
              <p>'.$emailshow.'</p>

              <div id="theselecteditdiv">
                <span><strong>Email:</strong></span>
                <select id="theemailshowselect" name="emailshow" class="form-control">
                  '.$theoptionsselect.'
                </select>
              </div>



            </div>
            <!-- ### LEFT ### -->

            <!-- ### MAPA ### -->
            <div id="theinformationparentp2" class="col-sm-6 col-xs-12">
              <label><i class="fa fa-file-text-o" aria-hidden="true"></i> Descripción:</label>
              <p>'.emoticons($key['description']).'</p>

              <div id="thedescriptioneditdiv">
                <span><strong>Descripción:</strong></span>
                <textarea name="description" class="form-control" rows="20">'.$key['description'].'</textarea>
              </div>

            </div>
            </form>
            <!-- ### MAPA ### -->
        ';

      }
}


function updatemyinfo($nombre,$apellido,$apodo,$emailshow,$description){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      // Filtramos para evitar XSS Injection
      $filtro = new InputFilter();
      $finaldescription = $filtro->process($description);

      // Filtrar nombre
      $finalnombre = $filtro->process($nombre);

      // filtramos apellido
      $finalapellido = $filtro->process($apellido);

      // Filtramos apodo
      $finalapodo = $filtro->process($apodo);

      $SQL = 'UPDATE '.SSPREFIX.'information SET description = :description, emailshow = :emailshow WHERE usuario = :usuario';
      $sentence = $conexion -> prepare($SQL);
      $sentence -> bindParam(':description', $finaldescription ,PDO::PARAM_STR);
      $sentence -> bindParam(':emailshow', $emailshow ,PDO::PARAM_INT);
      $sentence -> bindParam(':usuario', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $sentence -> execute();


      if (empty($finalapodo)){

      $SQL = 'UPDATE '.SSPREFIX.'usuarios SET nombre = :nombre, apellido = :apellido, apodo = NULL WHERE id = :id';
      $sentence = $conexion -> prepare($SQL);
      $sentence -> bindParam(':nombre', $finalnombre ,PDO::PARAM_STR);
      $sentence -> bindParam(':apellido', $finalapellido ,PDO::PARAM_STR);
      $sentence -> bindParam(':id', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $sentence -> execute();


        }else{

      $SQL = 'UPDATE '.SSPREFIX.'usuarios SET nombre = :nombre, apellido = :apellido, apodo = :apodo WHERE id = :id';
      $sentence = $conexion -> prepare($SQL);
      $sentence -> bindParam(':nombre', $finalnombre ,PDO::PARAM_STR);
      $sentence -> bindParam(':apellido', $finalapellido ,PDO::PARAM_STR);
      $sentence -> bindParam(':apodo', $finalapodo ,PDO::PARAM_STR);
      $sentence -> bindParam(':id', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $sentence -> execute();


        }  

}



// Para las notificaciones
function checknotificationsfull(){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT '.SSPREFIX.'usuarios.nombre, '.SSPREFIX.'usuarios.apellido, '.SSPREFIX.'posts.permalink, '.SSPREFIX.'notifications.tipo FROM '.SSPREFIX.'notifications INNER JOIN '.SSPREFIX.'usuarios ON '.SSPREFIX.'notifications.de = '.SSPREFIX.'usuarios.id INNER JOIN '.SSPREFIX.'posts ON '.SSPREFIX.'notifications.post = '.SSPREFIX.'posts.id WHERE '.SSPREFIX.'notifications.para = :para ORDER BY '.SSPREFIX.'notifications.fecha DESC LIMIT 20';

      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':para', $_SESSION['ssid'] ,PDO::PARAM_INT);
      $stn -> execute();
      $rstl = $stn -> fetchAll();
      if (empty($rstl)){
      }else{
        foreach ($rstl as $key){


          if ($key['tipo'] == 1){
            
             echo'
                    <tr><!-- start notification -->
                      <td><a href="post.php?'.$key['permalink'].'" >
                        <i class="fa fa-comment-o text-yellow"></i> <b class="text-muted">'.$key['nombre'].' '.$key['apellido'].'</b> comento en tu publicación
                      </a></td>
                    </tr>
             ';

          }elseif ($key['tipo'] == 2){
            
             echo'
                    <tr><!-- start notification -->
                      <td><a href="post.php?'.$key['permalink'].'" >
                        <i class="fa fa-thumbs-o-up text-aqua"></i> <b class="text-muted">'.$key['nombre'].' '.$key['apellido'].'</b> le gusta tu publicación
                      </a></td>
                    </tr>
             ';

           } 
        }
    }
}




function activationaccout($email,$token){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'SELECT * FROM '.SSPREFIX.'verify WHERE token = :token AND email = :email LIMIT 1';
      $sentence = $conexion -> prepare($SQL);
      $sentence -> bindParam(':token',$token, PDO::PARAM_STR);
      $sentence -> bindParam(':email',$email, PDO::PARAM_STR);
      $sentence -> execute();
      $result = $sentence -> fetchAll();
      if (empty($result)){
        header('Location: index.php');
      }else{
   
          $UPDA = 'UPDATE '.SSPREFIX.'usuarios SET activo = 2 WHERE email = :email LIMIT 1';
          $stnupda = $conexion -> prepare($UPDA);
          $stnupda -> bindParam(':email', $email, PDO::PARAM_STR);
          $stnupda -> execute();

          $DElV = 'DELETE FROM '.SSPREFIX.'verify WHERE email = :email';
          $stndel = $conexion -> prepare($DElV);
          $stndel -> bindParam(':email', $email, PDO::PARAM_STR);
          $stndel -> execute();
          header('Location: index.php?active='.$token.sha1($token));
      }

}



function recoverypass($email){

  // Strip Email
  $stripemail = strip_tags($email);

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM '.SSPREFIX.'usuarios WHERE email = :email LIMIT 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':email',$stripemail, PDO::PARAM_STR);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
   
    return 1;

  }else{

    // Generamos Password y lo ciframos    
    $passgenerated = generateRandomString();
    $newpass = sha1(SALT.$passgenerated.PEPER);
    
    $NewPassSQL = 'UPDATE '.SSPREFIX.'usuarios SET password = :password WHERE email = :email';
    $stnpass = $conexion -> prepare($NewPassSQL);
    $stnpass -> bindParam(':password', $newpass , PDO::PARAM_STR);
    $stnpass -> bindParam(':email', $stripemail, PDO::PARAM_STR);
    $stnpass -> execute();

    $dataexplode = congifurationmailrecover();
    $parsedata = explode("|", $dataexplode);

    $htmlhead = '<!DOCTYPE html><html><body>';
    $htmlfooter = '</body></html>';
    $messageone = '<p>'.$parsedata[6].'</p></p><p></p>';
    $activationlink = '<p><label>Tu nueva contraseña es: <strong>'.$passgenerated.'</strong></label></p>';

    // Envio de Correo 
    $mail = new PHPMailer;
    $mail->isSMTP();                                      
    $mail->Host = $parsedata[0]; // especiificar el servidor smtp
    $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => true, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
    $mail->SMTPSecure = 'tls';                          
    $mail->Username = $parsedata[3]; // correo desde el que se enviara
    $mail->Password = $parsedata[4]; // password del correo
    $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
    $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
    $mail->addAddress($stripemail);   // destino
    $mail->isHTML(true);    
    $mail->Subject = 'Recuperación de Cuenta';   // Asunto
    $mail->Body = $htmlhead.$messageone.$activationlink.$htmlfooter;
    $mail->send();

    header('Location: index.php');

  }
}



function updatenotification($notification){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $NewPassSQL = 'UPDATE '.SSPREFIX.'notifications SET leido = 2 WHERE id = :id';
      $stnpass = $conexion -> prepare($NewPassSQL);
      $stnpass -> bindParam(':id', $notification, PDO::PARAM_STR);
      $stnpass -> execute();

}