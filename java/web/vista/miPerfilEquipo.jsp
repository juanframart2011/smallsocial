<%-- 
    Document   : miPerfilEquipo
    Created on : 13-feb-2017, 11:17:19
    Author     : Orion
--%>

<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<%
    String imageurl2 = "";
    String coduser2 = "";
    String pNik2="";
    String pNombre2 = "";
    String pLocalidad2 = "";
    String pTipoUsu2 = "";
    String pTipoEquipo2 = "";
    String file2 = "";
    Usuario usr2 = new Usuario();
    BD bd2 = new BD();
    coduser2 = (String) session.getAttribute("codUsuario");
    usr2 = bd2.getUserData(coduser2);
    imageurl2 = bd2.getImagePerf(coduser2);
    pNik2 = usr2.getNick();
    pNombre2 = usr2.getNomUsuario();
    pLocalidad2 = usr2.getLocalidad();
    pTipoUsu2 = usr2.getTipoUsu();
    pTipoEquipo2 = usr2.getTipoEquipo();
    if (imageurl2
            != "../img/imagenperfildefecto.png") {
        file2 = imageurl2.substring(imageurl2.lastIndexOf("\\") + 1);
        imageurl2 = "..//imagenPerfil//" + file2;
    }

    bd2.close();

%>
<div id="parteDerePerfil" class="parteDerePerfil">
    <div id="cabeceraperfil" class="cabeceraperfil">
        <a href="home.jsp"> 
            <div id="botonx" class="botonx"></div>
        </a>  
        <div id="textoCabePerfil" class="textoCabePerfil">
            <span>MI PERFIL</span>
        </div>        
    </div>
    <div class="contenidoperfil">
        <div class="menuperfil">
            <div class="imaperfil">
                <img class="fotoperfil" src="<%=imageurl2%>"/>
            </div>
            <div class="botonsobremi" onclick='mostrarPerfilInfo()'>
                <a><img class="btnsobremi" src="../img/btnPerfil.png"/></a>
            </div>
            <div class="botoninformacion" onclick='mostrarInfo()'>
                <a><img class="btninfo" src="../img/btnInfo.png"/></a>
            </div>
            <div class="botonimagenvideo" onclick='mostrarImaVideo();
                    oculFotoVideoPerfil();
                    muestrobtnperfilelim()'>
                <a><img class="btnimavideo" src="../img/btnImaVid.png"/></a>
            </div>
            <div class="botonajustes" onclick='mostrarAjustes()'>
                <a><img class="btnajustes" src="../img/btnAjustes.png"/></a>
            </div>

        </div>
        <div class="datosperfil">
            <div class="bcard">
                <div class="border-top gray1"></div>
                <div class="border-top gray2"></div>
                <div class="border-top gray3"></div>
                <div class="title">
                    <h1><%=pNombre2%></h1>
                    <h2><%=pLocalidad2%></h2>                  
                </div>
                <header class="usuariodatos">
                    <h1><%=pNik2%></h1>
                    <h2><%=pLocalidad2%></h2>                    
                </header>
                <div class="contact_details">   
                    <p>
                        <%=pTipoUsu2%>, <%=pTipoEquipo2%>
                    </p>
                </div>
                <footer class="interactuausuario">                    
                    <a href="#" title="Inscríbete en la bolsa de amistosos"><i class="fa fa-pencil" onclick="añadirteAmistoso()" onmousedown="return false;"></i></a>
                    <a href="amistosos.jsp" title="Ver bolsa amistosos"><i class="fa fa-trophy" onmousedown="return false;"></i></a>
                    <a href="#" title="Eliminarte de la bolsa de amistosos"><i class="fa fa-times-circle" onclick="eliminarteAmistoso()" onmousedown="return false;"></i></a>                    
                </footer>
            </div>            
            <div class="miInfo">
                <jsp:include page="miInformacionEquipo.jsp"/>
            </div>
            <div class="miAjuste">
                <jsp:include page="ajustesusuario.jsp"/>
            </div>
            <div class="misFotosVideos">
                <jsp:include page="miFotosVideos.jsp"/>
            </div>
        </div>  
    </div>

</div>
