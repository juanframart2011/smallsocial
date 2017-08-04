<%-- 
    Document   : miInformacionJugadorEntrenador
    Created on : 01-dic-2016, 17:26:00
    Author     : Orion
--%>


<%@page import="modelo.InfoUsuario"%>
<%@page import="modelo.BD"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%
    InfoUsuario infoUsu = new InfoUsuario();
    String coduser = (String) session.getAttribute("codUsuario");
    String pSobremi = "";
    String pQuebusco = "";
    String pExp = "";
    BD bd = new BD();
    infoUsu = bd.obtenerInfo(coduser);
    pSobremi = infoUsu.getSobremi();
    pQuebusco = infoUsu.getQueBusco();
    pExp = infoUsu.getExperiencia();

%> 
<!DOCTYPE html>
<div class="infousuario">
    <form class="form forminfousu" name="formulario_infoJugEntr" id="formulario_infoJugEntr" action="../GestionarMiInfo" method="POST">
        <div class="form-row">            
            <div class="tituloinfo">
                <b>Sobre mí</b>
            </div>
            <div class="cuadroinfo">
                <textarea class="textareainfo" name="textareainfo" placeholder="Escribe algo sobre ti" rows="6"><%=pSobremi%></textarea>
            </div>            
        </div>
        <div class="form-row">
            <div class="tituloexp">
                <b>Experiencia</b>
            </div>
            <div class="cuadroexp">
                <textarea class="textareaexp" name="textareaexp" placeholder="¿Dónde has jugado antes?" rows="6"><%=pExp%></textarea>
            </div> 
        </div>
        <div class="form-row">
            <div class="titulobusqueda">
                <b>¿Qué busco?</b>
            </div>
            <div class="cuadrobusqueda">
                <textarea class="textareabusqueda" name="textareabusqueda" placeholder="¿Dónde te gustaría jugar?" rows="6"><%=pQuebusco%></textarea>
            </div> 
        </div>        
        <div class='btnesguardcancel'>
            <input type="button" class="botonguardarperfil" value="Guardar" onclick="validacionInfoJugaEntr()" />
            <input type="button" class="botoncancelarperfil" onclick="borrarInfor()" value="Borrar" />
        </div>
    </form>
</div>
