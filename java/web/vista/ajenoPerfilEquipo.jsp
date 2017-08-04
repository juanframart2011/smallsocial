<%-- 
    Document   : ajenoPerfilEquipo
    Created on : 15-feb-2017, 9:50:15
    Author     : Orion
--%>

<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<script src="../js/html5gallery.js"></script>

<!DOCTYPE html>
<%
    String imageurl4 = "";
    String coduserAjen4 = "";
    String pNik4 = "";
    String pNombre4 = "";
    String pLocalidad4 = "";
    String pTipoUsu4 = "";
    String pTipoEquipo4 = "";
    String file4 = "";
    Usuario usr4 = new Usuario();
    BD bd4 = new BD();
    coduserAjen4 = (String) request.getParameter("codUsuAjeno");
    usr4 = bd4.getUserData(coduserAjen4);
    imageurl4 = bd4.getImagePerf(coduserAjen4);
    pNik4 = usr4.getNick();
    pNombre4 = usr4.getNomUsuario();
    pLocalidad4 = usr4.getLocalidad();
    pTipoUsu4 = usr4.getTipoUsu();
    pTipoEquipo4 = usr4.getTipoEquipo();
    if (imageurl4
            != "../img/imagenperfildefecto.png") {
        file4 = imageurl4.substring(imageurl4.lastIndexOf("\\") + 1);
        imageurl4 = "..//imagenPerfil//" + file4;
    }

    bd4.close();

%>
<div id="parteDerePerfil" class="parteDerePerfil">
    <div id="cabeceraperfil" class="cabeceraperfil">
        <a href="home.jsp"> 
            <div id="botonx" class="botonx"></div>
        </a>  
        <div id="textoCabePerfil" class="textoCabePerfil">
            <span>Perfil del <%=pNik4%></span>
        </div>        
    </div>
    <div class="contenidoperfil">
        <div class="menuperfil">
            <div class="imaperfil">
                <img class="fotoperfil" src="<%=imageurl4%>"/>
            </div>
            <div class="botonsobremi" onclick='mostrarPerfilInfo()'>
                <a><img class="btnsobremi" src="../img/btnPerfil.png"/></a>
            </div>
            <div class="botoninformacion" onclick="mostrarInfoAjeno('<%=coduserAjen4%>')">
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
                    <h1><%=pNombre4%></h1>
                    <h2><%=pLocalidad4%></h2>                  
                </div>
                <header class="usuariodatos">
                    <h1><%=pNik4%></h1>
                    <h2><%=pLocalidad4%></h2>                    
                </header>
                <div class="contact_details">   
                    <p>
                        <%=pTipoUsu4%>, <%=pTipoEquipo4%>
                    </p>
                </div>
                <footer class="interactuausuario">
                    <a href="#" title="¡Escribeme!"><i class="fa fa-comments" onmousedown="return false;"></i></a>
                    <a href="#" title="Bloquear" onclick="cambiaricono()"><i class="fa fa-lock" id="iconocandado2" onclick="bloquearUsu('<%=coduserAjen4%>')" onmousedown="return false;"></i></a>			
                    <a href="#" title="Favorito" onclick="cambiaricono2()"><i class="fa fa-star" id="iconoestrella2" onclick="favoritoUsu('<%=coduserAjen4%>')" onmousedown="return false;"></i></a>			
                </footer>
            </div>            
            <div class="miInfo">
                <jsp:include page="ajenoInformacionEquipo.jsp"/>
            </div>            
            <div class="fotoVideo">
                <jsp:include page="ajenoFotosVideos.jsp"/>
            </div>
        </div>  
    </div>

</div>

