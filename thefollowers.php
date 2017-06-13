<?php 
require_once 'administrator/ss-functions.php';
checkisuser();

$thepermauser = $_SERVER['QUERY_STRING'];
if(empty($thepermauser)){header('Location: home.php');}
if(ctype_space($thepermauser)){header('Location: home.php');}
$thenameuser = thenameusertitle($thepermauser);
$explodedata = explode('|', $thenameuser);

if (empty($thenameuser) || is_null($thenameuser)){
    header('Location: home.php');
}elseif ($explodedata[0] == $_SESSION['ssid']) {
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Seguidores | MeeTeam</title>

    <!-- Bootstrap -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body  class="layout-top-nav skin-blue-light">


<!-- ### TOP MENU ### -->
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="home.php" class="navbar-brand">MeeTeam</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <form class="navbar-form navbar-left" role="search" method="GET" action="find.php">
            <div class="form-group">
              <input type="text" class="form-control" name="search" id="navbar-search-input" placeholder="Buscar Usuarios...">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
              </a>
              <ul class="dropdown-menu">

                <li>
                  <!-- inner menu: contains the messages -->
                  <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: auto;"><ul class="menu" style="overflow: auto; width: 100%; height: auto;">
                    <?php conversationlst(); ?>
                    <!-- end message -->
                  </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="myinbox.php">Ver todos los mensajes</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: auto;"><ul class="menu" style="overflow: auto; width: 100%; height: auto;">
                    <?php checknotifications(); ?>
                    <!-- end notification -->
                  </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                </li>
                <li class="footer"><a href="mynotifications.php">Ver todas las notificaciones</a></li>
              </ul>
            </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><i class="fa fa-cog"></i></span>
              </a>

              <ul class="dropdown-menu" style="padding:5px;">
                <!-- Menu Footer-->
                <li><a href="myconfiguration.php" class="btn btn-default btn-flat"><i class="fa fa-cog"></i> Configuración</a></li>
                <li><a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Cerrar Sesion</a></li>

              </ul>

            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
<!-- ### TOP MENU ### -->


     <!-- container -->
     <div class="container">
       <div class="col-sm-9">
         

          <!-- ### HEADER ### -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div id="portada" class="widget-user-header bg-aqua-active" <?php userprofileportadaperid($explodedata[0]); ?>>
              <div id="loadingprofilepicture" class="loader-inner line-scale pull-right"><div></div><div></div><div></div><div></div><div></div></div>
              <div class="mask">
              </div>
            </div>
            <div class="widget-user-image">
              <img id="image-profile" class="img-circle" width="128" height="128" src="<?php getmyprofileimageperid($explodedata[0]); ?>"  >
            </div>
            <div class="box-footer">
              <div class="row">

                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <?php gettheusernameprofileperid($explodedata[0]); ?>
                    <?php checkthefollow($explodedata[0]); ?>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-8 border-right">
                  <div class="description-block" style="text-align:center;">
                      <a href="profile.php?<?php echo $thepermauser; ?>" class="btn btn-sm btn-default"><i class="fa fa-clock-o"></i> Inicio</a>
                      <a  href="theinformation.php?<?php echo $thepermauser; ?>" class="infoprofilebtn btn btn-sm btn-default"><i class="fa fa-info-circle"></i> Información</a>
                      <a href="thepictures.php?<?php echo $thepermauser; ?>"  class="picturesprofilebtn btn btn-sm btn-default"><i class="fa fa-picture-o"></i> Fotos</a>
                      <a href="thefollowers.php?<?php echo $thepermauser; ?>"  class="followersprofilebtn btn btn-sm btn-default active"><i class="fa fa-users"></i> Seguidores</a>
                      <?php checkconversationlist($explodedata[0]); ?>

                  </div>
                  <!-- /.description-block -->
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- ### HEADER ### -->



          <!-- ### COMMENT ### -->
          <div id="timeliner">

           <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-users" aria-hidden="true"></i>
              <h3 class="box-title">Seguidores</h3>
            </div>
            <div id="thepictures" class="box-body">
              
              <?php thefollowersperid($explodedata[0]); ?>


            </div>

          </div>  

          </div>
          <!-- ### COMMENT ### -->



       </div>
       <div id="sidebar" class="col-sm-3">
           <?php include 'includes/adsense.html'; ?>
       </div>
     </div>
     <!-- container -->


     <!-- Modal -->
     <div class="modal fade" id="ModalDocumment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" aria-hidden="true"></i> Subir Archivo</h4>
           </div>
           <div class="modal-body">
             
              
              <div id="thefilattch" class="col-sm-12">
                <form id="attachmentfrm">
                  <label>Descripción:</label>
                  <textarea class="form-control" name="descripcion" rows="3"></textarea>
                  <label>Archivo:</label>
                  <input type="file" name="archivo" class="form-control">
                </form>

                <p></p>
                <p>Solo se aceptan archivos con la extension: <?php validextlist(); ?></p>
                
              </div>
              <!-- progress -->
              <div id="loadeingarchive" class="progress active">
                <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
              </div>
              <!-- progress -->
              <button type="button" class="uploadarchive btn btn-primary pull-right">Subir Archivo</button>

           </div>
         </div>
       </div>
     </div>




     <!-- ### CHAT APPEND ### -->
     <div id="chatappend">
     </div>
     <!-- ### CHAT APPEND ### -->


     <!-- ### CHAT APPEND ### -->
     <div id="dataappendknow">
     </div>
     <!-- ### CHAT APPEND ### -->


     <!-- ### ERROR ### -->
       <div id="theerror">
          <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Advertencia!</h4>
            <p id="alert-message"></p>
          </div>
       </div>
     <!-- ### ERROR ### -->


     <!-- ### MODAL PICTURE ### -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content" style="margin-top: 150px;">
      <div id="picturebodymodaldiv" class="modal-body" style="padding: 0px;" >
        
        <div class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div>


      </div>
    </div>
  </div>
</div>
     <!-- ### MODAL PICTURE ### -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE -->
    <script src="js/AdminLTE.js"></script> 
    <!-- validate -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <!-- SS Member -->
    <script src="js/ss-member.js"></script> 
    <script src="js/ss-member-line.js"></script>        
  </body>
</html>