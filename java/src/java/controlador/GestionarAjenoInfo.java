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
import modelo.BD;
import modelo.InfoUsuario;
import modelo.Usuario;

/**
 *
 * @author Orion
 */
public class GestionarAjenoInfo extends HttpServlet {

    private BD bd;
    private Usuario usr;
    private InfoUsuario infoUsu;
    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        bd = new BD();
        usr = new Usuario();
        infoUsu = new InfoUsuario();
        String codUserAjen = (String) request.getParameter("codUsuAjeno");              
        infoUsu = bd.obtenerInfo(codUserAjen);
        request.setAttribute("elclub", infoUsu.getElClub());
        request.setAttribute("trayectoria", infoUsu.getTrayectoria());
        request.setAttribute("quebusco", infoUsu.getQueBusco());
        request.setAttribute("sobremi", infoUsu.getSobremi());
        request.setAttribute("experiencia", infoUsu.getExperiencia());
        usr = bd.getUserData(codUserAjen);
        String aux = usr.getTipoUsu();       
        if ("Equipo".equals(usr.getTipoUsu())) {
            RequestDispatcher rd = request.getRequestDispatcher("vista/ajenoInformacionEquipo.jsp");
            rd.forward(request, response);
        } else {
            RequestDispatcher rd = request.getRequestDispatcher("vista/ajenoInformacionJugadorEntrenador.jsp");
            rd.forward(request, response);
        }
    }

    public void destroy() {
        bd.close();
    }
}
