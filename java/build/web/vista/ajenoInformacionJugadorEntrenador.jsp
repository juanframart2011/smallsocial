<%-- 
    Document   : ajenoInformacionJugadorEntrenador
    Created on : 20-feb-2017, 11:24:24
    Author     : Orion
--%>
<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page import="modelo.InfoUsuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    InfoUsuario infoUsu = new InfoUsuario();
    String pSobremi = "";
    String pQuebusco = "";
    String pExp = "";
    String coduserAj = "";
    BD bd = new BD();
    coduserAj = (String) request.getParameter("codUsuAjeno");
    infoUsu = bd.obtenerInfo(coduserAj);   
    pSobremi = infoUsu.getSobremi();   
    pQuebusco = infoUsu.getQueBusco();   
    pExp = infoUsu.getExperiencia();   
%>   

<!DOCTYPE html>
<div class="infousuario">
    <form class="form forminfousu">
        <div class="form-row">            
            <div class="tituloinfo">
                <b>Sobre mí</b>
            </div>
            <div class="cuadroinfo">
                <textarea class="textareainfo" name="textareainfo" readonly rows="6"><%=pSobremi%></textarea>
            </div>            
        </div>
        <div class="form-row">
            <div class="tituloexp">
                <b>Experiencia</b>
            </div>
            <div class="cuadroexp">
                <textarea class="textareaexp" name="textareaexp" readonly rows="6"><%=pExp%></textarea>
            </div> 
        </div>
        <div class="form-row">
            <div class="titulobusqueda">
                <b>¿Qué busco?</b>
            </div>
            <div class="cuadrobusqueda">
                <textarea class="textareabusqueda" name="textareabusqueda" readonly rows="6"><%=pQuebusco%></textarea>
            </div> 
        </div>        
    </form>
</div>
