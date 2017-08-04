<%-- 
    Document   : miPerfilJugadorEntrenador
    Created on : 13-feb-2017, 11:17:40
    Author     : Orion
--%>

<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<%
    String imageurlPerf = "";
    String coduser = "";
    String pNik = "";
    String pNombre = "";
    int pEdad = 0;
    String pLocalidad = "";
    String pTipoUsu = "";
    String pPosicion = "";
    String pEntrenarEquipo = "";
    String posEntrenarEqu = "";
    String filePerf = "";
    Usuario usrPerf = new Usuario();
    BD bdPerf = new BD();
    coduser = (String) session.getAttribute("codUsuario");
    usrPerf = bdPerf.getUserData(coduser);
    imageurlPerf = bdPerf.getImagePerf(coduser);
    pNik = usrPerf.getNick();
    pNombre = usrPerf.getNomUsuario();
    pEdad = usrPerf.getEdad();
    pLocalidad = usrPerf.getLocalidad();
    pTipoUsu = usrPerf.getTipoUsu();
    pPosicion = usrPerf.getPosicion();
    pEntrenarEquipo = usrPerf.getEntrenarEquipo();

    if (pPosicion == null) {
        posEntrenarEqu = pEntrenarEquipo;
    } else {
        posEntrenarEqu = pPosicion;
    }
    if (imageurlPerf
            != "../img/imagenperfildefecto.png") {
        filePerf = imageurlPerf.substring(imageurlPerf.lastIndexOf("\\") + 1);
        imageurlPerf = "..//imagenPerfil//" + filePerf;
    }
    bdPerf.close();

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
                <img class="fotoperfil" src="<%=imageurlPerf%>"/>
            </div>
            <div class="botonsobremi">
                <a><img class="btnsobremi" onclick='mostrarPerfilInfo()' src="../img/btnPerfil.png"/></a>
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
                    <h1><%=pNombre%></h1>
                    <h2> <%=pEdad%> años, <%=pLocalidad%> </h2>                    
                </div>
                <header class="usuariodatos">
                    <h1><%=pNik%></h1>
                    <h2> <%=pEdad%> años, <%=pLocalidad%> </h2>
                </header>
                <div class="contact_details">   

                    <p><%=pTipoUsu%>, <%=posEntrenarEqu%></p>

                </div>                
            </div>
            <div class="miInfo">
                <jsp:include page="miInformacionJugadorEntrenador.jsp"/>             
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
