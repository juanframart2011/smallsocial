<%-- 
    Document   : EmailContacto
    Created on : 27-sep-2016, 16:28:48
    Author     : Orion
--%>

<%@page import="modelo.Email"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Atención al Usuario</title>
    </head>
    <body>
        <%
            Email email = new Email();
            response.setContentType("text/html;charset=UTF-8");
            request.setCharacterEncoding("UTF-8");
            String de = request.getParameter("Email");
            String para = "meeteam@mail.com";
            String asunto = request.getParameter("Asunto");
            String mensaje = request.getParameter("Incidencia");
            boolean resultado = email.enviarCorreo(de, para, asunto, mensaje);
            if (resultado) {
                out.print("El mensaje ha sido correctamente enviado" + "\n\n" + "<a href='../index.jsp'>Volver al Index</a>");
            } else {
                out.print("El mensaje no ha sido enviado" + "\n\n" + "<a href='../index.jsp'>Volver al Index</a>");
            }
        %>
    </body>
</html>
