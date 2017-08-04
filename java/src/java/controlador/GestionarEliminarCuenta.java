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
public class GestionarEliminarCuenta extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        HttpSession session = request.getSession(true);
        BD bd = new BD();
        Boolean usuElimi = false;
        usuElimi=bd.eliminarUsuario((String) session.getAttribute("codUsuario"));
        if (usuElimi) {
            request.getSession().invalidate();
            RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
            rd.forward(request, response);
            
        }
    }
     public void destroy() {
        bd.close();
    }
}
