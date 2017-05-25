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
    <title>Inicio | MeeTeam</title>

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
        <? include( 'helper/header.php' ) ?>
        <!-- ### TOP MENU ### -->


     <!-- container -->
     <div class="container">
       <div class="col-sm-9">
         


          <!-- ### COMMENT ### -->
          <div id="timeliner" style="margin-top:9px;z-index: 1;">

          <?php 
              takemylast6postfeed(); 
          ?>          

          </div>
          <!-- ### COMMENT ### -->
          <div id="loaderlinetime" class="col-sm-12 text-center">
            <div class="loader-inner ball-pulse-sync"><div></div><div></div><div></div></div>
          </div>



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
    <script type="text/javascript">
      <?php knowtimelinepostfeed(); ?>
    </script>        
  </body>
</html>