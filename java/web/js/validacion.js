/*funcion que valida los campos del "Login". Comprueba que los campos no estan vacios,
 * que la longitud no sobrepase los 10 caracteres y que no se han introducido caracteres especiales en
 * ninguno de los dos campos. Si se cumplen todas las condiciones hara submit.
 */

function validacionLogin() {
    var usuario = document.formulario_login.User.value; //obtenemos el valor de campo Usuario
    var contrasena = document.formulario_login.Pass.value;
    var expMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!expMail.test(usuario)) {
        window.alert("Direccion de correo no valida");
    } else if (contrasena === null || contrasena.length === 0 || contrasena.length < 5 || contrasena.length > 15 || vacio(contrasena) === false) {
        window.alert("Longitud de contraseña incorrecta");
    } else
        document.formulario_login.submit();
}

/*funcion que valida los campos del "¿Has olvidado la contraseña?". Comprueba que los campos no estan vacios,
 * y que se introducen correctamente los valores.
 */
function validacionRecuPass() {
    var email = document.formulario_recupass.emailrecu.value;
    var seguri = document.formulario_recupass.segur.value;
    var contrasena = document.formulario_recupass.Passw.value;
    var contrasena2 = document.formulario_recupass.Passw2.value;
    var expMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!expMail.test(email)) {
        window.alert("Direccion de correo no valida");
    } else if (seguri === null || seguri.length === 0 || seguri.length < 5 || seguri.lenght > 20 || vacio(seguri) === false) {
        window.alert("Longitud de palabra/frase incorrecta");
    } else if (contrasena === null || contrasena.length === 0 || contrasena.length < 5 || contrasena.length > 15 || vacio(contrasena) === false) {
        window.alert("Longitud de contraseña incorrecta");
    } else if (contrasena !== contrasena2 || vacio(contrasena2) === false) {
        window.alert("Las contraseñas no coinciden");
    } else
        document.formulario_recupass.submit();
}

function cambiarPassword() {
    var contrasena = document.formulario_cambiarpassword.cambiarPassw.value;
    var contrasena2 = document.formulario_cambiarpassword.cambiarPassw2.value;

    if (contrasena === null || contrasena.length === 0 || contrasena.length < 5 || contrasena.length > 15 || vacio(contrasena) === false) {
        window.alert("Longitud de contraseña incorrecta");
    } else if (contrasena !== contrasena2 || vacio(contrasena2) === false) {
        window.alert("Las contraseñas no coinciden");
    } else
        document.formulario_cambiarpassword.submit();
}

/*funcion que valida los campos del formulario "Registrate". Comprueba que los campos no estan vacios,
 * que la longitud no sobrepase los 10 caracteres y que no se han introducido caracteres especiales en
 * ninguno de los dos campos. Si se cumplen todas las condiciones hara submit.
 */
