<%-- 
    Document   : miFotosVideos
    Created on : 01-dic-2016, 18:40:27
    Author     : Orion
--%>

<%@page import="java.util.ArrayList"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="modelo.BD"%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%String coduser = (String) session.getAttribute("codUsuario");%>
<!DOCTYPE html>



<div class="fotosVideosUsu">
    <div class='btnFotosVideos'>
        <input type="button" onclick="visualizarSoloFoto()" class="btnAnadirFotos" value="Añadir Fotos" />
        <input type="button" onclick="visualizarSoloVideo()" class="btnAnadirVideos" value="Añadir Videos" />
    </div>
    <form class="contact_form" action="fotosCarga.jsp" id="formulario_fotoscarga" name="formulario_fotoscarga" enctype="multipart/form-data" method="POST">
        <div class="fotoMiPerfil" id="fotoMiPerfil">
            <font class="txtFoto">Añadir Foto: </font>
            <input id="fileimags" type="file" name="pic" accept="image/*">
            <input type="submit" class="cargarfotos" id="cargarfotos" value="Cargar Fotos" />
            <input type="reset" name="b_borrarfoto" value="reset" style="display:none"/> 
        </div>    
    </form>
    <form class="contact_form" action="videosCarga.jsp" id="formulario_videoscarga" name="formulario_videoscarga" enctype="multipart/form-data" method="POST">
        <div class="videoMiPerfil" id="videoMiPerfil">
            <font class="txtVideo">Añadir Video: </font>            
            <input id="filevideos" type="file" name="video" accept="video/mp4,video/ogg">
            <input type="submit" class="cargarvideos" id="cargarvideos" value="Cargar Videos" />
            <div class="formatovideo">
                <h2>El formato del video tiene que ser .mp4 o .ogg</h2>
            </div>
            <input type="reset" name="b_borrarvideo" value="reset" style="display:none"/> 
        </div>
    </form>
    <div class="txtmisfotvid">
        <font class="txtMisFotVid">Mis Fotos/Videos:</font>
    </div>

    <div class="carruselfotvid">
        <div class="slides">
            <div class="btneliminar-perfil">
                <i title="Borrar Foto / Video" class="fa fa-trash-o" id="iconopapelera" onclick="eliminarvideofoto('<%=coduser%>')" onmousedown="return false;"></i>                
            </div>

            <div style="text-align:center;">

                <!-- Se define el Div de la galeria -->
                <div style="display:none;margin:0 auto;" class="html5gallery" data-skin="horizontal" data-width="480" data-height="250" data-resizemode="fill">

                    <!-- Añadir imagenes y videos a la Galeria -->
                    <%
                        BD bd = new BD();
                        String imageurl = "";
                        String videourl = "";
                        String file = "";
                        String fotoClass;
                        String videoClass;                       
                        ArrayList<String> listaImg = new ArrayList<String>();
                        ArrayList<String> listaVid = new ArrayList<String>();
                        listaImg = bd.obtenerImagenes(coduser);
                        listaVid = bd.obtenerVideos(coduser);
                        for (int i = 0; i < listaImg.size(); i++) {
                            file = listaImg.get(i).substring(listaImg.get(i).lastIndexOf("\\") + 1);
                            imageurl = "../misFotos/" + file;
                    %>

                    <a href="<%=imageurl%>"><img src="<%=imageurl%>" alt=""></a>
                   

                    <%
                        }
                        for (int i = 0; i < listaVid.size(); i++) {
                            file = listaVid.get(i).substring(listaVid.get(i).lastIndexOf("\\") + 1);
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
