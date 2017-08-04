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
        <title>Inicio | MeeTeam </title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">
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
                        <div id="loadingprofilepicture" class="loader-inner line-scale pull-right">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
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
                <!-- ### FORM POST ### -->
                <div class="box box-info">
                    <!-- form start -->
                    <form id="poster" class="form-horizontal">
                        <div class="box-body">
                            <textarea id="thetextpost" name="posttext" class="form-control" rows="3"></textarea>
                        </div>
                        <!-- /.box-body -->
                    </form>
                    <div class="box-footer">
                        <button class="btn btn-danger btn-sm pull-left" data-toggle="modal" data-target="#ModalDocumment"> <i class="fa fa-file-archive-o" aria-hidden="true"></i> Vídeo</button>&#32;&#32;
                        <button class="btn btn-success btn-sm pull-left" data-toggle="modal" data-target="#ModalImage"> <i class="fa fa-picture-o" aria-hidden="true"></i> Imagen</button>
                        <button class="posterbtn btn btn-info btn-sm pull-right"><i class="fa fa-pencil"></i> Publicar</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- ### FORM POST ### -->
                <!-- ### COMMENT ### -->
                <div id="timeliner">
                    <?php takemylast6post(); ?>          
                </div>
                <!-- ### COMMENT ### -->
                <div id="loaderlinetime" class="col-sm-12 text-center">
                    <div class="loader-inner ball-pulse-sync">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" aria-hidden="true"></i> Subir Vídeo</h4>
                    </div>
                    <div class="modal-body">
                        <div id="thefilattch" class="col-sm-12">
                            <form id="attachmentfrm">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                <label>Vídeo:</label>
                                <input type="file" name="archivo" class="form-control">
                            </form>
                            <p></p>
                            <p>Solo se aceptan vídeos con la extensión: <?php validextlist(); ?></p>
                        </div>
                        <!-- progress -->
                        <div id="loadeingarchive" class="progress active">
                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                        <!-- progress -->
                        <button type="button" class="uploadarchive btn btn-primary pull-right">Subir Vídeo</button>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="modal fade" id="ModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" aria-hidden="true"></i> Subir Imagen</h4>
                    </div>
                    <div class="modal-body">
                        <div id="thefilattch2" class="col-sm-12">
                            <form id="archiveimage">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descripcion_image" rows="3"></textarea>
                                <label>Imagen:</label>
                                <input type="file" name="imagedata" class="form-control">
                            </form>
                            <p></p>
                            <p>Solo se aceptan vídeos con la extensión: jpg, jpeg, png</p>
                        </div>
                        <!-- progress -->
                        <div id="loadeingarchive2" class="progress active">
                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                        <!-- progress -->
                        <button type="button" class="uploadimage btn btn-primary pull-right">Subir Imagen</button>
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
            <?php knowtimelinepost(); ?>
        </script>
    </body>
</html>