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
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import modelo.BD;
import modelo.Usuario;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author Orion
 */
public class GestionarBusGenteCerca extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String codUsuSinLoc = (String) request.getParameter("codUsu");
        System.out.println("sdsdsdsd: " + codUsuSinLoc);
        String loca = "";
        ArrayList locali = new ArrayList();
        int edadDesde = 0;
        int edadHasta = 0;
        //Si no hemos rellenado la localidad cogemos la del usuario
        if (codUsuSinLoc != null && codUsuSinLoc != "") {

            try {
                bd = new BD();
                loca = bd.obtenerLocUsuario(codUsuSinLoc);
                String ciudad = loca.substring(0, loca.indexOf(","));
                String pais = loca.substring(loca.indexOf(",") + 1, loca.length());
                locali.add(ciudad);
                locali.add(pais);
                JSONObject js = new JSONObject();
                js.put("localidades", locali); // make sure the Country class overrides toString()
                System.out.println(ciudad);
                response.setContentType("application/json");
                response.setCharacterEncoding("utf-8");
                response.getWriter().write(js.toString());
            } catch (JSONException ex) {
                Logger.getLogger(GestionarBusGenteCerca.class.getName()).log(Level.SEVERE, null, ex);
            }

        } else {
            HttpSession sesionBusqueda = request.getSession(true);
            String micoduser = (String) sesionBusqueda.getAttribute("codUsuario");

            bd = new BD();
            if (request.getParameter("edadDesde") != null && request.getParameter("edadDesde") != "") {
                edadDesde = Integer.parseInt(request.getParameter("edadDesde"));
            }
            if (request.getParameter("edadHasta") != null && request.getParameter("edadHasta") != "") {
                edadHasta = Integer.parseInt(request.getParameter("edadHasta"));
            }
            ArrayList<ArrayList> usuariosBusquedaLoc = new ArrayList();
            ArrayList<ArrayList> aCompCodUsu = new ArrayList();
            String sexoBus = "";
            String tipEqui = "";
            String[] sexo = request.getParameterValues("sexo[]");

            String[] busLoc = request.getParameterValues("busLocali[]");

            String tipoUsu = request.getParameter("busTipoUsu");
            String[] tipoEquipo = request.getParameterValues("tipoequipo[]");

            if (tipoUsu.equals("Jugador") || tipoUsu.equals("Entrenador")) {
                for (int j = 0; j < sexo.length; j++) {
                    if (sexo.length == 2) {
                        sexoBus = "Ambos";
                    } else {
                        if (sexo[j].equals("Hombre")) {
                            sexoBus = "chico";
                        } else if (sexo[j].equals("Mujer")) {
                            sexoBus = "chica";
                        }
                    }
                }
            } else {
                for (int j = 0; j < tipoEquipo.length; j++) {
                    if (tipoEquipo.length == 2) {
                        tipEqui = "Ambos";
                    } else {
                        if (tipoEquipo[j].equals("Federado")) {
                            tipEqui = "Federado";
                        } else if (tipoEquipo[j].equals("Amateur")) {
                            tipEqui = "Amateur";
                        }
                    }
                }
            }

            for (int i = 0; i < busLoc.length; i++) {
                usuariosBusquedaLoc = bd.obtenerGenteCercaLoc(tipoUsu, tipEqui, busLoc[i], sexoBus, edadDesde, edadHasta, aCompCodUsu, micoduser);
            }

            sesionBusqueda.setAttribute("usuLocEquipo", usuariosBusquedaLoc);

            response.sendRedirect("vista/home.jsp?usuLocEquipo=" + usuariosBusquedaLoc);

            //RequestDispatcher rd = request.getRequestDispatcher("vista/home.jsp");
            //rd.forward(request, response);
        }

    }

    @Override
    public void destroy() {
        bd.close();

    }
}
