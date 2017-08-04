<%-- 
Document   : home
Created on : 28-oct-2016, 17:43:30
Author     : Orion
--%>

<%@page import="java.util.ArrayList"%>
<%@ page import="modelo.BD" %>
<%@ page import="modelo.Usuario" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>

<!-- Para que no entre directamente al home-->
<%
    String nombreurl = request.getParameter("name"); // Recogemos la variable que se pase por la URL (name)
    Integer numFavoritos = 0;
    Integer numVisitas = 0;
    Integer numMensajes = 0;
    String usuario = "";
    String imageurl = "";
    String file = "";
    Usuario usr = new Usuario();
    BD bd = new BD();
    if (session.getAttribute("codUsuario") == null || session.getAttribute("codUsuario").equals("")) {
        response.sendRedirect("../index.jsp");
    } else {
        String coduser = (String) session.getAttribute("codUsuario");
        imageurl = bd.getImagePerf(coduser);
        usr = bd.getUserData(coduser);

        if (imageurl != "../img/imagenperfildefecto.png") {
            file = imageurl.substring(imageurl.lastIndexOf("\\") + 1);
            imageurl = "..//imagenPerfil//" + file;
        }
        usuario = usr.getTipoUsu();
        numFavoritos = usr.getContFavoritos();
        numVisitas = usr.getContVisitas();
        numMensajes = usr.getContMensajes();
    }
