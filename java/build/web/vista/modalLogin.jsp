<%-- 
    Document   : modalLogin
    Created on : 21-sep-2016, 19:00:46
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="modal fade login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formulario_login" name="formulario_login" action="GestionarLogin" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Iniciar Sesion</h4>   
                </div>  
                <div class="modal-body">
                    <div class="form-group">
                        <label for="login-email" class="col-lg-2">Email:</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="login-email"  name="User" placeholder="Escriba su correo electrónico" required="">
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="login-password" class="col-lg-2">Contraseña:</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="login-password" name="Pass" placeholder="Escriba su contraseña" required="">
                        </div>
                    </div> 
                </div>     
                <div class="modal-footer">
                    <a data-toggle="modal" href="#recuperar_pass" onclick="limpiarCampos()" <span class="olvidarpass">¿Has olvidado tu contraseña?</span></a>
                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a> 
                    <button class="btn btn-primary" id="enviar" type="button" onclick="validacionLogin()">Entrar</button>
                    <label for ="mensaje-resultado" class="col-md-12 msgErrorForm">${mensajeErrorLogin}</label>
                    <input type="hidden" name="nombrejsp" value="valorLogin">
                </div>
            </form>  
        </div>  
    </div>      
</div>  

