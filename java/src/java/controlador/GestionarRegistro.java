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

/**
 *
 * @author Orion
 */
public class GestionarRegistro extends HttpServlet {

    private BD bd;

    @Override
    public void init() throws ServletException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        bd = new BD();
        boolean hayEmailRepe = false;
        boolean hayNikRepe = false;

        response.setContentType("text/html;charset=UTF-8");
        request.setCharacterEncoding("UTF-8");
        
        String codUsuario = null;
        Boolean online = false;
        Integer contFavoritos = 0;
        Integer contVisitas = 0;
        Integer contMensajes = 0;
        String fechaAltaSql = bd.obtenerFechaHoy();
        String nik = request.getParameter("nick");
        String nombre = request.getParameter("Username");
        nombre = nombre.toLowerCase();
        String mayuscula = nombre.charAt(0) + "";
        mayuscula = mayuscula.toUpperCase();
        nombre = nombre.replaceFirst(nombre.charAt(0) + "", mayuscula);
        codUsuario = bd.generarCodigoUsuario(nombre);
        String password = request.getParameter("Password");
        String repePassword = request.getParameter("Password2");
        String seguridad = request.getParameter("seguridad");
        String localidad = request.getParameter("Location");
        int edad = Integer.parseInt(request.getParameter("Age"));
        String sexo = request.getParameter("radiosexo");
        String radiotipousu = request.getParameter("radiotipousuario");
        String radiotipoequipo = request.getParameter("radiotipoequipo");
        String radioposicion = request.getParameter("radioposicion");
        String radioentrenarequipo = request.getParameter("radioentrenarequipo");
        String email = request.getParameter("Mail");

        String mensajeInsertar = "";
        String passwordHass = "";

        //Validamos que el nik no es repetido
        hayNikRepe = bd.validarNik(nik);

        //Si hay un nik repetido mostramos mensaje de error y sino realizamos inserción
        if (hayNikRepe == true) {
            //seteamos los atributos que queremos recuperar y utilizar en otros jsps
            request.setAttribute("mensajeError", "Nick ya usado");
            request.setAttribute("valorNombre", nombre);
            request.setAttribute("valorEmail", email);
            request.setAttribute("valorEdad", edad);
        } else {

            //Validamos que el email no es repetido
            hayEmailRepe = bd.validarEmail(email);

            //Si hay un email repetido mostramos mensaje de error y sino realizamos inserción
            if (hayEmailRepe == true) {
                //seteamos los atributos que queremos recuperar y utilizar en otros jsps
                request.setAttribute("mensajeError", "Email repetido");
                request.setAttribute("valorNombre", nombre);
                request.setAttribute("valorEmail", email);
                request.setAttribute("valorEdad", edad);
            } else {
                passwordHass = bd.encriptarClaveHash(password);
                mensajeInsertar = bd.insertarNuevoUsuario(codUsuario, nombre, passwordHass, seguridad, localidad, edad, sexo, radiotipousu, radiotipoequipo, radioposicion, radioentrenarequipo, email, fechaAltaSql, online, nik,contVisitas,contFavoritos,contMensajes);
            }
        }

        RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
        rd.forward(request, response);
        //response.sendRedirect("index.jsp");
    }

    public void destroy() {
        bd.close();
    }
}
