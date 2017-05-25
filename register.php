<?php 
    require_once 'administrator/ss-functions.php';
    checklogin();
    if (isset($_POST['email'])){
       $fecha = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

       if( $_POST['type_user'] == "Equipo" ){

            $type_user = $_POST['type_user'];
            $type_equipo = $_POST['type_equipo'];
            $gender = '';
            $position = '';
        }
        elseif( $_POST['type_user'] == "Jugador" ){

            $type_user = $_POST['type_user'];
            $type_equipo = '';
            $gender = $_POST['gender'];
            $position = $_POST['position'];
        }
        elseif( $_POST['type_user'] == "Entrenador" ){

            $type_user = $_POST['type_user'];
            $type_equipo = $_POST['type_equipo'];
            $gender = $_POST['gender'];
            $position = '';
        }

       register($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['passwordtwo'],$fecha, $type_user, $type_equipo, $gender, $position, $_POST["localidad"]);
    }
    $register_menu = true;
    ?>
<!DOCTYPE html>
<html>

    <? include( 'helper/head.php' ) ?>
    
    <body>
        
        <? include( 'helper/menu.php' ) ?>
        
        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12 text-center">

                    <div class="register-box">
                        <div class="register-logo">
                            <a href="index.php">MeeTeam</a>
                        </div>
                        <div class="register-box-body">
                            <?php
                                if (isset($_GET['success'])) {
                                  echo'
                                       <div class="alert alert-success alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="fa fa-smile-o" aria-hidden="true"></i> Listo !</h4>
                                         <p>Gracias por registrarte, ahora puedes conectarte !! </p>
                                       </div>              
                                  ';
                                }
                                ?>
                            <?php
                                if (isset($_GET['error'])) {
                                  echo'
                                       <div class="alert alert-danger alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="fa fa-meh-o" aria-hidden="true"></i> Ooops...</h4>
                                         <p>Ocurrio un error al registrarte, intentalo de nuevo mas tarde.</p>
                                       </div>              
                                  ';
                                }
                                ?>
                            <?php
                                if (isset($_GET['nomail'])) {
                                  echo'
                                       <div class="alert alert-danger alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="fa fa-meh-o" aria-hidden="true"></i> Ooops...</h4>
                                         <p>Este correo electronico ya esta en uso.</p>
                                       </div>              
                                  ';
                                }
                                ?>
                            <?php
                                if (isset($_GET['noage'])) {
                                  echo'
                                       <div class="alert alert-danger alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="fa fa-meh-o" aria-hidden="true"></i> Ooops...</h4>
                                         <p>Debes de ser mayor de edad para poder registrarte.</p>
                                       </div>              
                                  ';
                                }
                                ?>
                            <form id="registerfrm" action="" method="POST">
                                <div class="form-group has-feedback">
                                    <label>Nombre</label>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Apellido</label>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido">
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Correo Electronico</label>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <input type="email" class="form-control" name="email" placeholder="Correo Electronico">
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Contraseña</label>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <input id="passwordone" type="password" class="form-control" name="passwordone" placeholder="Contraseña">
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Repetir Contraseña</label>
                                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    <input type="password" class="form-control" name="passwordtwo" placeholder="Repetir Contraseña">
                                </div>
                                <div class="col-sm-4 text-center" style="padding-left:0px;">
                                    <label>Dia</label>
                                    <select class="form-control" name="day">
                                        <option></option>
                                        <?php
                                            for ($i=1; $i < 32; $i++) { 
                                              echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 text-center" style="padding:0px;">
                                    <label>Mes</label>
                                    <select class="form-control" name="month">
                                        <option></option>
                                        <?php
                                            $meses = 'Ene,Feb,Mar,Abr,May,Jun,Jul,Ago,Sep,Oct,Nov,Dic';
                                            $explode = explode(',', $meses);
                                            for ($i=0; $i < 12; $i++) {
                                              $mesvalue = $i+1;
                                              if ($i > 8){
                                                echo '<option value="'.$mesvalue.'">'.$explode[$i].'</option>';
                                              }else{
                                                echo '<option value="0'.$mesvalue.'">'.$explode[$i].'</option>';
                                              }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 text-center" style="padding-right:0px;">
                                    <label>Año</label>
                                    <select class="form-control" name="year">
                                        <option></option>
                                        <?php
                                            $thedate = date('Y') + 1;
                                            $thelast = $thedate - 100;
                                            for ($i=$thelast; $i < $thedate; $i++) { 
                                              echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Localidad:</label>
                                    <input type="text" class="form-control" id="registro-localidad" name="localidad" placeholder="Seleccione su localidad">
                                    <a class="btn btn-default btn-danger" id="btnLocalidad" onclick="desbloquearLocalidad()">Borrar Localidad</a>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Tipo de Usuario</label>
                                    <select class="form-control" id="type_user" name="type_user">
                                        <option>Seleccionar un Usuario</option>
                                        <option value="Equipo">Equipo</option>
                                        <option value="Jugador">Jugador</option>
                                        <option value="Entrenador">Entrenador</option>
                                    </select>
                                </div>

                                <div class="form-group has-feedback type-equipo">
                                    <label>Tipo de Equipo</label>
                                    <select class="form-control" id="type_equipo" name="type_equipo">
                                        <option>Seleccionar un tipo de equipo</option>
                                        <option value="Federado">Federado</option>
                                        <option value="Amateur">Amateur</option>
                                    </select>
                                </div>

                                <div class="form-group has-feedback gender">
                                    <label>Tipo de Equipo</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option>Seleccionar un tipo de equipo</option>
                                        <option value="Chico">Chico</option>
                                        <option value="Chica">Chica</option>
                                    </select>
                                </div>

                                <div class="form-group has-feedback position">
                                    <label>Tipo de Equipo</label>
                                    <select class="form-control" id="position" name="position">
                                        <option>Seleccionar un tipo de equipo</option>
                                        <option value="Portero">Portero</option>
                                        <option value="Cierre">Cierre</option>
                                        <option value="Ala">Ala</option>
                                        <option value="Pivote">Pivote</option>
                                        <option value="Cualquiera">Cualquiera</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-12">
                                        <p></p>
                                        <button type="submit" class="btn btn-success btn-block btn-flat">Registrarme</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <p></p>
                            <p class="col-sm-12 text-center"><a href="index.php" class="text-center">¿Ya tienes una cuenta? Inicia Sesion</a></p>
                            <br>
                        </div>
                        <!-- /.form-box -->
                    </div>
                </div>
            </div>
        </div>
        
        <? include( 'helper/footer.php' ) ?>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE"></script>
        <script>
            function init() {
                var input = document.getElementById('registro-localidad');
                var opts = {
                    types: ['(cities)']
                };
                var autocomplete = new google.maps.places.Autocomplete(input, opts);

                //Bloqueamos el input si seleccionamos una localidad y hacemos visible el botón 'Borrar Localidad'
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    var result = autocomplete.getPlace();

                    //addressObj.types[j] - confirma que es un pais
                    //addressObj.long_name - se obtiene el nombre del pais
                    for (var i = 0; i < result.address_components.length; i++) {
                        var addressObj = result.address_components[i];
                        for (var j = 0; j < addressObj.types.length; j++) {
                            //console.log(addressObj.types[j]);
                            if (addressObj.types[j] == 'locality') {
                                console.log(addressObj.long_name);
                            }
                            if (addressObj.types[j] == 'country') {
                                console.log(addressObj.long_name);
                            }
                        }
                    }
                    document.getElementById('registro-localidad').readOnly = true;
                    document.getElementById('btnLocalidad').style.display = 'block';
                });
            }
            google.maps.event.addDomListener(window, 'load', init);

            function desbloquearLocalidad() {
                document.getElementById('registro-localidad').removeAttribute("readOnly");
                document.getElementById("registro-localidad").value = "";
                document.getElementById('btnLocalidad').style.display = 'none';
            }

            $( document ).ready( function(){

                $( "#type_user" ).change( function(){

                    if( $( this ).val() == "Equipo" ){

                        $( ".gender, .position" ).css( "display" , "none" );
                        $( ".type-equipo" ).css( "display" , "block" );
                    }
                    else if( $( this ).val() == "Jugador" ){

                        $( ".type-equipo" ).css( "display" , "none" );
                        $( ".gender, .position, .type-equipo" ).css( "display" , "block" );
                    }
                    else if( $( this ).val() == "Entrenador" ){

                        $( ".position" ).css( "display" , "none" );
                        $( ".gender, .type-equipo" ).css( "display" , "block" );
                    }
                });
            });
        </script>
    </body>
</html>