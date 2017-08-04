<%-- 
    Document   : navBar
    Created on : 21-sep-2016, 19:04:34
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<nav class="navbar navbar-inverse navbar-static-top" role="navigation"> 
    <div class="navbar-header">  
        <a href="index.jsp" class=navbar-brand>MeeTeam</a>
        <button class="navbar-toggle  " data-toggle="collapse" data-target=".navHeaderCollapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse navHeaderCollapse">
        <ul class="nav navbar-nav pull-right" role="menu"> 
            <li role="presentation"><a href="#" data-toggle="modal" data-target="#login" onclick="limpiarCampos()">Login</a></li>
            <li role="presentation"><a href="#" data-toggle="modal" data-target="#registro" onclick="limpiarCampos(); desbloquearLocalidad(); mostraropciones();">Regístrate</a></li>
            <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Redes Sociales <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation"><a href="#">· Facebook</a></li> 
                    <li role="presentation"><a href="#">· Twiter</a></li>                        
                </ul>
            </li>
            <li role="presentation"><a href="#contact" data-toggle="modal" onclick="limpiarCampos()">Contacto</a></li>
        </ul>
    </div>
</nav>