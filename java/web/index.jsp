<%-- 
    Document   : index
    Created on : 19-sep-2016, 20:01:02
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="Shortcut Icon" href="img/balon.png">
        <title>MeeTeam</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/estilos.css" rel="stylesheet">
        <script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="js/validacion.js"></script>
        <script src="js/jquery.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <jsp:include page="vista/navBar.jsp"/>
        <jsp:include page="vista/modalLogin.jsp"/>        
        <jsp:include page="vista/modalRegistro.jsp"/>
        <jsp:include page="vista/modalContact.jsp"/>
        <jsp:include page="vista/modalrecuperarpass.jsp"/>
        <jsp:include page="vista/modalregistrocorrecto.jsp"/>
        <jsp:include page="vista/modaleliminarusucorrecto.jsp"/>
        <jsp:include page="vista/modalexitocambiopass.jsp"/>

        <div class="container-fluid">
            <div class="jumbotron text-center jumboindex">
                <h1 style="font-style: italic"> "Sport Is Life"</h1>  
                <h3>La red social donde nadie se quedará sin equipo </h3>
            </div>
        </div>

        <div  class="container" id="contenedor">
            <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>

                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="item active"> <h1 class="h1c text-center">Eficaz</h1></div>
                    <div class="item"><h1 class="h1c text-center">Deportiva</h1></div>
                    <div class="item"><h1 class="h1c text-center">Social</h1></div>
                </div>
                <!-- Carousel nav -->
            </div>
        </div>

        <div class="container">
            <div class="main row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">CREA TU PERFIL </h3>
                        </div>
                        <div class="panel-body">
                            <p class="list-group-item-text text-justify pad">Elabora tu escaparate deportivo y date a conocer.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">REALIZA LA BÚSQUEDA</h3>
                        </div>
                        <div class="panel-body">
                            <p class="list-group-item-text text-justify pad">¡¡¡ Filtra y encuentra!!! Lo que buscas está ahi. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">COMIENZA LA INTERACCIÓN</h3>

                        </div>
                        <div class="panel-body">
                            <p class="list-group-item-text text-justify pad">Comunícate directamente con otros usuarios. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <jsp:include page="vista/footer.jsp"/>

        <script>
                $('.carousel').carousel({
            interval: 2800
            });
        </script>

        <script type="text/javascript">
                function alertName() {
                var nombrejsp = "<%= request.getParameter("nombrejsp")%>";
                var msgerror = "<%= request.getAttribute("mensajeError")%>";
                var msgerrorlogin = "<%= request.getAttribute("mensajeErrorLogin")%>";
                var msgerrorrecupass = "<%= request.getAttribute("mensajeErrorRecuPass")%>";
                            if (msgerror != "null" && nombrejsp == "valorRegistro") {
                            mostraropciones();
                        $("#registro").modal("show");
                            } else if (nombrejsp == "valorRegistro") {
                        $("#registrocorrecto").modal("show");
                            } else if (msgerrorlogin != "null" && nombrejsp == "valorLogin") {
                        $("#login").modal("show");
                            } else if (msgerrorrecupass != "null" && nombrejsp == "valorRecuPass") {
                        $("#recuperar_pass").modal("show");
                            } else if (nombrejsp == "valorRecuPass") {
                        $("#exitocambiopass").modal("show");
                            } else if (nombrejsp == "valorusuelim") {
                    $("#usueliminado").modal("show");
                }
            }
        </script> 
        <script type="text/javascript"> window.onload = alertName;</script>        
    </body>
</html>