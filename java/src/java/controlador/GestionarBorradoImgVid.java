/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.io.File;
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.BD;
import modelo.InfoUsuario;
import modelo.Usuario;

/**
 *
 * @author Orion
 */
public class GestionarBorradoImgVid extends HttpServlet {

    private BD bd;
    private Usuario usr;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        bd = new BD();
        boolean correcto;
        String nombreVideo;
        String urlVidCompl="";
        String nombreFoto;
        String urlImgCompl="";        
        String codUser = request.getParameter("codUser");
        String urlImg = request.getParameter("urlImagen");       
        String urlVid = request.getParameter("urlVideo");       
        if (!urlVid.equals("")) {
            nombreVideo = urlVid.substring(urlVid.lastIndexOf("/") + 1);
            System.out.println("EL NOMBRE DEL VIDEO ES: " + nombreVideo);
            urlVidCompl = "C:\\\\Users\\\\Borja\\\\Documents\\\\NetBeansProjects\\\\MeeTeam\\\\web\\\\misVideos\\\\" + nombreVideo;          
            correcto = bd.eliminarVideo(codUser, urlVidCompl);
            if (correcto) {
            File fichero = new File(urlVidCompl);            
            fichero.delete();
        }
        } else {
            nombreFoto = urlImg.substring(urlImg.lastIndexOf("/") + 1);           
            urlImgCompl = "C:\\\\Users\\\\Borja\\\\Documents\\\\NetBeansProjects\\\\MeeTeam\\\\web\\\\misFotos\\\\" + nombreFoto;            
            correcto = bd.eliminarFoto(codUser, urlImgCompl);
            File fichero = new File(urlImgCompl);            
            fichero.delete();
            
        }
        
    }
    
     @Override
    public void destroy() {
        bd.close();

    }
}
