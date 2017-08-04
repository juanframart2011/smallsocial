<%-- 
    Document   : fotosCarga
    Created on : 23-feb-2017, 19:19:42
    Author     : Orion
--%>

<%@page import="modelo.BD"%>
<%@page import="org.apache.commons.fileupload.FileItem"%>
<%@page import="java.util.List"%>
<%@page import="org.apache.commons.fileupload.servlet.ServletFileUpload"%>
<%@page import="java.io.File"%>
<%@page import="org.apache.commons.fileupload.disk.DiskFileItemFactory"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SUBIENDO ARCHIVO...</title>
    </head>
    <body>
        <%
           BD bd = new BD();
           String url = null;
           String codUsu = (String) session.getAttribute("codUsuario");           
           String rutaFicheros ="C:\\Users\\Borja\\Documents\\NetBeansProjects\\MeeTeam\\web\\misFotos\\";
           //Comprobamos si existe el directorio y sino lo creamos
           File directorio = new File(String.valueOf(rutaFicheros));
           if (! directorio.exists()){
               directorio.mkdirs();
           }
           DiskFileItemFactory factory = new DiskFileItemFactory();
           factory.setSizeThreshold(1024); 
           factory.setRepository(new File(rutaFicheros));
           ServletFileUpload upload = new ServletFileUpload(factory);
           try {
               List<FileItem> partes = upload.parseRequest(request);               
               for (FileItem items : partes) {                  
                   File file = new File(rutaFicheros, items.getName());
                   url = rutaFicheros + items.getName();                  
                   items.write(file);                  
               }            
               boolean carga=bd.cargarFotos(codUsu,url);               
               response.sendRedirect("home.jsp");
           } catch (Exception e) {
               out.print("No has cargado ninguna imagen. Vuelve a tu <a href='home.jsp'>perfil</a>" );
           }
       %>
    </body>
</html>
