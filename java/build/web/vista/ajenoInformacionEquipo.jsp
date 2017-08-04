<%-- 
    Document   : ajenoInformacionEquipo
    Created on : 20-feb-2017, 11:31:03
    Author     : Orion
--%>

<%@page import="modelo.Usuario"%>
<%@page import="modelo.BD"%>
<%@page import="modelo.InfoUsuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    InfoUsuario infoUsu = new InfoUsuario();
    String pElclub = "";
    String pQuebusco = "";
    String pTrayect = "";
    String coduserAj = "";
    BD bd = new BD();
    coduserAj = (String) request.getParameter("codUsuAjeno");
    infoUsu = bd.obtenerInfo(coduserAj);   
    pElclub = infoUsu.getElClub();    
    pTrayect = infoUsu.getTrayectoria(); 
    pQuebusco = infoUsu.getQueBusco();   
%>   
<!DOCTYPE html>
<div class="infousuario">
    <form class="form forminfousu" action="GestionarAjenoInfo">
        <div class="form-row">            
            <div class="tituloinfo">
                <b>El Club</b>
            </div>
            <div class="cuadroinfo">
                <textarea class="textareainfo" name="textareainfo" readonly rows="6"><%=pElclub%></textarea>
            </div>            
        </div>
        <div class="form-row">
            <div class="tituloexp">
                <b>Trayectoria</b>
            </div>
            <div class="cuadroexp">
                <textarea class="textareaexp" name="textareaexp" readonly rows="6"><%=pTrayect%></textarea>
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