%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Shortcut Icon" href="../img/balon.png">
        <link href="../css/roundslider.min.css" rel="stylesheet" /> 
        <link href="../css/estilosHome.css" rel="stylesheet" />
        <link href="../css/estilosPerfil.css" rel="stylesheet" />
        <link href="../css/ion.rangeSlider.skinHTML5.css" rel="stylesheet" />
        <link href="../css/ion.rangeSlider.css" rel="stylesheet" />
       	<link href="../css/font-awesome.css" rel="stylesheet">
        <link href="../css/estilosBotonesInfo.css" rel="stylesheet">
        <link href="../css/estilosFotosVideos.css" rel="stylesheet">
        <link href="../css/estilosajustes.css" rel="stylesheet">
        <link href="../css/pgwslideshow.min.css" rel="stylesheet">


        <link href="../css/elastislide.css" rel="stylesheet">
        <link href="../css/custom.css" rel="stylesheet">
        <script src="../js/modernizr.custom.17475.js"></script>

        <script src="../js/jquery.min.js"></script>
        <script src="../js/roundslider.min.js"></script>
        <script src="../js/validacion.js"></script>
        <script src="../js/ion.rangeSlider.min.js"></script>
        <script src="../js/pgwslideshow.min.js"></script>
        <script src="../js/html5gallery.js"></script>
        <script src="../js/froogaloop2.min.js"></script>
        <title>MeeTeam</title>
    </head>
    <body onLoad="alertName();
            muestraSlider();
            check();
            desbloquearLocalidad();
            muestraSliderKm();
            oculFotoVideoPerfil();">

        <div class="pagina">
            <div class="pagina_">                
                <aside class="partIzq">                   
                    <div class="logogrande">
                        <a class="ahome" href="home.jsp">
                            <img src="../img/meeTeam.png" alt="" class="logo" width="114" height="33"> <!--Logo pantalla ancha-->
                            <img src="../img/meeTeamIco.png" alt="" class="logo-ico" width="44" height="44"> <!--Logo al reducir la pantalla-->
                        </a>
                    </div>
                    <div class="logoperfilcoins">
                        <div class="logoperfil">
                            <div class="imagenperfil">
                                <img class="imagenperfil_ico" src="<%=imageurl%>" alt="" width="40" height="40">
                                <a id="perfil" class="irPerfil" onclick="mostrarPerfil()"></a>
                            </div>
                            <div class="sobremiperfil">
                                <b class="textoperfil">
                                    <a id="perfil" class="irtextoperfil" onclick="mostrarPerfil()"><%=usr.getNick()%></a>
                                </b>
                            </div>
                            <div class="salirperfil">
                                <img class="salirperfil_ico" src="../img/icon-exit.png" alt="" width="20" height="20">
                                <form action="${pageContext.request.contextPath}/logout" name="fsalida" method="post">
                                    <a class="salirPer" onclick="valSalidaPerfil();"></a>
                                </form>
                            </div>
                        </div>
                        <div class="logocoins">
                            <div class="imagencoins">

                                <a class="irMonedas" href="monedas.jsp"></a>
                            </div>
                            <div class="textomonedas">
                                <b class="textomone">Créditos</b>
                            </div>
                            <div class="cantimonedas">
                                <a class="textocantmonedas">0</a>
                            </div>
                        </div>
                    </div>
                    <div class="asidemenu">
                        <div class="gentecerca">
                            <div class="gentecerca_ico">
                                <img class="imagengentecerca" src="../img/Lupa.png" alt="" width="20" height="20">                                    
                            </div>                                
                            <div class="textogentecerca">
                                <b class="textogentcer">Gente Cerca</b>
                            </div>
                            <a class="irgentecerca" href="home.jsp" onclick="mostrarpartederecha()"></a>
                        </div>
                        <div class="mensajes">                               
                            <div class="mensajes_ico">
                                <img class="imagenmensajes" src="../img/mensajes.png" alt="" width="20" height="20">                                    
                            </div>                                
                            <div class="textomensajes">
                                <b class="textomensaj">Mensajes</b>
                            </div>                                
                            <div class="nummensajes">
                                <a class="textonummensajes"><%=numMensajes%></a> <!-- Introducir etiqueta parpadea-->
                            </div>
                            <a class="irmensajes" href="chat.jsp"></a>
                        </div> 
                        <div class="favoritos">
                            <div class="favoritos_ico">
                                <img class="imagenfavoritos" src="../img/favoritos.png" alt="" width="20" height="20">                                    
                            </div>                                
                            <div class="textofavoritos">
                                <b class="textofavori">Favoritos</b>
                            </div>
                            <div class="numfavoritos">
                                <%
                                    numFavoritos = usr.getContFavoritos();
                                    if (numFavoritos == 0) {
                                %>
                                <a class="textonumfavoritos0"><%=numFavoritos%></a> <!-- Introducir etiqueta parpadea-->
                                <%} else {%>
                                <a class="textonumfavoritos"><%=numFavoritos%></a> <!-- Introducir etiqueta parpadea-->
                                <%
                                    }
                                %>
                            </div>
                            <a class="irfavorit" href="#" onclick="mostrarfavoritos()"></a>
                        </div> 
                        <div class="visitas">
                            <div class="visitas_ico">
                                <img class="imagenvisitas" src="../img/ojo.png" alt="" width="20" height="20">                                    
                            </div>                                
                            <div class="textovisitas">
                                <b class="textovisit">Visitas</b>
                            </div>
                            <div class="numvisitas">
                                <%
                                    numVisitas = usr.getContVisitas();
                                    if (numVisitas == 0) {
                                %>                                
                                <a class="textonumvisitas0"><%=numVisitas%></a> <!-- Introducir etiqueta parpadea-->
                                <%} else {%>
                                <a class="textonumvisitas"><%=numVisitas%></a> <!-- Introducir etiqueta parpadea-->
                                <%
                                    }
                                %>
                            </div>
                            <a class="irvisitas" href="#" onclick="mostrarvisitas()"></a>
                        </div> 
                        <div class="aplicacion">
                            <div class="aplicacion_ico">
                                <img class="imagenaplicacion" src="../img/aplicacion.png" alt="" width="20" height="20">                                    
                            </div>                                
                            <div class="textoaplicacion">
                                <b class="textoaplic">¡Descarga la app!</b>
                            </div>
                            <a class="iraplicacion" href="intento.jsp"></a>
                        </div> 
                    </div>
                </aside>                
                <main class="partederecha" id="partederecha">
                    <div class="cabecera">
                        <header class="seccion-header--cuadro">
                            <div class="textotitulo">
                                <b class="titulo">Gente cerca</b>
                            </div>                            
                            <div class="busqueda">
                                <div class="botonfiltro">
                                    <img class="imagenbotonfiltro" src="../img/filtro.png" alt="" width="20" height="20">
                                    <a id="imgfiltro" class="btnfiltro" onclick="mostrarfiltro()"></a>
                                </div> 
                                <div class="dropdown">                                    
                                    <div class="dropbtn">
                                        <select class="formboton" id="registro-usuario" name="Usu" required="" onchange="cambioBusqueda(this);">
                                            <option value="" disabled selected>Usuario</option>
                                            <option value="1">Todos</option>
                                            <option value="2">Online</option>
                                            <option value="3">Nuevos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                    <div id="busgencerk" class="busGenteCerca">
                        <form action="GestionarBusGenteCerca" method="POST" class="formBusGente" id="formBusGenteCerca" name="formBusGenteCerca">
                            <div class="filtroBusqueda">
                                <div class="busQuiero">
                                    <div class="titbusQuiero">
                                        <span class="txtBusQuiero">Busco</span>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioBusquedaQuiero" name="bus" id="bus1" value="Equipo" onclick="mostrar('bus1')"type="radio" checked>
                                        <label for="bus1">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Equipos</label>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioBusquedaQuiero" name="bus" id="bus2" value="Jugador" onclick="mostrar('bus2')" type="radio">
                                        <label for="bus2">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Jugadores</label>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioBusquedaQuiero" name="bus" id="bus3" value="Entrenador" onclick="mostrar('bus3')" type="radio">
                                        <label for="bus3">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Entrenadores</label>
                                    </div>
                                </div>                                
                                <div class="busSexo" id="select-sex">
                                    <div class=titbusSexo>
                                        <span class="txtBusSexo">Sexo</span>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioSexo" name="sexo" id="bus4" value="Hombre" type="radio" checked>
                                        <label for="bus4">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Hombre</label>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioSexo" name="sexo" id="bus5" value="Mujer" type="radio">
                                        <label for="bus5">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Mujer</label>
                                    </div> 
                                    <div class="radiosQuiero">
                                        <input class="radioSexo" name="sexo" id="bus6" value="Todos" type="radio">
                                        <label for="bus6">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Todos</label>
                                    </div>
                                </div>
                                <div class="bustipoequipo" id="select-tipoequipo">
                                    <div class="titbustipoequipo">
                                        <span class="txtBusSexo">Tipo Equipo</span>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioEquipo" name="tipoequipo" id="bus7" value="Federado" type="radio" checked>
                                        <label for="bus7">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Federado</label>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioEquipo" name="tipoequipo" id="bus8" value="Amateur" type="radio">
                                        <label for="bus8">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Amateur</label>
                                    </div>
                                    <div class="radiosQuiero">
                                        <input class="radioEquipo" name="tipoequipo" id="bus9" value="Todos" type="radio">
                                        <label for="bus9">
                                            <img src="../img/radioVacio.png">
                                        </label>
                                        <label class="lblBusquedaQuiero">Todos</label>
                                    </div>  
                                </div>
                                <div class="busEdad" id="select-edad">
                                    <div class="titbusEdad">                                       
                                        <span class="txtEdad">Edad</span>
                                    </div>
                                    <div id="slider"></div>
                                </div>
                                <div class="busLocalidad">
                                    <div class="titbusLocalidad">
                                        <span for="registro-localidad" class="txtLocalidad">Localidad</span>
                                    </div>
                                    <div class="busquedaLoc">
                                        <input type="text" class="cuadrolocalidad" id="registro-localidad" name="Location" placeholder="¿Dónde quiero buscar?">
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
                                                    var localidad = "";
                                                    var ciudad = "";
                                                    var pais = "";
                                                    var region = "";
                                                    //addressObj.types[j] - confirma que es un pais
                                                    //addressObj.long_name - se obtiene el nombre del pais
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
                                                    localStorage.setItem("localidad", localidad);
                                                    localStorage.setItem("ciudad", ciudad);
                                                    localStorage.setItem("pais", pais);
                                                    localStorage.setItem("region", region);

                                                    document.getElementById('registro-localidad').readOnly = true;
                                                    document.getElementById('btnLocalidad').style.display = 'block';
                                                });
                                            }
                                            google.maps.event.addDomListener(window, 'load', init);
                                        </script>
                                    </div>
                                    <div class="filtrolocalidad">
                                        <div class="lineafiltrolocal">
                                            <input type="text" id="range_09" name="range_09" value="" />    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="botonesfiltro">
                                <div class="botonactualizar">
                                    <a id="txtbtnactu" class="txtbtnactu" onclick="validarBusquedaHome('<%=(String) session.getAttribute("codUsuario")%>')">Actualizar</a>
                                </div>
                                <div class="botoncancelar">
                                    <a id="txtbtncancel" class="txtbtncancel" onclick="ocultarfiltro()">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container demo-1">
                        <div class="main">
                            <c:choose>
                                <c:when test="${empty usuLocEquipo}">
                                </c:when>
                                <c:otherwise>
                                    <c:set var="locEquipo1" value="0" scope="page" />
                                    <c:set var="locEquipo2" value="0" scope="page" />
                                    <ul id="carousel" class="elastislide-list">
                                        <c:forEach var="locEquipo1" items="${usuLocEquipo}" varStatus="myIndexI">
                                            <c:forEach var="locEquipo2" items="${locEquipo1}" varStatus="myIndexJ"> 
                                                <c:if test="${myIndexJ.last}">  
                                                    <c:if test="${usuLocEquipo[myIndexI.index][myIndexJ.index] != sessionScope.codUsuario}">
                                                        <c:set var="codUsuAjeno" value="${usuLocEquipo[myIndexI.index][myIndexJ.index]}" scope="page" />

                                                        <c:forEach var="locEquipo2" items="${locEquipo1}" varStatus="myIndexN">
                                                            <c:choose>

                                                                <c:when test="${myIndexN.first}">

                                                                    <li><img class="carruselgentecerk" onclick="mostrarPerfilAjeno('${codUsuAjeno}')" src="${usuLocEquipo[myIndexI.index][myIndexN.index]}"></li>
                                                                    
                                                                </c:when>

                                                            </c:choose>
                                                        </c:forEach>

                                                    </c:if>
                                                </c:if>
                                            </c:forEach>
                                        </c:forEach>
                                    </ul>
                                </c:otherwise>
                            </c:choose>                        
                        </div>
                    </div>                   
                </main>                
                <main class="partederechafavoritos" id="partederechafavoritos">
                    <div class="cabecera" id="cabecerafavoritos">
                        <header class="seccion-header--cuadro">
                            <div class="textotitulo">
                                <b class="titulo">Favoritos</b>
                            </div>
                            <div class="tipofavoritos">
                                <div class="misfavoritos">                                    
                                    <button id="imgmisfavoritos" class="btnmisfavoritos" onclick="enseñarmisfavoritos()">Mis Favoritos</button>
                                </div> 
                                <div class="favoritosde">                                    
                                    <button id="imgfavoritosde" class="btnfavoritosde" onclick="enseñarfavoritosde()">Te han añadido a Favoritos</button>
                                </div> 
                            </div>
                        </header>
                    </div>
                    <div class="container contenedorimagenfavoritos" id="contenedor">
                        <div class="imageninterrogacion">
                            <img src="../img/interrogacion.png">
                        </div>                        
                    </div>

                    <div class="container demo-1 contenedormisfavoritos">
                        <div class="main">
                            <ul id="carousel" class="elastislide-list">
                                <li><a href="#"><img src="../img/Big_Buck_Bunny.jpg" alt="image01" /></a></li>
                                <li><a href="#"><img src="../img/Big_Buck_Bunny.jpg" alt="image01" /></a></li>
                                <li><a href="#"><img src="../img/Big_Buck_Bunny.jpg" alt="image02" /></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container contenedormisfavoritos" id="contenedor">
                        <section class="main row clearfix">
                            <%
                                String coduser = (String) session.getAttribute("codUsuario");
                                String codFavorito = "";
                                String imagenFavorito = "";
                                String nikFavorito = "";
                                String fileFavorito = "";
                                ArrayList<String> listaFavoritos = new ArrayList<String>();
                                listaFavoritos = bd.obtenerFavoritos(coduser);
                                for (int i = 0; i < listaFavoritos.size(); i++) {
                                    codFavorito = listaFavoritos.get(i);
                                    usr = bd.getUserData(codFavorito);
                                    nikFavorito = usr.getNick();
                                    imagenFavorito = bd.getImagePerf(codFavorito);
                                    if (imagenFavorito
                                            != "../img/imagenperfildefecto.png") {
                                        fileFavorito = imagenFavorito.substring(imagenFavorito.lastIndexOf("\\") + 1);
                                        imagenFavorito = "..//imagenPerfil//" + fileFavorito;
                                    }
                            %>    
                            <article class="col-xs-12 col-sm-5 col-md-2-5 col-md-offset-1 col-sm-offset-1 bio img-rounded clearfix">
                                <img class="imagenesgente" onclick="mostrarPerfilAjeno('<%=codFavorito%>')" src="<%=imagenFavorito%>"  alt="Responsive image">                               
                                <div class="text-center" onclick="quitarFavorito('<%=codFavorito%>')">
                                    <font  class="txtBusqueda"><%=nikFavorito%></font>
                                </div>
                            </article>
                            <%
                                }
                            %>                           
                        </section>
                        <%
                            if (listaFavoritos.size() != 0) {

                        %>
                        <div class="paginacion">
                            <ul class="pagination">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a class="active" href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div> 
                        <%                            }
                        %>
                    </div>
                    <div class="container contenedorfavoritosde" id="contenedor">
                        <section class="main row clearfix">
                            <%                                ArrayList<String> listaSoySuFavorito = new ArrayList<String>();
                                listaSoySuFavorito = bd.obtenerCodUsuSoySuFavorito(coduser);
                                for (int i = 0; i < listaSoySuFavorito.size(); i++) {
                                    codFavorito = listaSoySuFavorito.get(i);
                                    usr = bd.getUserData(codFavorito);
                                    nikFavorito = usr.getNick();
                                    imagenFavorito = bd.getImagePerf(codFavorito);
                                    if (imagenFavorito
                                            != "../img/imagenperfildefecto.png") {
                                        fileFavorito = imagenFavorito.substring(imagenFavorito.lastIndexOf("\\") + 1);
                                        imagenFavorito = "..//imagenPerfil//" + fileFavorito;
                                    }
                            %>    
                            <article class="col-xs-12 col-sm-5 col-md-2-5 col-md-offset-1 col-sm-offset-1 bio img-rounded clearfix">
                                <img class="imagenesgente" onclick="mostrarPerfilAjeno('<%=codFavorito%>')" src="<%=imagenFavorito%>" alt="Responsive image">                               
                                <div class="text-center">
                                    <font class="txtBusqueda"><%=nikFavorito%></font>
                                </div>
                            </article>   
                            <%
                                }
                            %>    
                        </section>
                        <%
                            if (listaSoySuFavorito.size() != 0) {

                        %>
                        <div class="paginacion">
                            <ul class="pagination">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a class="active" href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                        <%                            }
                        %>
                    </div>  
                </main>

                <main class="partederechavisitas" id="partederechavisitas">
                    <div class="cabecera">
                        <header class="seccion-header--cuadro">
                            <div class="textotitulo">
                                <b class="titulo">Visitas</b>
                            </div>
                        </header>
                    </div>
                    <div class="container" id="contenedor">
                        <section class="main row clearfix">
                            <%                                String codVisitas = "";
                                String nikVisita = "";
                                String imagenVisita = "";
                                String fileVisita = "";
                                ArrayList<String> listaVisitas = new ArrayList<String>();
                                listaVisitas = bd.obtenerVisitas(coduser);
                                for (int i = 0; i < listaVisitas.size(); i++) {
                                    codVisitas = listaVisitas.get(i);
                                    usr = bd.getUserData(codVisitas);
                                    nikVisita = usr.getNick();
                                    imagenVisita = bd.getImagePerf(codVisitas);
                                    if (imagenVisita
                                            != "../img/imagenperfildefecto.png") {
                                        fileVisita = imagenVisita.substring(imagenVisita.lastIndexOf("\\") + 1);
                                        imagenVisita = "..//imagenPerfil//" + fileVisita;
                                    }
                            %>    
                            <article class="col-xs-12 col-sm-5 col-md-2-5 col-md-offset-1 col-sm-offset-1 bio img-rounded clearfix">
                                <img class="imagenesgente" onclick="mostrarPerfilAjeno('<%=codVisitas%>')" src="<%=imagenVisita%>" alt="Responsive image">                               
                                <div class="text-center">
                                    <font class="txtBusqueda"><%=nikVisita%></font>
                                </div>
                            </article>   
                            <%
                                }
                            %>    
                        </section>
                        <%
                            if (listaVisitas.size() != 0) {

                        %>
                        <div class="paginacion">
                            <ul class="pagination">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a class="active" href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">6</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                        <%                            }
                        %>
                    </div>                    
                </main>
                <div class="miPerfil">
                    <%  if (usuario.equals("Equipo")) { %>
                    <jsp:include page="miPerfilEquipo.jsp"/> 
                    <% } else if (usuario.equals("Jugador") || usuario.equals("Entrenador")) { %>   
                    <jsp:include page="miPerfilJugadorEntrenador.jsp"/>
                    <% }%>
                </div>
                <footer class="footbar">
                    <jsp:include page="footerhome.jsp"/>
                </footer>
            </div>
        </div>

        <script type="text/javascript">
            function alertName() {
                if (<%=nombreurl%> == "modal") { // Miramos si dentro de la variable que se ha pasado por la URL encuentra la palabra modal. Si es asi decimos que la contraseña se ha cambiado correctamente.
                    alert("La contraseña se ha cambiado correctamente"); //
                } else if (<%=nombreurl%> == "modalInfo") {
                    alert("La información se ha guardado correctamente");
                }
            }
        </script>
        <script  src="../js/jquerypp.custom.js"></script>
        <script  src="../js/jquery.elastislide.js"></script>
        <script type="text/javascript">

            $('#carousel').elastislide();

        </script>
    </body>    
</html>