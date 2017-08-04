<%-- 
    Document   : errorPage
    Created on : 17-oct-2016, 20:12:43
    Author     : Orion
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META HTTP-EQUIV="REFRESH" CONTENT="6;URL=/MeeTeam/index.jsp"> 
        <link rel="Shortcut Icon" href="../img/balon.png">
        <title>Página Error</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script src="../js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="../js/jquery.min.js"></script> 
        <script src="../js/anima.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel ="stylesheet" type="text/css" href="../css/estilos.css" />
    </head>
    <body class="bError">
        <jsp:include page="navExtra.jsp"/>

        <div class="container"> 
            <div class="row">
                <hgroup class="col-xs-12 col-sm-12 col-md-12">
                    <h1 class="h1Error">Lo sentimos, ha ocurrido un error</h1>
                    <h2 class="h2Error">Redirigiendo a la página principal... </h2>
                </hgroup>
            </div>
        </div>
        <div id ="anima" class="img-responsive"> </div>
        <jsp:include page="footer.jsp"/>

    </body>
</html>
