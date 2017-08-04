<%-- 
    Document   : MailtoModalContact
    Created on : 03-oct-2016, 19:43:18
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="modal fade" id="contact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>Contacta con MeeTeam</h4>   
                </div>  
                <div class="modal-body">                    
                    <input type="hidden" name="origen" value="mailtoModalContact.jsp"/>    
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Cerrar</a> 
                        <button class="btn btn-primary" id="contacto" onclick="mailto()" type="button">Contacta</button>
                    </div>
                </div>
        </div>      
    </div> 
</div>

