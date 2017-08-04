/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;

import java.io.IOException;
import java.util.ArrayList;
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
public class GestionarVisitas extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        bd = new BD();
        boolean insertado;
        boolean contvisitas;
        boolean actualizado;
        boolean esta;
        HttpSession session = request.getSession(true);
        String horaVisita = bd.obtenerFechaHoraVisita();       
        String coduser = (String) session.getAttribute("codUsuario");
        String codUserAj = request.getParameter("codUserAje");
        esta = bd.estaEnVisitas(coduser, codUserAj);
        if (!esta) {
            insertado = bd.insertarVisita(coduser, codUserAj, horaVisita);

        } else {
            actualizado = bd.actualizarHoraVisita(coduser, codUserAj, horaVisita);
        }
        contvisitas = bd.acumNumVisitas(codUserAj);

    }

    @Override
    public void destroy() {
        bd.close();

    }

}
