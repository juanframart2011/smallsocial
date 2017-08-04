<%-- 
    Document   : ajustesusuario
    Created on : 01-dic-2016, 18:51:00
    Author     : Orion
--%>
<%@page import="modelo.BD"%>
<%@page import="java.util.ArrayList"%>
<%
    BD bd = new BD();
    String coduser = (String) session.getAttribute("codUsuario");
%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="formulcambiarpass" id="formulcambiarpass">
    <form  class="contact_form" action="../GestionarCambiarPassword" id="formulario_cambiarpassword" name="formulario_cambiarpassword" method="POST">
        <div class="titulcambiarpass">
            Cambiar Contraseña
        </div>
        <div>
            <ul id="">                
                <li>
                    <label for="recu_password">Nueva Contraseña:</label>
                    <input type="password" id="recu-password"  name="cambiarPassw" placeholder="Escriba su contraseña" required="">
                </li>
                <li>
                    <label for="recu_password">Repite Contraseña:</label>
                    <input type="password" id="recu-password"  name="cambiarPassw2" placeholder="Repita su contraseña" required="">
                </li>
                <li class='botonesnuevopass'>
                    <input type="button" class="cambiarpass" id="recuperar" onclick="cambiarPassword()" value="Cambiar">
                    <input type="reset" class="limpiarpass" value="Borrar">
                    <input type="hidden" name="nombrejsp" value="valorcambiopassw">

                </li>                
            </ul>
        </div>
    </form>
    <form  class="contact_form" action="fotoPerfilCarga.jsp" id="formulario_fotoperfil" name="formulario_fotoperfil" enctype="multipart/form-data" method="POST">
        <div class="mifotoperfil" id="mifotoperfil">
            <div class="titulfotoperfil">
                Establecer Foto Perfil
            </div>
            <div class="fotoPerfil" id="fotoPerfil">
                <font class="txtFotoPerfil">Añadir Foto: </font>
                <input id="fileimagperf" type="file" name="pic" accept="image/*">
                <input type="submit" class="fotoimagenperfil" id="fotoimagenperfil" onclick="" value="Cargar Imagen">
                <input type="reset" name="b_borrar" value="reset" style="display:none"/> 
            </div>
        </div>
    </form>
</div>
<form action="../GestionarEliminarCuenta" method="POST">
    <div class="borrarcuenta" id="borrarcuenta">
        <div class="imagenalerta">
            <img src="../img/alerta.png">
        </div>
        <div class="mensajealerta">
            ¿Quieres eliminar tu  cuenta?
        </div>

        <div class="botoneseliminarcuenta">            
            <input type="submit" class="siborrar" value="Si" >
            <input type="button" class="noborrar" value="NO" onclick="salirborrarcuenta()">
            <input type="hidden" name="nombrejsp" value="valorusuelim">
        </div>
    </div>
</form>

<div class="usubloq" id="usubloq">
    <div class="titulusuariosbloq">
        Usuarios Bloqueados
    </div>
    <div class="usubloqueados">
        <select class="usbloq" id="usbloq" name="usubloq" size="5" multiple>
            <%
                String nik = "";
                ArrayList<String> listabloq = new ArrayList<String>();
                listabloq = bd.obtenerBloqueados(coduser);
                for (int i = 0; i < listabloq.size(); i++) {
                    nik = listabloq.get(i);

            %>            
            <option><%=nik%></option>            
            <%
                }
            %>
        </select>
    </div>
    <div class="botondesbloq">
        <button onclick="desbloquear()">Desbloquear</button>
    </div>
</div>
<figure class="tarjetas" id='tarjetas'>
    <div class="tarjetas__contenido">  
        <div class="tarjetas__elemento">
            <a href="#" onclick="cambiarpass()">
                <div class="txttarjpass">Personalización</div>
            </a>
        </div>
        <div class="tarjetas__elemento">
            <a href="#" onclick="usuariosbloqueados(); //Damos el codigo de usuario y pasamos no para que no use la funcion en la bd de bloquear
                    seleccionarprimeraopcion()">
                <div class="txttarjbloq">Usuarios Bloqueados</div>
            </a>  
        </div>
        <div class="tarjetas__elemento">
            <a href="#" onclick="eliminarcuenta()">
                <div class="txttarjcuent">Eliminar Cuenta</div>
            </a>
        </div>
    </div>
</figure>

