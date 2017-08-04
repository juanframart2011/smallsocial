<%-- 
    Document   : modaleliminarusucorrecto
    Created on : 11-ene-2017, 12:01:36
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<div class="modal fade" id="usueliminado" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formulario_usuelim" name="formulario_usuelim"  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="text-align: center">El usuario se ha eliminado correctamente</h4>   
                </div>                               
                <div class="modal-footer">
                    <a class="btn btn-default" id="cerrar" data-dismiss="modal">Cerrar</a>                     
                </div>
            </form>
        </div>
    </div>      
</div>
