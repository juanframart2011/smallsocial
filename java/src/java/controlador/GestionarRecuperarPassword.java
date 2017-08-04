/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
package controlador;

import java.io.IOException;
import java.io.PrintWriter;
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
public class GestionarRecuperarPassword extends HttpServlet {

   private BD bd;
   String email;
   String seguridad;
   String password;
   @Override
   public void init() throws ServletException {

   }

   @Override
   protected void doPost(HttpServletRequest request, HttpServletResponse response)throws ServletException, IOException {
       bd = new BD();
       Boolean actualiza = false;
       email = request.getParameter("emailrecu");
       seguridad = request.getParameter("segur");
       password = request.getParameter("Passw");      
       String codUsuario= bd.getUsuario(email, seguridad);     
       if (codUsuario != ""){
           actualiza = bd.cambiarPassword(codUsuario,password);
           if(actualiza == false){
               request.setAttribute("mensajeErrorRecuPass", "Se ha producido un error");
           }
       }
       else{
           request.setAttribute("mensajeErrorRecuPass", "Usuario y/o Seguridad incorrectos");
       }
       RequestDispatcher rd = request.getRequestDispatcher("index.jsp");
       rd.forward(request, response);
   }
   @Override
    public void destroy() {
        bd.close();

    }
}
