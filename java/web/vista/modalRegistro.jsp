<%-- 
    Document   : modalRegistro
    Created on : 21-sep-2016, 20:49:38
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<meta charset="UTF-8">
<div class="modal fade registro" tabindex="-1" role="dialog" aria-labelledby="registro" aria-hidden="true" id="registro">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formulario_registro" name="formulario_registro" action="GestionarRegistro" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Registrate en MeeTeam</h4>   
                </div>  
                <div class="modal-body">
                    <div class="form-group">
                        <label for="registro-nick" class="col-lg-3">Nick</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="registro-name" name="nick" placeholder="Escriba su apodo de usuario" required="" value="${valorNick}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registro-name" class="col-lg-3">Nombre:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="registro-name" name="Username" placeholder="Escriba su nombre de usuario" required="" value="${valorNombre}">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label for="registro-edad" class="col-lg-3">Edad/Antigüedad:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="registro-edad" name="Age" placeholder="Escriba su edad o antigüedad del club" value="${valorEdad}" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registro-localidad" class="col-lg-3">Localidad:</label>
                        <div class="col-lg-9 ">
                            <input type="text" class="form-control" id="registro-localidad" name="Location" placeholder="Seleccione su localidad" value="${valorLoca}" required="">
                            <a class="btn btn-default" id="btnLocalidad" onclick="desbloquearLocalidad()">Borrar Localidad</a> 
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
                            </script>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-lg-4">Tipo de Usuario:</label>
                        <div class="col-lg-8 opcionesradiobuton">
                            <div class="radio-inline">
                                <input type="radio"  id="tipoUser1" checked name="radiotipousuario" onclick="mostraropciones()" value="Equipo" >Equipo
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="tipoUser2" name="radiotipousuario" onclick="mostraropciones()" value="Jugador">Jugador
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="tipoUser3" name="radiotipousuario" onclick="mostraropciones()" value="Entrenador">Entrenador
                            </div>
                        </div>
                    </div>
                    <div id="sexo" class="form-group">
                        <label class="col-lg-4">Sexo:</label>
                        <div class="col-lg-8 opcionesradiobuton">
                            <div class="radio-inline">
                                <input type="radio"  id="sexoChico" name="radiosexo" value="chico" >Chico
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="sexoChica" name="radiosexo"  value="chica">Chica
                            </div>
                        </div>
                    </div>
                    <div id="tipo-equipo" class="form-group">
                        <label class="col-lg-4">Tipo de Equipo:</label>
                        <div class="col-lg-8 opcionesradiobuton">
                            <div class="radio-inline">
                                <input type="radio"  id="tipoEquipo1"  name="radiotipoequipo" value="Federado" >Federado
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="tipoEquipo2" name="radiotipoequipo"  value="Amateur">Amateur
                            </div>
                        </div>
                    </div> 
                    <div id="tipo-posicion" class="form-group">
                        <label class="col-lg-4">Posición:</label>
                        <div class="col-lg-8 opcionesradiobuton">
                            <div class="radio-inline">
                                <input type="radio"  id="posicionJugador1" name="radioposicion" value="Portero" >Portero
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="posicionJugador2" name="radioposicion"  value="Cierre">Cierre
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="posicionJugador3" name="radioposicion"  value="Ala">Ala
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="posicionJugador4" name="radioposicion"  value="Pivote">Pivote
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="posicionJugador5" name="radioposicion"  value="Cualquiera">Cualquiera
                            </div>
                        </div>
                    </div>
                    <div id="tipo-entrenar-equipo" class="form-group">
                        <label class="col-lg-4">Entrenar Equipo:</label>
                        <div class="col-lg-8 opcionesradiobuton">
                            <div class="radio-inline">
                                <input type="radio"  id="entrenarEquipo1"  name="radioentrenarequipo" value="Federado" >Federado
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="entrenarEquipo2" name="radioentrenarequipo"  value="Amateur">Amateur
                            </div>
                            <div class="radio-inline">
                                <input type="radio"  id="entrenarEquipo3" name="radioentrenarequipo"  value="Cualquiera">Cualquiera
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="contact-email" class="col-lg-3">Email:</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" id="contact-email" name="Mail" placeholder="tu@ejemplo.com" value="${valorEmail}" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registro-password" class="col-lg-3">Contraseña:</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="registro-password" name="Password" placeholder="Escriba su contraseña" value="${valorPass}" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="registro-password2" class="col-lg-3">Rep. Contraseña:</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="registro-password2" name="Password2" placeholder="Repita su contraseña" value="${valorRepePass}" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registro-password2" class="col-lg-3">Seguridad:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="registro-seguridad" name="seguridad" placeholder="Escriba una palabra/frase para recuperar contraseña" value="${valorSegu}" required="">
                        </div>
                    </div>
                </div>             
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a> 
                    <button class="btn btn-primary" id="registrarse" type="button" onclick="validacionRegistro()">Únete</button>
                    <div class="mensajeResultado" style="margin-top:20px">
                        <label for ="mensaje-resultado" class="col-md-12">${mensajeError}</label>
                        <input type="hidden" name="nombrejsp" value="valorRegistro">
                    </div>
                </div>
            </form>  
        </div>  
    </div>      
</div>  