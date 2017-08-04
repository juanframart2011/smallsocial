/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.io.IOException;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import modelo.BD;
import modelo.Usuario;

/**
 *
 * @author Orion
 */
public class GestionarMiInfo extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        bd = new BD();
        HttpSession session = request.getSession(true);
        response.setContentType("text/html;charset=UTF-8");
        request.setCharacterEncoding("UTF-8");
        String mensajeInsertar = "";
        Usuario usu = new Usuario();
        String coduser = (String) session.getAttribute("codUsuario");
        usu = bd.getUserData(coduser);
        String tipoUsu = usu.getTipoUsu();        
        String elclub = request.getParameter("textareainfoClub");
        String sobremi = request.getParameter("textareainfo");
        String experiencia = request.getParameter("textareaexp");
        String quebusco = request.getParameter("textareabusqueda");
        String trayectoria = request.getParameter("textareatray");
        mensajeInsertar = bd.insertarInfo(coduser, tipoUsu, elclub, trayectoria, quebusco, sobremi, experiencia);
        response.sendRedirect(request.getContextPath() + "/vista/home.jsp?name='modalInfo'");
       
    }

    public void destroy() {
        bd.close();
    }
}
