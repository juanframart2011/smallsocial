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
                
                var value_see = 0;
                var km_value = this.value;

                if( this.value < 100 ){

                    if( this.value == 0 ){

                        km = "Ciudad";
                    }
                    else{

                        km = this.value + "Km";
                    }
                }
                else{

                    km = "Todo México";
                    value_see = 1;
                }

                $.ajax({
                    url: 'search_km.php',
                    type: 'POST',
                    dataType: 'HTML',
                    data: {km: km_value,see:value_see},
                })
                .done(function( data ){

                    $( ".content-user" ).html( data );
                })
                .fail(function( error ) {
                    console.log( error );
                })
                .always(function() {
                    console.log("complete");
                });
                
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

    function validarBusquedaHome(codUsu) {

        var locali = "";
        var pais = "";
        var ciudad = "";
        //Guardamos los valores que utilizaremos posteriormente en la clase Java
        var busTipoUsu = $('input[name="bus"]:checked').val();

        //Obtenemos el input del texto de localidad
        var localidad = document.getElementById("registro-localidad").value;
        //Obtenemos el valor del slider de rango
        var slider = $("#range_09").data("ionRangeSlider");
        var valSlider = slider.input.value;

        if (localidad == null || localidad == "") {

            $.ajax({

                url: 'buscargente.php',
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
        }
        else{
            
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
});