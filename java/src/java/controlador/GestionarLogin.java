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
public class GestionarLogin extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //Obtiene el objeto de sesion, Crea una nueva sesión si no existe
        HttpSession session = request.getSession(true);
        bd = new BD();
        Usuario usu = new Usuario();
        String user = request.getParameter("User");
        String pass = request.getParameter("Pass");
        usu = bd.validarUser(user, pass);

        //Control login
        if (!usu.getCodUsuario().equals("0") && !usu.getCodUsuario().equals("1")) {
          
            //ha iniciado session correctamente            
            session.setAttribute("codUsuario", usu.getCodUsuario());
            request.getSession().setMaxInactiveInterval(1000);
            response.sendRedirect("vista/home.jsp");
        } else if (usu.getCodUsuario().equals("0")) {
            request.setAttribute("mensajeErrorLogin", "No existe ningún usuario");
            RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
            rd.forward(request, response);
        } else {
            //el usuario o contraseña son incorrectos            
            request.setAttribute("mensajeErrorLogin", "Usuario y/o Contraseña incorrectos");
            RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
            rd.forward(request, response);
            //response.sendRedirect("index.jsp");
        }
    }

    @Override
    public void destroy() {
        bd.close();

    }
}
