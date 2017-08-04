<%-- 
    Document   : ajenoFotosVideos
    Created on : 13-feb-2017, 11:35:21
    Author     : Orion
--%>

<%@page import="modelo.BD"%>
<%@page import="java.util.ArrayList"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>

<form  class="contact_form" action="#" id="formulario_fotosvideosusuajenos" name="formulario_fotosvideosusuajenos">
    <div class="fotosVideosUsu">
        <div class="txtmisfotvid">
            <font class="txtMisFotVid">Fotos/Videos:</font>
        </div>

        <div class="carruselfotvidAjeno">
            <div class="slidesAjeno">
                <div style="text-align:center;">
                    <!-- Se define el Div de la galeria -->
                    <div style="display:none;margin:0 auto;" class="html5gallery" data-skin="horizontal" data-width="480" data-height="250" data-resizemode="fill">

                        <!-- Visualizar imagenes y videos de su Galeria -->
                        <%
                            String coduserAjen = "";
                            ArrayList<String> listaImgAjen = new ArrayList<String>();
                            ArrayList<String> listaVidAjen = new ArrayList<String>();
                            BD bd = new BD();
                            String imageurl = "";
                            String videourl = "";
                            String file = "";
                            coduserAjen = (String) request.getParameter("codUsuAjeno");
                            listaImgAjen = bd.obtenerImagenes(coduserAjen);
                            listaVidAjen = bd.obtenerVideos(coduserAjen);
                            for (int i = 0; i < listaImgAjen.size(); i++) {

                                file = listaImgAjen.get(i).substring(listaImgAjen.get(i).lastIndexOf("\\") + 1);
                                imageurl = "../misFotos/" + file;

                        %>

                        <a href="<%=imageurl%>"><img src="<%=imageurl%>" alt=""></a>
                            <%

                                }
                                for (int i = 0; i < listaVidAjen.size(); i++) {
                                    file = listaVidAjen.get(i).substring(listaVidAjen.get(i).lastIndexOf("\\") + 1);
                                    videourl = "../misVideos/" + file;
                            %>                  
                        <a href="<%=videourl%>" data-hddefault="true" data-webm="<%=videourl%>" type="video/mp4,video/ogg"> <img src="../img/player_video.png" alt=""></a>
                            <%
                                }
                            %>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