function validacionRegistro() {
    var nik = document.formulario_registro.nick.value;
    var usuario = document.formulario_registro.Username.value;
    var edad = document.formulario_registro.Age.value;
    var localidad = document.formulario_registro.Location.value;
    var equipo = document.getElementById('tipoUser1');
    var jugador = document.getElementById('tipoUser2');
    var entrenador = document.getElementById('tipoUser3');
    var email = document.formulario_registro.Mail.value;
    var contrasena = document.formulario_registro.Password.value;
    var contrasena2 = document.formulario_registro.Password2.value;
    var seguri = document.formulario_registro.seguridad.value;
    var expSoloNum = /^[0-9]{1,2}$/;
    var expMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //var caracEspeciales = /[\^\`\´\*\[\]\+\@\%\&\|\,\.\;\:\{\}\$\?\¿\!\¡\-\_\']/;
    var caracNom = /^[[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/;
    var tipoUsu = document.formulario_registro.radiotipousuario.value;

    if (nik === null || nik.length === 0 || nik.length > 20 || vacio(nik) === false) {
        window.alert("Longitud de apodo incorrecta");
    } else if (usuario === null || usuario.length === 0 || usuario.length > 20 || vacio(usuario) === false) {
        window.alert("Longitud de nombre de usuario incorrecta");
    } else if (!caracNom.test(usuario)) {
        window.alert("El nombre solo debe contener letras");
    } else if (!expSoloNum.test(edad)) {
        window.alert("Introduce edad/antigüedad correcta");
    } else if (localidad === null || localidad.length === 0 || !document.getElementById('registro-localidad').readOnly || vacio(localidad) === false) {
        window.alert("Introduce una localidad");
    } else if (equipo.checked == true && $('input[name=radiotipoequipo]').is(':checked') == false) {
        window.alert("No has seleccionado un tipo de equipo");
    } else if (jugador.checked == true && ($('input[name=radioposicion]').is(':checked') == false || $('input[name=radiosexo]').is(':checked') == false)) {
        window.alert("No has seleccionado el sexo y/o posición");
    } else if (entrenador.checked == true && ($('input[name=radioentrenarequipo]').is(':checked') == false || $('input[name=radiosexo]').is(':checked') == false)) {
        window.alert("No has seleccionado el sexo y/o tipo de equipo a entrenar");
    } else if (!expMail.test(email)) {
        window.alert("Direccion de correo no valida");
    } else if (contrasena === null || contrasena.length === 0 || contrasena.length < 5 || contrasena.length > 15 || vacio(contrasena) === false) {
        window.alert("Longitud de contraseña incorrecta (Mínimo 5 - Máximo 15)");
    } else if (contrasena !== contrasena2 || vacio(contrasena2) === false) {
        window.alert("Las contraseñas no coinciden");
    } else if (seguri === null || seguri.length === 0 || seguri.length < 5 || seguri.length > 20 || vacio(seguri) === false) {
        window.alert("Longitud de palabra/frase incorrecta");
    } else
        document.formulario_registro.submit();





}

/*funcion que valida los campos del "Contacto". Comprueba que los campos no estan vacios,
 * que la longitud no sobrepase los 10 caracteres y que no se han introducido caracteres especiales en
 * ninguno de los dos campos. Si se cumplen todas las condiciones hara submit.
 */
function validacionContacto() {
    var email = document.formulario_contacto.Email.value;
    var asunto = document.formulario_contacto.Asunto.value;
    var inci = document.formulario_contacto.Incidencia.value;
    var expMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!expMail.test(email)) {
        window.alert("Direccion de correo no valida");
    } else if (asunto === null || asunto.length === 0 || asunto.length > 30 || vacio(asunto) === false) {
        window.alert("Longitud del asunto incorrecta");
    } else if (inci === null || inci.length === 0 || inci.length < 5 || vacio(inci) === false) {
        window.alert("Escriba su incidencia de forma detallada");
    } else
        document.formulario_contacto.submit();
}

//Función que comprueba si el campo esta vacío
function vacio(q) {
    for (i = 0; i < q.length; i++) {
        if (q.charAt(i) !== " ") {
            return true;
        }
    }
    return false;
}

// Función para mandar email a través de "mailto"
function mailto() {
    document.location.href = 'vista/mailtoContacto.jsp';
}


// Función que limpia los campos del formulario una vez que se da al modal "Contacto", "Registro","Login" y "has olvidado la contraseña".
function limpiarCampos() {
    document.getElementById("formulario_contacto").reset();
    document.getElementById("formulario_registro").reset();
    document.getElementById("formulario_login").reset();
}

//Funcion que limpia las fotos/videos al cargar antes de subirlas a la BD (limpia los input type=file)
function limpiarfotosvideos() {
    $('fileimagperf').val('');
}

//Funcion que desbloquea el input de búsqueda de localidad en el registro y oculta el botón 'Borrar Localidad'
function desbloquearLocalidad() {
    document.getElementById('registro-localidad').removeAttribute("readOnly");
    document.getElementById("registro-localidad").value = "";
    document.getElementById('btnLocalidad').style.display = 'none';
}

//Funcion que bloquea el input de búsqueda de localidad en el registro y muestra el botón 'Borrar Localidad'
function bloquearLocalidad() {
    document.getElementById("registro-localidad").readOnly = true;
    document.getElementById('btnLocalidad').style.display = 'block';
}

// En modalRegisro según el tipo de usuario que sea se mostrara unas opciones u otras.
function mostraropciones() {

    if (document.getElementById('tipoUser1').checked == true) {
        $("#tipo-equipo").show();
        $('input[name=radiosexo]').attr('checked', false);
        $("#sexo").hide();
        $('input[name=radioposicion]').attr('checked', false);
        $("#tipo-posicion").hide();
        $('input[name=radioentrenarequipo]').attr('checked', false);
        $("#tipo-entrenar-equipo").hide();
    } else if (document.getElementById('tipoUser2').checked == true) {
        $("#tipo-posicion").show();
        $("#sexo").show();
        $('input[name=radiosexo]').attr('checked', false);
        $('input[name=radiotipoequipo]').attr('checked', false);
        $("#tipo-equipo").hide();
        $('input[name=radioentrenarequipo]').attr('checked', false);
        $("#tipo-entrenar-equipo").hide();
    } else {
        $("#sexo").show();
        $("#tipo-entrenar-equipo").show();
        $('input[name=radiosexo]').attr('checked', false);
        $('input[name=radiotipoequipo]').attr('checked', false);
        $("#tipo-equipo").hide();
        $('input[name=radioposicion]').attr('checked', false);
        $("#tipo-posicion").hide();
    }
}

function valSalidaPerfil() {
    var resultado = confirm("¿Estás seguro de que quieres salir del Perfil?");
    if (resultado == true) {
        document.forms["fsalida"].submit();
    }
}

// slider redondo

function muestraSlider() {
    var i = 0;
    $("#slider").roundSlider({
        sliderType: "range",
        handleShape: "round",
        width: 22,
        radius: 80,
        value: "5,40",
        circleShape: "half-top",
        min: 5,
        max: 40,
        editableTooltip: false,
        tooltipFormat: function (e) {
            i++;
            if (i == 2) {
                i = 0;
                if (e.value == 40) {
                    return e.value + "+";
                }
            } else {
                return  e.value;
            }
        }
    });
}

//Dependiendo del usuario que escojamos, saldran unas opciones u otras

function mostrar(id) {
    if (id === "bus1") {
        $("#select-tipoequipo").show();
        $("#select-sex").hide();
        $("#select-edad").hide();


    }

    if (id === "bus2" || id === "bus3") {
        $("#select-tipoequipo").hide();
        $("#select-edad").show();
        $("#select-sex").show();
    }
}

// Deseleccionar las opciones radio button al refrescar la pagina

function check() {
    if (document.getElementById("bus1").checked === true) {
        $("#select-tipoequipo").show();
        $("#select-sex").hide();
        $("#select-edad").hide();
    } else {
        $("#select-tipoequipo").hide();
        $("#select-edad").show();
        $("#select-sex").show();
    }

}

// Mostraremos u ocultaremos el menu filtro cuando damos al boton


function mostrarfiltro() {
    if ($('#busgencerk').css('display') !== 'none') {
        $('#busgencerk').slideUp();
    } else {
        $('#busgencerk').slideDown();
    }
}

function ocultarfiltro() {
    $('#busgencerk').slideUp();
}
function mostrarPerfil() {
    $(".partederecha").hide();
    $(".miPerfil").show();
    $(".miInfo").hide();
    $(".miPerfilAjeno").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").show();
    $(".partederechafavoritos").hide();
    $(".partederechavisitas").hide();
    $('.miPerfilAjeno').hide();
}

function mostrarPerfilAjeno(codUsuAjeno) {
    $(".footbar").hide();
    $(".partederecha").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".partederechafavoritos").hide();
    $(".partederechavisitas").hide();
    $(".miPerfilAjeno").show();
    $(".bcard").show();
    //Usamos la llamada ajax
    $.ajax({
        url: '../GestionarCodUsuAjeno',
        data: {
            codUsuAjeno: codUsuAjeno
        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);

            if (data == "Equipo") {
                $('.pagina_').append($('<div class="miPerfilAjeno"></div><footer class="footbar"></footer>'));
                console.log("Ha entrado en perfil EQUIPO: ");
                $('.miPerfilAjeno').load('ajenoPerfilEquipo.jsp?' + $.param({codUsuAjeno: codUsuAjeno}));
                $('.footbar').load('footerhome.jsp');
            } else {
                $('.pagina_').append($('<div class="miPerfilAjeno"></div><footer class="footbar"></footer>'));
                console.log("Ha entrado en perfil JUGADOR ENTRENADOR: ");
                $('.miPerfilAjeno').load('ajenoPerfilJugadorEntrenador.jsp?' + $.param({codUsuAjeno: codUsuAjeno}));
                $('.footbar').load('footerhome.jsp');
            }
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
    $.ajax({
        url: '../GestionarVisitas',
        data: {
            codUserAje: codUsuAjeno // Este dato se envia a la url

        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}

// Slider que muestra los Km de distancia para filtrar el rango de busquedad desde tu localidad.
function muestraSliderKm() {
    $("#range_09").ionRangeSlider({
        grid: true,
        from: 0,
        values: [
            "Ciudad", "10", "25", "35", "50", "Pais"
        ]
    });
}
;

function mostrarpartederecha() {
    $("#partederechavisitas").hide();
    $("#partederechafavoritos").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").hide();
    $("#partederecha").show();
    $('.miPerfilAjeno').hide();
}
function mostrarfavoritos() {
    $("#partederecha").hide();
    $("#partederechavisitas").hide();
    $(".contenedormisfavoritos").hide();
    $(".contenedorfavoritosde").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").hide();
    $('.miPerfilAjeno').hide();
    $("#partederechafavoritos").show();
    $(".contenedorimagenfavoritos").show();
}
function enseñarmisfavoritos() {
    $(".contenedorimagenfavoritos").hide();
    $(".contenedorfavoritosde").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").hide();
    $(".contenedormisfavoritos").show();
}
function enseñarfavoritosde() {
    $(".contenedorimagenfavoritos").hide();
    $(".contenedormisfavoritos").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").hide();
    $(".contenedorfavoritosde").show();
    $.ajax({
        url: '../GestionarResetNumFavoritos',
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}
function mostrarvisitas() {
    $("#partederecha").hide();
    $("#partederechafavoritos").hide();
    $(".miPerfil").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".bcard").hide();
    $('.miPerfilAjeno').hide();
    $("#partederechavisitas").show();
    $.ajax({
        url: '../GestionarResetNumVisitas',
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}

function mostrarPerfilInfo() {
    $(".bcard").show();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
}
function mostrarInfo() {
    $(".miInfo").show();
    $(".bcard").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
}
function mostrarInfoAjeno(codUsuAjeno) {
    $(".miInfo").show();
    $(".bcard").hide();
    $(".miAjuste").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $.ajax({
        url: '../GestionarAjenoInfo',
        data: {
            codUsuAjeno: codUsuAjeno // Este dato se envia a la url
        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);


        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}
function mostrarAjustes() {
    $(".miAjuste").show();
    $(".bcard").hide();
    $(".miInfo").hide();
    $(".misFotosVideos").hide();
    $(".fotoVideo").hide();
    $(".tarjetas").show();
    $(".formulcambiarpass").hide();
    $(".borrarcuenta").hide();
    $(".usubloq").hide();
    document.formulario_fotoperfil.b_borrar.click();
}

function mostrarImaVideo() {
    $(".fotoVideo").hide();
    $(".misFotosVideos").show();
    $(".bcard").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
    document.formulario_fotoscarga.b_borrarfoto.click();
    document.formulario_videoscarga.b_borrarvideo.click();
}

function mostrarImaVideoAjeno() {
    $(".misFotosVideos").hide();
    $(".fotoVideo").show();
    $(".bcard").hide();
    $(".miInfo").hide();
    $(".miAjuste").hide();
}

function visualizarSoloFoto() {
    if ($('#fotoMiPerfil').css('display') !== 'none') {
        $('#fotoMiPerfil').slideUp();
        $(".txtmisfotvid").show();
    } else {
        $('#fotoMiPerfil').slideDown();
        $("#videoMiPerfil").hide();
        $(".txtmisfotvid").hide();
    }
}
function visualizarSoloVideo() {
    if ($('#videoMiPerfil').css('display') !== 'none') {
        $('#videoMiPerfil').slideUp();
        $(".txtmisfotvid").show();
    } else {
        $('#videoMiPerfil').slideDown();
        $("#fotoMiPerfil").hide();
        $(".txtmisfotvid").hide();
    }
}

function oculFotoVideoPerfil() {
    $(".fotoMiPerfil").hide();
    $(".videoMiPerfil").hide();
}

function muestrobtnperfilelim() {
    if ($("#imagenperfil").css('display') !== 'none') {
        $("#iconoperfil").show();
    } else if ($("#video").css('display') !== 'none') {
        $("#iconoperfil").hide();
    }
}

function cambiarpass() {
    $(".tarjetas").hide();
    $(".formulcambiarpass").show();
    document.getElementById("formulario_recupass").reset();

}
function eliminarcuenta() {
    $(".tarjetas").hide();
    $(".borrarcuenta").show();
}
function usuariosbloqueados(bloq) {
    $(".tarjetas").hide();
    $(".usubloq").show();
    $.ajax({
        url: '../GestionarBloqueados',
        data: {
            bloquear: bloq

        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}

function salirborrarcuenta() {
    $(".tarjetas").show();
    $(".borrarcuenta").hide();
}
function seleccionarprimeraopcion() {
    $("#usbloq option:selected").prop("selected", false);
    $("#usbloq option:first").prop("selected", "selected");
}

//Funcion que muestra mensaje de alerta al borrar una foto o video
function eliminarvideofoto(coduser) {
    var resultado = confirm("¿Estás seguro de que quieres borrar?");
    if (resultado == true) {
        var imagehref = $(".html5gallery-tn-selected-0 img").attr("src");
        var vidurl = $(".html5gallery-elem-video-0 .html5gallery-elem-video-container-0 video").attr("src");
        if (!vidurl == "") {
            $.ajax({
                url: '../GestionarBorradoImgVid',
                data: {
                    codUser: coduser, // Este dato se envia a la url
                    urlVideo: vidurl,
                    urlImagen: ""
                },
                type: 'POST',
                success: function (data) {
                    console.log("Ha ido correcto el ajax: " + data);


                },
                error: function () {
                    console.log("Ha fallado el ajax.");
                }
            });
        } else {
            $.ajax({
                url: '../GestionarBorradoImgVid',
                data: {
                    codUser: coduser, // Este dato se envia a la url
                    urlImagen: imagehref,
                    urlVideo: ""
                },
                type: 'POST',
                success: function (data) {
                    console.log("Ha ido correcto el ajax: " + data);


                },
                error: function () {
                    console.log("Ha fallado el ajax.");
                }
            });
        }


        window.location.href = "home.jsp";
    }
}

//Funcion que valida que se ha realizado la busqueda correctamente en la home
function validarBusquedaHome(codUsu) {
    var locali = "";
    var pais = "";
    var ciudad = "";
    //Guardamos los valores que utilizaremos posteriormente en la clase Java
    var busTipoUsu = $('input[name="bus"]:checked').val();

    if (busTipoUsu == "Equipo") {
        var equipo = $('input[name="tipoequipo"]:checked').val();
        var tipoequipo = new Array();

        //Si se ha seleccionado Todos, se muestran todos los tipos de equipo y sino el seleccionado
        if (equipo == "Todos") {
            tipoequipo.push("Federado");
            tipoequipo.push("Amateur");
        }
        else {
            tipoequipo.push(equipo);
        }
    } else {
        var tipsexo = $('input[name="sexo"]:checked').val();
        var sexo = new Array();

        //Si se ha seleccionado Todos, se muestran todos los tipos de equipo y sino el seleccionado
        if (tipsexo == "Todos") {
            sexo.push("Federado");
            sexo.push("Amateur");
        }
        else {
            sexo.push(tipsexo);
        }

        //Obtenemos el valor del primer elemento del slider (El minimo)
        var edadDesde = document.querySelector('[aria-label="slider_handle_start"]').getAttribute('aria-valuenow');
        //Obtenemos el valor del ultimo elemento del slider (El maximo)
        var edadHasta = document.querySelector('[aria-label="slider_handle_end"]').getAttribute('aria-valuenow');
    }

    //Obtenemos el input del texto de localidad
    var localidad = document.getElementById("registro-localidad").value;
    //Obtenemos el valor del slider de rango
    var slider = $("#range_09").data("ionRangeSlider");
    var valSlider = slider.input.value;

    if (localidad == null || localidad == "") {
        $.ajax({
            url: '../GestionarBusGenteCerca',
            data: {
                codUsu: codUsu
            },
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax.");
                locali = data.localidades[0];
                pais = data.localidades[1];
                
                var key = "AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE";
                var lat = "";
                var lng = "";
                var urlCord = "";
                var busLocali = new Array();
                if (valSlider != "Pais") {
                    if (locali != "") {
                        urlCord = "https://maps.googleapis.com/maps/api/geocode/json?address=" + locali + "&key=" + key;
                    } else {
                        window.alert("No se han encontrado registros");
                    }

                    console.log("URL loc: " + urlCord);

                    var estilo = "short";
                    var numMaxCiudades = "100000";
                    var distancia = "1"; //Distancia en km
                    //Si el slider no esta en pais o ciudad, se coge el radio que tenga el slider, en caso contrario solo cogemos el primer kilometro
                    if (valSlider != "Pais" && valSlider != "Ciudad") {
                        distancia = valSlider;
                    }

                    var nomUsu = "meeteam";
                    var idioma = "es";

                    //Obtenemos el valor lat y lng para obtener la ubicación precisa
                    $.getJSON(urlCord, function (data) {
                        if (data.results.length != 0) {
                            for (var i = 0; i < data.results.length; i++) {
                                if (lat == "") {
                                    lat = data.results[i].geometry.location.lat;
                                }
                                if (lng == "") {
                                    lng = data.results[i].geometry.location.lng;
                                }
                            }
                        } else {
                            window.alert("No se han encontrado registros2");
                        }

                        var urlCiudades = "http://api.geonames.org/findNearbyPlaceNameJSON?lat=" + lat + "&lng=" + lng + "&style=" + estilo + "&radius=" + distancia + "&maxRows=" + numMaxCiudades + "&username=" + nomUsu + "&lang=" + idioma;

                        console.log("URL ciud: " + urlCiudades);

                        //Obtenemos todos los valores de ciudades en el radio indicado
                        $.getJSON(urlCiudades, function (data) {
                            console.log(data);
                            if (data.geonames.length != 0) {
                                for (var i = 0; i < data.geonames.length; i++) {
                                    busLocali.push(data.geonames[i].name);
                                    console.log("Ciudades: " + busLocali);
                                }
                                //Usamos la llamada ajax
                                $.ajax({
                                    url: '../GestionarBusGenteCerca',
                                    data: {
                                        busLocali: busLocali,
                                        busTipoUsu: busTipoUsu,
                                        tipoequipo: tipoequipo,
                                        sexo: sexo,
                                        edadDesde: edadDesde,
                                        edadHasta: edadHasta
                                    },
                                    type: 'POST',
                                    success: function (data) {
                                        console.log("Ha ido correcto el ajax.");
                                        location.reload();
                                    },
                                    error: function () {
                                        console.log("Ha fallado el ajax.");
                                    }
                                });

                            } else {
                                window.alert("No se han encontrado registros3");
                            }
                        });
                    });
                } else { //Si el radio esta en el Pais, obtenemos solo la variable de pais como ciudad
                    busLocali.push(pais);
                    console.log("Pais: " + busLocali);
                    $.ajax({
                        url: '../GestionarBusGenteCerca',
                        data: {
                            busLocali: busLocali,
                            busTipoUsu: busTipoUsu,
                            tipoequipo: tipoequipo,
                            sexo: sexo,
                            edadDesde: edadDesde,
                            edadHasta: edadHasta
                        },
                        type: 'POST',
                        success: function (data) {
                            console.log("Ha ido correcto el ajax.");
                            location.reload();
                        },
                        error: function () {
                            console.log("Ha fallado el ajax.");
                        }
                    });
                    //localStorage.setItem("busLocali", JSON.stringify(busLocali));
                }
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    } else {
        // recogemos el valor de la localidad
        locali = localStorage.getItem("localidad");
        ciudad = localStorage.getItem("ciudad");
        pais = localStorage.getItem("pais");
        var region = localStorage.getItem("region");

        var key = "AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE";
        var lat = "";
        var lng = "";
        var urlCord = "";
        var busLocali = new Array();

        if (valSlider != "Pais") {
            if (locali != "" && region != "") { //Entra aqui si es localidad
                urlCord = "https://maps.googleapis.com/maps/api/geocode/json?address=" + locali + "&key=" + key + "&region=" + region;
            } else if (locali == "" && ciudad != "" && region != "") { //Entra aqui si es ciudad
                urlCord = "https://maps.googleapis.com/maps/api/geocode/json?address=" + ciudad + "&key=" + key + "&region=" + region;
            } else if (region == "") {
                urlCord = "https://maps.googleapis.com/maps/api/geocode/json?address=" + locali + "&key=" + key;
            } else {
                window.alert("No se han encontrado registros");
            }

            console.log("URL loc: " + urlCord);

            var estilo = "short";
            var numMaxCiudades = "100000";
            var distancia = "1"; //Distancia en km
            //Si el slider no esta en pais o ciudad, se coge el radio que tenga el slider, en caso contrario solo cogemos el primer kilometro
            if (valSlider != "Pais" && valSlider != "Ciudad") {
                distancia = valSlider;
            }

            var nomUsu = "meeteam";
            var idioma = "es";

            //Obtenemos el valor lat y lng para obtener la ubicación precisa
            $.getJSON(urlCord, function (data) {
                if (data.results.length != 0) {
                    for (var i = 0; i < data.results.length; i++) {
                        if (lat == "") {
                            lat = data.results[i].geometry.location.lat;
                        }
                        if (lng == "") {
                            lng = data.results[i].geometry.location.lng;
                        }
                    }
                } else {
                    window.alert("No se han encontrado registros2");
                }

                var urlCiudades = "http://api.geonames.org/findNearbyPlaceNameJSON?lat=" + lat + "&lng=" + lng + "&style=" + estilo + "&radius=" + distancia + "&maxRows=" + numMaxCiudades + "&username=" + nomUsu + "&lang=" + idioma;

                console.log("URL ciud: " + urlCiudades);

                //Obtenemos todos los valores de ciudades en el radio indicado
                $.getJSON(urlCiudades, function (data) {
                    console.log(data);
                    if (data.geonames.length != 0) {
                        for (var i = 0; i < data.geonames.length; i++) {
                            busLocali.push(data.geonames[i].name);
                            console.log("Ciudades: " + busLocali);
                        }
                        //Usamos la llamada ajax
                        $.ajax({
                            url: '../GestionarBusGenteCerca',
                            data: {
                                busLocali: busLocali,
                                busTipoUsu: busTipoUsu,
                                tipoequipo: tipoequipo,
                                sexo: sexo,
                                edadDesde: edadDesde,
                                edadHasta: edadHasta
                            },
                            type: 'POST',
                            success: function (data) {
                                console.log("Ha ido correcto el ajax.");
                                location.reload();
                            },
                            error: function () {
                                console.log("Ha fallado el ajax.");
                            }
                        });

                    } else {
                        window.alert("No se han encontrado registros3");
                    }
                });
            });
        } else { //Si el radio esta en el Pais, obtenemos solo la variable de pais como ciudad
            busLocali.push(pais);
            console.log("Pais: " + busLocali);
            $.ajax({
                url: '../GestionarBusGenteCerca',
                data: {
                    busLocali: busLocali,
                    busTipoUsu: busTipoUsu,
                    tipoequipo: tipoequipo,
                    sexo: sexo,
                    edadDesde: edadDesde,
                    edadHasta: edadHasta
                },
                type: 'POST',
                success: function (data) {
                    console.log("Ha ido correcto el ajax.");
                    location.reload();
                },
                error: function () {
                    console.log("Ha fallado el ajax.");
                }
            });
            //localStorage.setItem("busLocali", JSON.stringify(busLocali));
        }
    }
}

function cambioBusqueda(elemento) {
    var nomBusqueda = "";
    if (elemento.value == "" || elemento.value == "1") { //Si el elemento es usuario o todos, mostramos tambien todos los usuarios
        nomBusqueda = "Todos";
    } else if (elemento.value == "2") { //Si el elemento es Online, mostramos los usuarios que están online
        nomBusqueda = "Online";
    } else if (elemento.value == "3") { //Si el elemento es Nuevos, mostramos los usuarios nuevos de dos dias.
        nomBusqueda = "Nuevos";
    }

    //Usamos la llamada ajax
    $.ajax({
        url: '../GestionarBusGenteCerca2',
        data: {
            nomBusqueda: nomBusqueda
        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax.");
            location.reload();
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}

function cargaBusqueda() {
    var nomBusqueda = document.getElementById("registro-usuario").value;

    if (nomBusqueda == "" || nomBusqueda == "1") { //Si el elemento es usuario o todos, mostramos tambien todos los usuarios
        nomBusqueda = "Todos";
    } else if (nomBusqueda == "2") { //Si el elemento es Online, mostramos los usuarios que están online
        nomBusqueda = "Online";
    } else if (nomBusqueda == "3") { //Si el elemento es Nuevos, mostramos los usuarios nuevos de dos dias.
        nomBusqueda = "Nuevos";
    }

    //Usamos la llamada ajax
    $.ajax({
        url: '../GestionarBusGenteCerca2',
        data: {
            nomBusqueda: nomBusqueda
        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax.");
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });

}


function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)), sURLVariables = sPageURL.split('&'), sParameterName, i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function validacionInfoJugaEntr() {
    var infoJugEnt = document.formulario_infoJugEntr.textareainfo.value;
    var expJugEnt = document.formulario_infoJugEntr.textareaexp.value;
    var quebuscaJugEnt = document.formulario_infoJugEntr.textareabusqueda.value;
    if (infoJugEnt === null || infoJugEnt.length === 0 || vacio(infoJugEnt) === false) {
        window.alert("No has introducido información sobre ti");
    } else if (expJugEnt === null || expJugEnt.length === 0 || vacio(expJugEnt) === false) {
        window.alert("No has introducido que experiencia tienes");
    } else if (quebuscaJugEnt === null || quebuscaJugEnt.length === 0 || vacio(quebuscaJugEnt) === false) {
        window.alert("No has introducido que buscas");
    } else
        document.formulario_infoJugEntr.submit();
}
function validacionInfoEqui() {
    var infoClub = document.formulario_infoEqu.textareainfoClub.value;
    var trayect = document.formulario_infoEqu.textareatray.value;
    var quebuscaEqui = document.formulario_infoEqu.textareabusqueda.value;
    if (infoClub === null || infoClub.length === 0 || vacio(infoClub) === false) {
        window.alert("No has introducido información sobre el club");
    } else if (trayect === null || trayect.length === 0 || vacio(trayect) === false) {
        window.alert("No has introducido que trayectoria tiene el club");
    } else if (quebuscaEqui === null || quebuscaEqui.length === 0 || vacio(quebuscaEqui) === false) {
        window.alert("No has introducido que busca el club");
    } else
        document.formulario_infoEqu.submit();
}


function borrarInfor() {
    document.formulario_infoJugEntr.textareainfo.value = "";
    document.formulario_infoJugEntr.textareaexp.value = "";
    document.formulario_infoJugEntr.textareabusqueda.value = "";
    document.formulario_infoJugEntr.textareainfoClub.value = "";
    document.formulario_infoJugEntr.textareatray.value = "";
}

function bloquearUsu(userAjen) {
    var resultado = confirm("¿Estás seguro de que quieres bloquearlo?");
    if (resultado == true) {
        $.ajax({
            url: '../GestionarBloqueados',
            data: {
                codUserAje: userAjen // Este dato se envia a la url
            },
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax: " + data);
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    }
    window.location.href = "../vista/home.jsp";
}

function favoritoUsu(userAjen) {
    var resultado = confirm("¿Quieres añadirlo como favorito?");
    if (resultado == true) {
        $.ajax({
            url: '../GestionarFavoritos',
            data: {
                codUserAje: userAjen // Este dato se envia a la url

            },
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax: " + data);
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    }
    window.location.href = "../vista/home.jsp";
}

function desbloquear() {
    var usuDesbloq = document.getElementById("usbloq").value;
    var x = document.getElementById("usbloq");
    x.remove(x.selectedIndex);
    $.ajax({
        url: '../GestionarDesbloqueados',
        data: {
            nikUserDesbloq: usuDesbloq // Este dato se envia a la url

        },
        type: 'POST',
        success: function (data) {
            console.log("Ha ido correcto el ajax: " + data);
        },
        error: function () {
            console.log("Ha fallado el ajax.");
        }
    });
}
function quitarFavorito(usuquitFavor) {
    var resultado = confirm("¿Estás seguro de que quieres quitarlo de favoritos?");
    if (resultado == true) {
        $.ajax({
            url: '../GestionarQuitarFavoritos',
            data: {
                codUserFavor: usuquitFavor // Este dato se envia a la url

            },
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax: " + data);
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    }
    window.location.href = "../vista/home.jsp";
}


function añadirteAmistoso() {
    var resultado = confirm("¿Quieres añadirte a la bolsa de amistosos?");
    if (resultado == true) {
        $.ajax({
            url: '../GestionarIncluirAmistoso',
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax: " + data);
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    }
    window.location.href = "../vista/home.jsp";
}

function eliminarteAmistoso() {
    var resultado = confirm("¿Estas seguro que quieres eliminarte de la bolsa de amistosos?");
    if (resultado == true) {
        $.ajax({
            url: '../GestionarEliminarAmistoso',
            type: 'POST',
            success: function (data) {
                console.log("Ha ido correcto el ajax: " + data);
            },
            error: function () {
                console.log("Ha fallado el ajax.");
            }
        });
    }
    window.location.href = "../vista/home.jsp";
}