<%-- 
    Document   : ajenoPerfilJugadorEntrenador
    Created on : 15-feb-2017, 9:50:35
    Author     : Orion
--%>

<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<script src="../js/html5gallery.js"></script>
<script src="../js/validacion.js"></script>

<!DOCTYPE html>
<%
    String imageurl3 = "";
    String coduserAjen3 = "";
    String pNik3 = "";    
    String pNombre3 = "";
    int pEdad3 = 0;
    String pLocalidad3 = "";
    String pTipoUsu3 = "";
    String pPosicion3 = "";
    String pEntrenarEquipo3 = "";
    String posEntrenarEqu3 = "";
    String file3 = "";
    Usuario usr3 = new Usuario();
    BD bd3 = new BD();
    coduserAjen3 = (String) request.getParameter("codUsuAjeno");
    usr3 = bd3.getUserData(coduserAjen3);
    imageurl3 = bd3.getImagePerf(coduserAjen3);
    pNik3 = usr3.getNick();
    pNombre3 = usr3.getNomUsuario();
    pEdad3 = usr3.getEdad();
    pLocalidad3 = usr3.getLocalidad();
    pTipoUsu3 = usr3.getTipoUsu();
    pPosicion3 = usr3.getPosicion();
    pEntrenarEquipo3 = usr3.getEntrenarEquipo();
    if (pPosicion3 == null) {
        posEntrenarEqu3 = pEntrenarEquipo3;
    } else {
        posEntrenarEqu3 = pPosicion3;
    }
    if (imageurl3
            != "../img/imagenperfildefecto.png") {
        file3 = imageurl3.substring(imageurl3.lastIndexOf("\\") + 1);
        imageurl3 = "..//imagenPerfil//" + file3;
    }

    bd3.close();

%>

<div id="parteDerePerfil" class="parteDerePerfil">
    <div id="cabeceraperfil" class="cabeceraperfil">
        <a href="home.jsp"> 
            <div id="botonx" class="botonx"></div>
        </a>  
        <div id="textoCabePerfil" class="textoCabePerfil">
            <span>Perfil de <%=pNik3%> </span>
        </div>        
    </div>
    <div class="contenidoperfil">
        <div class="menuperfil">
            <div class="imaperfil">               
                <img class="fotoperfil" src="<%=imageurl3%>"/>
            </div>
            <div class="botonsobremi">
                <a><img class="btnsobremi" onclick='mostrarPerfilInfo()' src="../img/btnPerfil.png"/></a>
            </div>
            <div class="botoninformacion" onclick="mostrarInfoAjeno('<%=coduserAjen3%>')">
                <a><img class="btninfo" src="../img/btnInfo.png"/></a>
            </div>
            <div class="botonimagenvideo" onclick='mostrarImaVideoAjeno();'>
                <a><img class="btnimavideo" src="../img/btnImaVid.png"/></a>
            </div>           
        </div>        
        <div class="datosperfil">
            <div class="bcard">
                <div class="border-top gray1"></div>
                <div class="border-top gray2"></div>
                <div class="border-top gray3"></div>
                <div class="title">
                    <h1><%=pNombre3%></h1>
                    <h2> <%=pEdad3%> años, <%=pLocalidad3%> </h2>                    
                </div>
                <header class="usuariodatos">
                    <h1><%=pNik3%></h1>
                    <h2> <%=pEdad3%> años, <%=pLocalidad3%> </h2>
                </header>
                <div class="contact_details">   

                    <p><%=pTipoUsu3%>, <%=posEntrenarEqu3%></p>

                </div>
                <footer class="interactuausuario">                 
                    <a href="#" title="¡Escribeme!"><i class="fa fa-comments" onmousedown="return false;"></i></a>                                    
                    <a href="#" title="Bloquear"><i class="fa fa-lock" id="iconocandado2" onclick="bloquearUsu('<%=coduserAjen3%>')" onmousedown="return false;"></i></a>
                    <a href="#" title="Favorito"><i class="fa fa-star" id="iconoestrella2" onclick="favoritoUsu('<%=coduserAjen3%>')" onmousedown="return false;"></i></a>	                     

                </footer>
            </div>
            <div class="miInfo">
                <jsp:include page="ajenoInformacionJugadorEntrenador.jsp"/>             
            </div>            
            <div class="fotoVideo">
                <jsp:include page="ajenoFotosVideos.jsp"/>
            </div>
        </div>
    </div>
</div>

