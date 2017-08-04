<%-- 
    Document   : modalrecuperarpass
    Created on : 24-nov-2016, 17:35:24
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="modal fade login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" id="recuperar_pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formulario_recupass" name="formulario_recupass" action="GestionarRecuperarPassword" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Recuperar Contraseña</h4>   
                </div>  
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recu_email" class="col-lg-2">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="recu-email"  name="emailrecu" placeholder="Escriba su email registrado" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="recu_seguridad" class="col-lg-2">Seguridad:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="recu-seguridad"  name="segur" placeholder="Escriba la palabra/frase de seguridad" required="">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="recu_password" class="col-lg-2">Contraseña Nueva:</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="recu-password"  name="Passw" placeholder="Escriba su contraseña nueva" required="">
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="recu_password2" class="col-lg-2">Rep. Contraseña:</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="recu-password2" name="Passw2" placeholder="Repita su contraseña nueva" required="">
                        </div>
                    </div> 
                </div>     
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a> 
                    <button class="btn btn-primary" id="recuperar" type="button" onclick="validacionRecuPass()">Guardar</button>
                    <label for ="mensaje-resultado" class="col-md-12 msgErrorForm">${mensajeErrorRecuPass}</label>
                    <input type="hidden" name="nombrejsp" value="valorRecuPass">
                </div>
            </form>  
        </div>  
    </div>      
</div>  
