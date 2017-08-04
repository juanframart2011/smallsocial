<%-- 
    Document   : modalContact
    Created on : 22-sep-2016, 18:57:36
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="modal fade" id="contact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formulario_contacto" name="formulario_contacto" action="vista/emailContacto.jsp" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Contacta con MeeTeam</h4>   
                </div>  
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contact-email" class="col-lg-2">Email:</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="contact-email" name="Email" placeholder="tu@ejemplo.com" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="contact-name" class="col-lg-2">Asunto:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="contact-issue" name="Asunto" placeholder="Escriba el asunto" required="" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-msg" class="col-lg-2">Mensaje:</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="8" name="Incidencia"></textarea>
                        </div>
                    </div>
                </div>     
                <input type="hidden" name="origen" value="modalContact.jsp"/>    
                <div class="modal-footer">
                    <a class="btn btn-default" id="cerrar" data-dismiss="modal">Cerrar</a> 
                    <button class="btn btn-primary" id="contacto" type="submit" onclick="validacionContacto()">Enviar</button>
                </div>
            </form>
        </div>
    </div>      
</div>  

