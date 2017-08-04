<%-- 
    Document   : miInformacionEquipo
    Created on : 01-dic-2016, 18:40:27
    Author     : Orion
--%>

<%@page import="modelo.InfoUsuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    InfoUsuario infoUsu = new InfoUsuario();
    String coduser = (String) session.getAttribute("codUsuario");
    String pElclub = "";
    String pQuebusco = "";
    String pTrayect = "";
    BD bd = new BD();
    infoUsu = bd.obtenerInfo(coduser);
    pElclub = infoUsu.getElClub();
    pTrayect = infoUsu.getTrayectoria();
    pQuebusco = infoUsu.getQueBusco();
%> 
<!DOCTYPE html>
<div class="infousuario">
    <form class="form forminfousu" name="formulario_infoEqu" id="formulario_infoEqu" action="../GestionarMiInfo" method="POST">
        <div class="form-row">            
            <div class="tituloinfo">
                <b>El Club</b>
            </div>
            <div class="cuadroinfo">
                <textarea class="textareainfo" name="textareainfoClub" placeholder="Escribe algo sobre el club" rows="6"><%=pElclub%></textarea>
            </div>            
        </div>
        <div class="form-row">
            <div class="tituloexp">
                <b>Trayectoria</b>
            </div>
            <div class="cuadroexp">
                <textarea class="textareaexp" name="textareatray" placeholder="¿Dónde ha jugado el club?" rows="6"><%=pTrayect%></textarea>
            </div> 
        </div>
        <div class="form-row">
            <div class="titulobusqueda">
                <b>¿Qué busco?</b>
            </div>
            <div class="cuadrobusqueda">
                <textarea class="textareabusqueda" name="textareabusqueda" placeholder="¿Que busca el club?" rows="6"><%=pQuebusco%></textarea>
            </div> 
        </div>
        <div class='btnesguardcancel'>
            <input type="button" class="botonguardarperfil" value="Guardar" onclick="validacionInfoEqui()" />
            <input type="button" class="botoncancelarperfil" onclick="borrarInfor()" value="Borrar" />
        </div>
    </form>
</div>
