<?php 
require_once 'administrator/ss-functions.php';
checkisuser();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Configuración | MeeTeam</title>

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
            <li class="dropdown user user-menu active">
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
            <div id="portada" class="widget-user-header bg-aqua-active" <?php userprofileportada(); ?>>
                  <div id="loadingprofilepicture" class="loader-inner line-scale pull-right"><div></div><div></div><div></div><div></div><div></div></div>
                    <div style="display:none;">
                      <form id="portadafrm">
                        <input type="file" name="portadaupload" id="portadauploadinput">
                      </form>
                    </div>
                    <div class="mask">
                      <div class="text-right col-sm-12"><button class="cambiarportada btn bg-orange margin"><i class="fa fa-cog animated infinite flash"></i></button></div>
                    </div>
              
            </div>
            <div class="widget-user-image">
              <img id="image-profile" class="img-circle changeprofilephoto" width="128" height="128" src="<?php getmyprofileimage(); ?>"  >
              <div style="display:none;">
                <form id="uploadpicprofilefrm">
                     <input type="file" name="profilepicture" id="profilepicinput">
                </form>
              </div>

            </div>
            <div class="box-footer">
              <div class="row">

                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <?php gettheusername(); ?>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-8 border-right">
                  <div class="description-block" style="text-align:center;">

                      <a href="home.php" class="btn btn-sm btn-success"><i class="fa fa-clock-o"></i> Inicio</a>
                      <a href="myinformation.php" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i> Información</a>
                      <a href="mypictures.php" class="btn btn-sm bg-navy "><i class="fa fa-picture-o"></i> Fotos</a>
                      <a href="myfollowers.php" class="btn btn-sm btn-danger"><i class="fa fa-users"></i> Seguidores</a>
                      <a href="search.php" class="btn btn-sm bg-gray"><i class="fa fa-users"></i> Buscar Usuarios</a>
                     

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
              <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
              <h3 class="box-title">Configuración</h3>
            </div>
            <div id="thepictures" class="box-body">
              

<div class="col-sm-4">
 <div class="panel panel-success">
  <div class="panel-heading"><i class="fa fa-unlock" aria-hidden="true"></i> Cambiar Contraseña</div>
  <div class="panel-body">
    
     <label>Contraseña Actual:</label>
     <input class="form-control" type="password"><p></p>

     <label>Nueva Contraseña:</label>
     <input class="form-control" type="password"><p></p>

     <label>Repetir Nueva Contraseña:</label>
     <input class="form-control" type="password"><p></p>

     <button class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>     

  </div>
 </div> 
</div>

<div class="col-sm-4">
 <div class="panel panel-warning">
  <div class="panel-heading"><i class="fa fa-envelope-o"></i> Cambiar Email</div>
  <div class="panel-body">
    
     <label>Correo Electronico Actual:</label>
     <input class="form-control" type="text" name="text" value="">
     <label>Nuevo Correo Electronico:</label>
     <input class="form-control" type="text" name="text" value="">

  </div>
 </div> 
</div>

<div class="col-sm-4">
 <div class="panel panel-danger">
  <div class="panel-heading"><i class="fa fa-user"></i> Cuenta</div>
  <div class="panel-body">
    
       <button class="btn btn-warning btn-block"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar Mi Cuenta</button>

  </div>
 </div> 
</div>




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