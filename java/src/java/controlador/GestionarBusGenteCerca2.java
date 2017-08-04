/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
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
public class GestionarBusGenteCerca2 extends HttpServlet {

    private BD bd;
    private Object session;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        HttpSession sesionBusqueda = request.getSession(true);
        String micoduser = (String) sesionBusqueda.getAttribute("codUsuario");
        bd = new BD();
        ArrayList<ArrayList> usuariosBusqueda = new ArrayList();
        ArrayList usuariosBus = new ArrayList();

        String tipoBusqueda = request.getParameter("nomBusqueda");

        
        usuariosBusqueda = bd.obtenerGenteCerca(tipoBusqueda,usuariosBus,micoduser);        
       

        sesionBusqueda.setAttribute("usuLocEquipo", usuariosBusqueda);

        response.sendRedirect("vista/home.jsp?usuLocEquipo=" + usuariosBusqueda);
        
        //RequestDispatcher rd = request.getRequestDispatcher("vista/home.jsp");
        //rd.forward(request, response);
    }

    @Override
    public void destroy() {
        bd.close();

    }
}
