package org.apache.jsp.vista;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import modelo.Usuario;
import modelo.BD;

public final class miPerfilJugadorEntrenador_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.List<String> _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public java.util.List<String> getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html;charset=UTF-8");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("<!DOCTYPE html>\n");

    String imageurlPerf = "";
    String coduser = "";
    String pNombre = "";
    int pEdad = 0;
    String pLocalidad = "";
    String pTipoUsu = "";
    String pPosicion = "";
    String pEntrenarEquipo = "";
    String posEntrenarEqu = "";
    String filePerf = "";
    Usuario usrPerf = new Usuario();
    BD bdPerf = new BD();

    System.out.println("ENTRA EN MIPERFILJUGADORENTRENADOR");
    coduser = (String) session.getAttribute("codUsuario");
    usrPerf = bdPerf.getUserData(coduser);
    imageurlPerf = bdPerf.getImagePerf(coduser);
    System.out.println("La URL  de usuario generico es: " + imageurlPerf);
    pNombre = usrPerf.getNomUsuario();
    System.out.println("El nombre de usuario generico es: " + pNombre);
    pEdad = usrPerf.getEdad();
    System.out.println("Edad de usuario generico es: " + pEdad);
    pLocalidad = usrPerf.getLocalidad();
    System.out.println("Localidad de usuario generico es: " + pLocalidad);
    pTipoUsu = usrPerf.getTipoUsu();
    System.out.println("Tipo Usuario de usuario generico es: " + pTipoUsu);
    pPosicion = usrPerf.getPosicion();
    System.out.println("Posicion de usuario generico es: " + pPosicion);
    pEntrenarEquipo = usrPerf.getEntrenarEquipo();
    System.out.println("Entrenar Equipo de usuario generico es: " + pEntrenarEquipo);
    if (pPosicion == "null") {
        posEntrenarEqu = pEntrenarEquipo;
    } else {
        posEntrenarEqu = pPosicion;
    }
    if (imageurlPerf
            != "../img/imagenperfildefecto.png") {
        filePerf = imageurlPerf.substring(imageurlPerf.lastIndexOf("\\") + 1);
        imageurlPerf = "..//imagenPerfil//" + filePerf;
    }
    bdPerf.close();


      out.write("\n");
      out.write("<div id=\"parteDerePerfil\" class=\"parteDerePerfil\">\n");
      out.write("    <div id=\"cabeceraperfil\" class=\"cabeceraperfil\">\n");
      out.write("        <a href=\"home.jsp\"> \n");
      out.write("            <div id=\"botonx\" class=\"botonx\"></div>\n");
      out.write("        </a>  \n");
      out.write("        <div id=\"textoCabePerfil\" class=\"textoCabePerfil\">\n");
      out.write("            <span>MI PERFIL</span>\n");
      out.write("        </div>        \n");
      out.write("    </div>\n");
      out.write("    <div class=\"contenidoperfil\">\n");
      out.write("        <div class=\"menuperfil\">\n");
      out.write("            <div class=\"imaperfil\">               \n");
      out.write("                <img class=\"fotoperfil\" src=\"");
      out.print(imageurlPerf);
      out.write("\"/>\n");
      out.write("            </div>\n");
      out.write("            <div class=\"botonsobremi\">\n");
      out.write("                <a><img class=\"btnsobremi\" onclick='mostrarPerfilInfo()' src=\"../img/btnPerfil.png\"/></a>\n");
      out.write("            </div>\n");
      out.write("            <div class=\"botoninformacion\" onclick='mostrarInfo()'>\n");
      out.write("                <a><img class=\"btninfo\" src=\"../img/btnInfo.png\"/></a>\n");
      out.write("            </div>\n");
      out.write("            <div class=\"botonimagenvideo\" onclick='mostrarImaVideo();\n");
      out.write("                    oculFotoVideoPerfil();\n");
      out.write("                    muestrobtnperfilelim()'>\n");
      out.write("                <a><img class=\"btnimavideo\" src=\"../img/btnImaVid.png\"/></a>\n");
      out.write("            </div>\n");
      out.write("            <div class=\"botonajustes\" onclick='mostrarAjustes()'>\n");
      out.write("                <a><img class=\"btnajustes\" src=\"../img/btnAjustes.png\"/></a>\n");
      out.write("            </div>\n");
      out.write("        </div>        \n");
      out.write("        <div class=\"datosperfil\">\n");
      out.write("            <div class=\"bcard\">\n");
      out.write("                <div class=\"border-top gray1\"></div>\n");
      out.write("                <div class=\"border-top gray2\"></div>\n");
      out.write("                <div class=\"border-top gray3\"></div>\n");
      out.write("                <div class=\"title\">\n");
      out.write("                    <h1>");
      out.print(pNombre);
      out.write("</h1>\n");
      out.write("                    <h2> ");
      out.print(pEdad);
      out.write(" años, ");
      out.print(pLocalidad);
      out.write(" </h2>                    \n");
      out.write("                </div>\n");
      out.write("                <header class=\"usuariodatos\">\n");
      out.write("                    <h1>");
      out.print(pNombre);
      out.write("</h1>\n");
      out.write("                    <h2> ");
      out.print(pEdad);
      out.write(" años, ");
      out.print(pLocalidad);
      out.write(" </h2>\n");
      out.write("                </header>\n");
      out.write("                <div class=\"contact_details\">   \n");
      out.write("\n");
      out.write("                    <p>");
      out.print(pTipoUsu);
      out.write(',');
      out.write(' ');
      out.print(posEntrenarEqu);
      out.write("</p>\n");
      out.write("\n");
      out.write("                </div>\n");
      out.write("                <footer class=\"interactuausuario\">\n");
      out.write("                    <a href=\"#\" title=\"Mensajes\"><i class=\"fa fa-comments\" onmousedown=\"return false;\"></i></a>                     \n");
      out.write("                </footer>\n");
      out.write("            </div>\n");
      out.write("            <div class=\"miInfo\">\n");
      out.write("                ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "miInformacionJugadorEntrenador.jsp", out, false);
      out.write("             \n");
      out.write("            </div>\n");
      out.write("            <div class=\"miAjuste\">\n");
      out.write("                ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "ajustesusuario.jsp", out, false);
      out.write("                \n");
      out.write("            </div>\n");
      out.write("            <div class=\"misFotosVideos\">\n");
      out.write("                ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "miFotosVideos.jsp", out, false);
      out.write("\n");
      out.write("            </div>\n");
      out.write("        </div>\n");
      out.write("    </div>\n");
      out.write("</div>\n");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
