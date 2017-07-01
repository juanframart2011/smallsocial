<?php 
    require_once 'administrator/ss-functions.php';
    checkisuser();
    $title = 'Buscador';
    ?>
<!DOCTYPE html>
<html lang="en">

    <? include( 'helper/head.php' ) ?>
    <style>
        .range-slider__range {
            -webkit-appearance: none;
            height: 10px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 0;
        }
        .range-slider__range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            -webkit-transition: background .15s ease-in-out;
            transition: background .15s ease-in-out;
        }
        .range-slider__range::-webkit-slider-thumb:hover {
            background: #1abc9c;
        }
        .range-slider__range:active::-webkit-slider-thumb {
            background: #1abc9c;
        }
        .range-slider__range::-moz-range-thumb {
            height: 20px;
            border: 0;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            -webkit-transition: background .15s ease-in-out;
            transition: background .15s ease-in-out;
        }
        .range-slider__range::-moz-range-thumb:hover {
            background: #1abc9c;
        }
        .range-slider__range:active::-moz-range-thumb {
            background: #1abc9c;
        }
        .range-slider__value {
            display: inline-block;
            position: relative;
            color: #fff;
            line-height: 20px;
            text-align: center;
            border-radius: 3px;
            background: #2c3e50;
            padding: 5px 10px;
            margin-left: 8px;
        }
        .range-slider__value:after {
            position: absolute;
            top: 8px;
            left: -7px;
            height: 0;
            border-top: 7px solid transparent;
            border-right: 7px solid #2c3e50;
            border-bottom: 7px solid transparent;
            content: '';
        }
    </style>
    
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
                <!-- ### COMMENT ### -->
                <div id="timeliner">
                    <div class="box box-info">
                        <div class="box-header ui-sortable-handle">
                            <h3 style="display: block;width: 100%;" class="box-title"><i class="fa fa-search"></i> Buscador</h3>
                            <h4 class="text-center">Solo puede buscar por un filtro a la vez</h4>
                        </div>
                        <div id="boxbodyinfo" class="box-body">

                            <form action="search_form.php" id="form_search" method="post" name="form_search">
                                <div class="row range-slider">
                                    <h2>En toda la ciudad</h2>
                                    <input class="col-lg-9 col-md-9 col-sm-9 col-xs-9 range-slider__range" type="range" value="0" min="0" max="100">
                                    <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 range-slider__value">0Km</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <label>Tipo de Usuario</label>
                                        <select class="form-control" id="type_user" name="type_user" required>
                                            <option value="">Seleccionar un Usuario</option>
                                            <option value="Equipo">Equipo</option>
                                            <option value="Jugador">Jugador</option>
                                            <option value="Entrenador">Entrenador</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Localidad</label>
                                        <input type="text" class="form-control" id="registro-localidad" name="localidad" placeholder="Seleccione su localidad">
                                        <a class="btn btn-default btn-danger" id="btnLocalidad" onclick="desbloquearLocalidad()">Borrar Localidad</a>
                                    </div>
                                </div>
                                <br>
                                <input id="ciudad" name="ciudad" type="hidden">
                                <input id="pais" name="pais" type="hidden">
                                <input id="region" name="region" type="hidden">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 search-gender">
                                        <label>Genero</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Ambos Genero</option>
                                            <option value="Chico">Chico</option>
                                            <option value="Chica">Chica</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  search-age">
                                        <label>Edad</label>
                                        <select class="form-control" id="age" name="age">
                                            <option value="">Todas las edades</option>
                                            <?
                                            $ag = 2011;
                                            for( $i = 6; $i < 70; $i++ ):?>
                                                <option value="<?= $ag ?>"><?= $i ?></option>
                                            <?
                                            $ag--;
                                            endfor?>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12  col-md-offset-3 col-lg-offset-3 search-typeEquipo">
                                        <label>Tipo de Equipo</label>
                                        <select class="form-control" id="type_equipo" name="type_equipo">
                                            <option value="">Seleccionar un tipo de equipo</option>
                                            <option value="Federado">Federado</option>
                                            <option value="Amateur">Amateur</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            
                            <br>

                            <div class="content-user row">
                                <?
                                $list = users_list();
                                
                                for( $u = 0; $u < count( $list ); $u++ ):?>
                                    <a href="<?= 'profile.php?' . $list[$u]["permalink"] ?>"><div class="col-md-3 text-center">
                                        <div class="widget-user-image">
                                            <img class="img-circle" width="128" height="128" src="<?= ( empty( $list[$u]["ruta"] ) )? 'images/profile-default.jpg' : $list[$u]["ruta"] ?>">
                                        </div>
                                        <h5><?= $list[$u]["nombre"] . ' ' . $list[$u]["apellido"] ?></h5>
                                        <h5><?= $list[$u]["email"] ?></h5>
                                    </div></a>
                                <?
                                endfor;
                                ?>
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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE"></script>
        <script src="js/localidad.js" type="text/javascript"></script>
        <script>
            $( document ).ready( function(){

                var rangeSlider = function(){

                    var slider = $('.range-slider'),
                    range = $('.range-slider__range'),
                    value = $('.range-slider__value'),
                    km = 0;

                    slider.each(function(){

                        value.each(function(){
                            
                            var value = $( this ).prev().attr( 'value' );
                            $( this ).html( value + "Km" );
                        });

                        range.on('input', function(){
                            
                            if( this.value < 100 ){

                                km = this.value + "Km";
                            }
                            else{

                                km = "Todo México";
                            }
                            $( this ).next( value ).html( km );
                        });
                    });
                };

                rangeSlider();

                $( "#type_user" ).change( function(){

                    if( $( this ).val() == "Equipo" || $( this ).val() == "Jugador" ){

                        $( ".search-typeEquipo" ).css( "display", "none" );
                        $( ".search-gender, .search-age" ).css( "display", "block" );
                    }
                    else if( $( this ).val() == "Entrenador" ){

                        $( ".search-gender, .search-age" ).css( "display", "none" );
                        $( ".search-typeEquipo" ).css( "display", "block" );
                    }
                });

                $( "#type_user, #gender, #age, #type_equipo" ).change( function(){

                    $.ajax({
                        url: $( "#form_search" ).attr( "action" ),
                        type: 'POST',
                        dataType: 'html',
                        data: $( "#form_search" ).serialize(),
                    })
                    .done(function( data ) {
                        
                        $( ".content-user" ).html( data );
                    })
                    .fail(function( error ){

                        console.log( error );
                    })
                    .always(function() {
                        console.log("complete");
                    });
                });
            });
        </script>  
    </body>
</html>