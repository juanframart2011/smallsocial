function init() {

    var input = document.getElementById( 'registro-localidad' );
    var opts = {
        types: ['(cities)']
    };
    var autocomplete = new google.maps.places.Autocomplete(input, opts);

    //Bloqueamos el input si seleccionamos una localidad y hacemos visible el botón 'Borrar Localidad'
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        
        var result = autocomplete.getPlace();
        var localidad = "";
        var ciudad = "";
        var pais = "";
        var region = "";
        var lat = "";
        var lng = "";

        lat = result.geometry.location.lat();
        lng = result.geometry.location.lng();

        for (var i = 0; i < result.address_components.length; i++) {

            var addressObj = result.address_components[i];

            for (var j = 0; j < addressObj.types.length; j++) {
                //console.log(addressObj.types[j]);
                //Si es una localidad
                if (addressObj.types[j] == 'neighborhood') {
                    localidad = addressObj.long_name;
                }
                //Si es una ciudad
                if (addressObj.types[j] == 'locality') {
                    ciudad = addressObj.long_name;

                }
                //Si es un pais cogemos region tambien
                if (addressObj.types[j] == 'country') {
                    pais = addressObj.long_name;
                    region = addressObj.short_name;
                }
            }
        }

        // Guardamos localmente el valor de la localidad
        localStorage.setItem( "localidad", localidad );
        localStorage.setItem( "ciudad", ciudad );
        localStorage.setItem( "pais", pais );
        localStorage.setItem( "region", region );
        localStorage.setItem( "lat", lat );
        localStorage.setItem( "lng", lng );

        $( "#ciudad" ).val( ciudad );
        $( "#pais" ).val( pais );
        $( "#region" ).val( region );
        $( "#lat" ).val( lat );
        $( "#lng" ).val( lng );

        document.getElementById('registro-localidad').readOnly = true;
        document.getElementById('btnLocalidad').style.display = 'block';
    });
}
google.maps.event.addDomListener(window, 'load', init);

function desbloquearLocalidad(){

    document.getElementById('registro-localidad').removeAttribute("readOnly");
    document.getElementById("registro-localidad").value = "";
    document.getElementById('btnLocalidad').style.display = 'none';
}