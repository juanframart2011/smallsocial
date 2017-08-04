<%-- 
    Document   : amistosos
    Created on : 28-nov-2016, 17:57:18
    Author     : Orion
--%>

<%@page import="java.util.ArrayList"%>
<%@page import="modelo.BD"%>
<%@page import="modelo.Usuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Shortcut Icon" href="../img/balon.png">
        <title>MeeTeam Amistosos</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

        <!-- Estilo Principal -->
        <link rel="stylesheet" type="text/css" href="../css/estilosamistosos.css">    
    </head>
    <body>
        <a onclick="history.back()"> 
            <div id="botonx" class="botonx"></div>
        </a> 
        <section id="pricing-table">
            <div class="container">
                <div class="row">
                    <div class="pricing">
                        <%
                            BD bd = new BD();
                            ArrayList<String> listaAmistosos = new ArrayList<String>();
                            String codUsu = "";
                            String pNick = "";
                            String pLocalidad = "";
                            String pTipoEquipo = "";
                            listaAmistosos = bd.obtenerAmistosos();
                            Usuario usu = new Usuario();

                            for (int i = 0; i < listaAmistosos.size(); i++) {
                                codUsu = listaAmistosos.get(i);
                                usu = bd.getUserData(codUsu);
                                pNick = usu.getNick();
                                pLocalidad = usu.getLocalidad();
                                pTipoEquipo = usu.getTipoEquipo();

                        %>               
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="pricing-table">                                                
                                <div class="pricing-header">
                                    <p class="pricing-title"><%=pNick%></p>                                    
                                    <a href="#" class="btn btn-custom">¡¡ Retame !!</a>
                                </div>
                                <div class="pricing-list">
                                    <ul>
                                        <li><span><%=pLocalidad%></span></li>
                                        <li><span><%=pTipoEquipo%></span></li>                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <%                            }
                        %>
                    </div>
                </div>
            </div>
        </section>
        <%
            if (listaAmistosos.size() != 0) {

        %>
        <div class="paginacion">
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a class="active" href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
        <%            
            }
        %>
    </body>
</html>