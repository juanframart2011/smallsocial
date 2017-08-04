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
import modelo.Usuario;

/**
 *
 * @author Orion
 */
public class GestionarCodUsuAjeno extends HttpServlet {

    private BD bd;
   Usuario usr = new Usuario();
   
   @Override
   public void init() throws ServletException {

   }

   @Override
   protected void doPost(HttpServletRequest request, HttpServletResponse response)
           throws ServletException, IOException {

       bd = new BD();
       
       String codUsuAjeno = request.getParameter("codUsuAjeno");      
       usr = bd.getUserData(codUsuAjeno);
       request.setAttribute("tipoUsu",usr.getTipoUsu());       
       response.setContentType("text/html;charset=UTF-8");
       response.getWriter().write(usr.getTipoUsu());
       
   }

   @Override
   public void destroy() {
       bd.close();
   }
}