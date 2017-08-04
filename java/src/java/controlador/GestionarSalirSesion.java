/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import modelo.BD;

/**
 *
 * @author Orion
 */

@WebServlet("/logout")
public class GestionarSalirSesion extends HttpServlet {
    private BD bd;

     @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        BD bd = new BD();
        bd.cambiarEstadoOnline(request.getSession().getAttribute("codUsuario").toString());
        request.getSession().invalidate();
        response.sendRedirect(request.getContextPath() + "/index.jsp");
    }
    
    @Override
    public void destroy() {
        bd.close();
    }

}
