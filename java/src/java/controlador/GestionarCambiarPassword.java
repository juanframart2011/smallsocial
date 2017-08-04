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

/**
 *
 * @author Orion
 */
public class GestionarCambiarPassword extends HttpServlet {

    private BD bd;

    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        bd = new BD();
        HttpSession session = request.getSession(true);
        Boolean cambiarPass = false;
        String pPass = request.getParameter("cambiarPassw");
        String codUsu = (String) session.getAttribute("codUsuario");       
        cambiarPass = bd.cambiarPassword(codUsu, pPass);
        if (cambiarPass) {           
            response.sendRedirect(request.getContextPath() + "/vista/home.jsp?name='modal'"); //En la propia URL donde nos redirigimos, le pasamos la variable name que contiene un string llamado "modal".           
            //String path = request.getContextPath() + "/css/home.css"; 
            //RequestDispatcher rd = request.getRequestDispatcher(path + "home.jsp");
            //rd.forward(request, response);
        }
    }

    @Override
    public void destroy() {
        bd.close();

    }
}
