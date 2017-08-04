package org.apache.jsp.vista;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class pruebaborrar_jsp extends org.apache.jasper.runtime.HttpJspBase
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
      out.write("        \n");
      out.write("        \n");
      out.write("        <link href=\"../css/bootstrap.css\" rel=\"stylesheet\">\n");
      out.write("       \n");
      out.write("        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n");
      out.write("        <title>JSP Page</title>\n");
      out.write("    </head>\n");
      out.write("    <body>\n");
      out.write("        <h1>Hello World!</h1>\n");
      out.write("        <div class=\"form-group\">\n");
      out.write("            <label for=\"registro-localidad\" class=\"col-lg-3\">Localidad:</label>\n");
      out.write("            <div class=\"col-lg-9 \">\n");
      out.write("                <input type=\"text\" class=\"form-control\" id=\"registro-localidad\" name=\"Location\" placeholder=\"Seleccione su localidad\" required=\"\">\n");
      out.write("                \n");
      out.write("                <script src=\"https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE\"></script>\n");
      out.write("                <script>\n");
      out.write("                    function init() {\n");
      out.write("                        var input = document.getElementById('registro-localidad');\n");
      out.write("                        var opts = {\n");
      out.write("                            types: ['(cities)']\n");
      out.write("                        };\n");
      out.write("                        var autocomplete = new google.maps.places.Autocomplete(input, opts);\n");
      out.write("\n");
      out.write("                        //Bloqueamos el input si seleccionamos una localidad y hacemos visible el botón 'Borrar Localidad'\n");
      out.write("                        google.maps.event.addListener(autocomplete, 'place_changed', function () {\n");
      out.write("                            var result = autocomplete.getPlace();\n");
      out.write("\n");
      out.write("                            //addressObj.types[j] - confirma que es un pais\n");
      out.write("                            //addressObj.long_name - se obtiene el nombre del pais\n");
      out.write("                            for (var i = 0; i < result.address_components.length; i++) {\n");
      out.write("                                var addressObj = result.address_components[i];\n");
      out.write("                                for (var j = 0; j < addressObj.types.length; j++) {\n");
      out.write("                                    //console.log(addressObj.types[j]);\n");
      out.write("                                    if (addressObj.types[j] == 'locality') {\n");
      out.write("                                        console.log(addressObj.long_name);\n");
      out.write("                                    }\n");
      out.write("                                    if (addressObj.types[j] == 'country') {\n");
      out.write("                                        console.log(addressObj.long_name);\n");
      out.write("                                    }\n");
      out.write("                                }\n");
      out.write("                            }\n");
      out.write("                           \n");
      out.write("                            \n");
      out.write("                        });\n");
      out.write("                    }\n");
      out.write("                    google.maps.event.addDomListener(window, 'load', init);\n");
      out.write("                </script>\n");
      out.write("            </div>\n");
      out.write("        </div>      \n");
      out.write("\n");
      out.write("    </body>\n");
      out.write("</html>\n");
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
