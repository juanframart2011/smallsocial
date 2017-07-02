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
    <title>Videos | MeeTeam</title>

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
                                <? include( 'helper/menu_inteno.php' ) ?>
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
              <i class="fa fa-video-camera"></i>
              <h3 class="box-title">Videos</h3>
            </div>
            <div id="thepictures" class="box-body">
              <?php  myvideo(); ?>
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