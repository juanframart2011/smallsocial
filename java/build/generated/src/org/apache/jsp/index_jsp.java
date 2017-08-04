package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class index_jsp extends org.apache.jasper.runtime.HttpJspBase
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
      out.write("<!DOCTYPE html>\n");
      out.write("<html>\n");
      out.write("    <head>\n");
      out.write("        <meta charset=\"utf-8\" />\n");
      out.write("        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n");
      out.write("        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n");
      out.write("        <link rel=\"Shortcut Icon\" href=\"img/balon.png\">\n");
      out.write("        <title>MeeTeam</title>\n");
      out.write("        <link href=\"css/bootstrap.css\" rel=\"stylesheet\">\n");
      out.write("        <link href=\"css/estilos.css\" rel=\"stylesheet\">\n");
      out.write("        <script src=\"js/modernizr-2.8.3-respond-1.4.2.min.js\"></script>\n");
      out.write("        <script src=\"js/validacion.js\"></script>\n");
      out.write("        <script src=\"js/jquery.min.js\"></script> \n");
      out.write("        <script src=\"js/bootstrap.min.js\"></script>\n");
      out.write("\n");
      out.write("    </head>\n");
      out.write("    <body>\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/navBar.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalLogin.jsp", out, false);
      out.write("        \n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalRegistro.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalContact.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalrecuperarpass.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalregistrocorrecto.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modaleliminarusucorrecto.jsp", out, false);
      out.write("\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/modalexitocambiopass.jsp", out, false);
      out.write("\n");
      out.write("\n");
      out.write("        <div class=\"container-fluid\">\n");
      out.write("            <div class=\"jumbotron text-center jumboindex\">\n");
      out.write("                <h1 style=\"font-style: italic\"> \"Sport Is Life\"</h1>  \n");
      out.write("                <h3>La red social donde nadie se quedará sin equipo </h3>\n");
      out.write("            </div>\n");
      out.write("        </div>\n");
      out.write("\n");
      out.write("        <div  class=\"container\" id=\"contenedor\">\n");
      out.write("            <div id=\"myCarousel\" class=\"carousel slide\" data-interval=\"3000\" data-ride=\"carousel\">\n");
      out.write("                <ol class=\"carousel-indicators\">\n");
      out.write("                    <li data-target=\"#myCarousel\" data-slide-to=\"0\" class=\"active\"></li>\n");
      out.write("                    <li data-target=\"#myCarousel\" data-slide-to=\"1\"></li>\n");
      out.write("                    <li data-target=\"#myCarousel\" data-slide-to=\"2\"></li>\n");
      out.write("\n");
      out.write("                </ol>\n");
      out.write("                <!-- Carousel items -->\n");
      out.write("                <div class=\"carousel-inner\">\n");
      out.write("                    <div class=\"item active\"> <h1 class=\"h1c text-center\">Eficaz</h1></div>\n");
      out.write("                    <div class=\"item\"><h1 class=\"h1c text-center\">Deportiva</h1></div>\n");
      out.write("                    <div class=\"item\"><h1 class=\"h1c text-center\">Social</h1></div>\n");
      out.write("                </div>\n");
      out.write("                <!-- Carousel nav -->\n");
      out.write("            </div>\n");
      out.write("        </div>\n");
      out.write("\n");
      out.write("        <div class=\"container\">\n");
      out.write("            <div class=\"main row\">\n");
      out.write("                <div class=\"col-xs-12 col-sm-4 col-md-4\">\n");
      out.write("                    <div class=\"panel panel-primary\">\n");
      out.write("                        <div class=\"panel-heading\">\n");
      out.write("                            <h3 class=\"panel-title text-center\">CREA TU PERFIL </h3>\n");
      out.write("                        </div>\n");
      out.write("                        <div class=\"panel-body\">\n");
      out.write("                            <p class=\"list-group-item-text text-justify pad\">Elabora tu escaparate deportivo y date a conocer.</p>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("                <div class=\"col-xs-12 col-sm-4 col-md-4\">\n");
      out.write("                    <div class=\"panel panel-primary\">\n");
      out.write("                        <div class=\"panel-heading\">\n");
      out.write("                            <h3 class=\"panel-title text-center\">REALIZA LA BÚSQUEDA</h3>\n");
      out.write("                        </div>\n");
      out.write("                        <div class=\"panel-body\">\n");
      out.write("                            <p class=\"list-group-item-text text-justify pad\">¡¡¡ Filtra y encuentra!!! Lo que buscas está ahi. </p>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("                <div class=\"col-xs-12 col-sm-4 col-md-4\">\n");
      out.write("                    <div class=\"panel panel-primary\">\n");
      out.write("                        <div class=\"panel-heading\">\n");
      out.write("                            <h3 class=\"panel-title text-center\">COMIENZA LA INTERACCIÓN</h3>\n");
      out.write("\n");
      out.write("                        </div>\n");
      out.write("                        <div class=\"panel-body\">\n");
      out.write("                            <p class=\"list-group-item-text text-justify pad\">Comunícate directamente con otros usuarios. </p>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("            </div>\n");
      out.write("        </div>\n");
      out.write("        ");
      org.apache.jasper.runtime.JspRuntimeLibrary.include(request, response, "vista/footer.jsp", out, false);
      out.write("\n");
      out.write("\n");
      out.write("        <script>\n");
      out.write("                $('.carousel').carousel({\n");
      out.write("            interval: 2800\n");
      out.write("            });\n");
      out.write("        </script>\n");
      out.write("\n");
      out.write("        <script type=\"text/javascript\">\n");
      out.write("                function alertName() {\n");
      out.write("                var nombrejsp = \"");
      out.print( request.getParameter("nombrejsp"));
      out.write("\";\n");
      out.write("                var msgerror = \"");
      out.print( request.getAttribute("mensajeError"));
      out.write("\";\n");
      out.write("                var msgerrorlogin = \"");
      out.print( request.getAttribute("mensajeErrorLogin"));
      out.write("\";\n");
      out.write("                var msgerrorrecupass = \"");
      out.print( request.getAttribute("mensajeErrorRecuPass"));
      out.write("\";\n");
      out.write("                            if (msgerror != \"null\" && nombrejsp == \"valorRegistro\") {\n");
      out.write("                            mostraropciones();\n");
      out.write("                        $(\"#registro\").modal(\"show\");\n");
      out.write("                            } else if (nombrejsp == \"valorRegistro\") {\n");
      out.write("                        $(\"#registrocorrecto\").modal(\"show\");\n");
      out.write("                            } else if (msgerrorlogin != \"null\" && nombrejsp == \"valorLogin\") {\n");
      out.write("                        $(\"#login\").modal(\"show\");\n");
      out.write("                            } else if (msgerrorrecupass != \"null\" && nombrejsp == \"valorRecuPass\") {\n");
      out.write("                        $(\"#recuperar_pass\").modal(\"show\");\n");
      out.write("                            } else if (nombrejsp == \"valorRecuPass\") {\n");
      out.write("                        $(\"#exitocambiopass\").modal(\"show\");\n");
      out.write("                            } else if (nombrejsp == \"valorusuelim\") {\n");
      out.write("                    $(\"#usueliminado\").modal(\"show\");\n");
      out.write("                }\n");
      out.write("            }\n");
      out.write("        </script> \n");
      out.write("        <script type=\"text/javascript\"> window.onload = alertName;</script>        \n");
      out.write("    </body>\n");
      out.write("</html>");
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
