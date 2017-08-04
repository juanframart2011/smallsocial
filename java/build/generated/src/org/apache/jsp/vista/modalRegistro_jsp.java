package org.apache.jsp.vista;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class modalRegistro_jsp extends org.apache.jasper.runtime.HttpJspBase
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
      out.write("<meta charset=\"UTF-8\">\n");
      out.write("<div class=\"modal fade registro\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"registro\" aria-hidden=\"true\" id=\"registro\">\n");
      out.write("    <div class=\"modal-dialog\">\n");
      out.write("        <div class=\"modal-content\">\n");
      out.write("            <form class=\"form-horizontal\" id=\"formulario_registro\" name=\"formulario_registro\" action=\"GestionarRegistro\" method=\"POST\">\n");
      out.write("                <div class=\"modal-header\">\n");
      out.write("                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n");
      out.write("                    <h4>Registrate en MeeTeam</h4>   \n");
      out.write("                </div>  \n");
      out.write("                <div class=\"modal-body\">\n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"registro-name\" class=\"col-lg-3\">Nombre:</label>\n");
      out.write("                        <div class=\"col-lg-9\">\n");
      out.write("                            <input type=\"text\" class=\"form-control\" id=\"registro-name\" name=\"Username\" placeholder=\"Escriba su nombre de usuario\" required=\"\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorNombre}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\">\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"registro-password\" class=\"col-lg-3\">Contraseña:</label>\n");
      out.write("                        <div class=\"col-lg-9\">\n");
      out.write("                            <input type=\"password\" class=\"form-control\" id=\"registro-password\" name=\"Password\" placeholder=\"Escriba su contraseña\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorPass}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                        </div>\n");
      out.write("                    </div> \n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"registro-password2\" class=\"col-lg-3\">Rep. Contraseña:</label>\n");
      out.write("                        <div class=\"col-lg-9\">\n");
      out.write("                            <input type=\"password\" class=\"form-control\" id=\"registro-password2\" name=\"Password2\" placeholder=\"Repita su contraseña\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorRepePass}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"registro-password2\" class=\"col-lg-3\">Seguridad:</label>\n");
      out.write("                        <div class=\"col-lg-9\">\n");
      out.write("                            <input type=\"text\" class=\"form-control\" id=\"registro-seguridad\" name=\"seguridad\" placeholder=\"Escriba una palabra/frase para recuperar contraseña\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorSegu}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"registro-localidad\" class=\"col-lg-3\">Localidad:</label>\n");
      out.write("                        <div class=\"col-lg-9 \">\n");
      out.write("                            <input type=\"text\" class=\"form-control\" id=\"registro-localidad\" name=\"Location\" placeholder=\"Seleccione su localidad\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorLoca}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                            <a class=\"btn btn-default\" id=\"btnLocalidad\" onclick=\"desbloquearLocalidad()\">Borrar Localidad</a> \n");
      out.write("                            <script src=\"https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDOieTDxaSKgXg-L4xoZEUulLJz2AvhDKE\"></script>\n");
      out.write("                            <script>\n");
      out.write("                                function init() {\n");
      out.write("                                    var input = document.getElementById('registro-localidad');\n");
      out.write("                                    var opts = {\n");
      out.write("                                        types: ['(cities)']\n");
      out.write("                                    };\n");
      out.write("                                    var autocomplete = new google.maps.places.Autocomplete(input, opts);\n");
      out.write("\n");
      out.write("                                    //Bloqueamos el input si seleccionamos una localidad y hacemos visible el botón 'Borrar Localidad'\n");
      out.write("                                    google.maps.event.addListener(autocomplete, 'place_changed', function () {\n");
      out.write("                                        var result = autocomplete.getPlace();\n");
      out.write("\n");
      out.write("                                        //addressObj.types[j] - confirma que es un pais\n");
      out.write("                                        //addressObj.long_name - se obtiene el nombre del pais\n");
      out.write("                                        for (var i = 0; i < result.address_components.length; i++) {\n");
      out.write("                                            var addressObj = result.address_components[i];\n");
      out.write("                                            for (var j = 0; j < addressObj.types.length; j++) {\n");
      out.write("                                                //console.log(addressObj.types[j]);\n");
      out.write("                                                if (addressObj.types[j] == 'locality') {\n");
      out.write("                                                    console.log(addressObj.long_name);\n");
      out.write("                                                }\n");
      out.write("                                                if (addressObj.types[j] == 'country') {\n");
      out.write("                                                    console.log(addressObj.long_name);\n");
      out.write("                                                }\n");
      out.write("                                            }\n");
      out.write("                                        }\n");
      out.write("\n");
      out.write("                                        document.getElementById('registro-localidad').readOnly = true;\n");
      out.write("                                        document.getElementById('btnLocalidad').style.display = 'block';\n");
      out.write("                                    });\n");
      out.write("                                }\n");
      out.write("                                google.maps.event.addDomListener(window, 'load', init);\n");
      out.write("                            </script>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div class=\"form-group\">                        \n");
      out.write("                        <label for=\"registro-edad\" class=\"col-lg-3\">Edad/Antigüedad:</label>\n");
      out.write("                         <div class=\"col-lg-9\">\n");
      out.write("                             <input type=\"number\" class=\"form-control\" id=\"registro-edad\" name=\"Age\" placeholder=\"Escriba su edad o antigüedad del club\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorEdad}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label class=\"col-lg-4\">Tipo de Usuario:</label>\n");
      out.write("                        <div class=\"col-lg-8 opcionesradiobuton\">\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"tipoUser1\" checked name=\"radiotipousuario\" onclick=\"mostraropciones()\" value=\"Equipo\" >Equipo\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"tipoUser2\" name=\"radiotipousuario\" onclick=\"mostraropciones()\" value=\"Jugador\">Jugador\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"tipoUser3\" name=\"radiotipousuario\" onclick=\"mostraropciones()\" value=\"Entrenador\">Entrenador\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div> \n");
      out.write("                    <div id=\"tipo-equipo\" class=\"form-group\">\n");
      out.write("                        <label class=\"col-lg-4\">Tipo de Equipo:</label>\n");
      out.write("                        <div class=\"col-lg-8 opcionesradiobuton\">\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"tipoEquipo1\"  name=\"radiotipoequipo\" value=\"Federado\" >Federado\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"tipoEquipo2\" name=\"radiotipoequipo\"  value=\"Amateur\">Amateur\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div> \n");
      out.write("                    <div id=\"tipo-posicion\" class=\"form-group\">\n");
      out.write("                        <label class=\"col-lg-4\">Posición:</label>\n");
      out.write("                        <div class=\"col-lg-8 opcionesradiobuton\">\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"posicionJugador1\" name=\"radioposicion\" value=\"Portero\" >Portero\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"posicionJugador2\" name=\"radioposicion\"  value=\"Cierre\">Cierre\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"posicionJugador3\" name=\"radioposicion\"  value=\"Ala\">Ala\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"posicionJugador4\" name=\"radioposicion\"  value=\"Pivote\">Pivote\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"posicionJugador5\" name=\"radioposicion\"  value=\"Cualquiera\">Cualquiera\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div>\n");
      out.write("                    <div id=\"tipo-entrenar-equipo\" class=\"form-group\">\n");
      out.write("                        <label class=\"col-lg-4\">Entrenar Equipo:</label>\n");
      out.write("                        <div class=\"col-lg-8 opcionesradiobuton\">\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"entrenarEquipo1\"  name=\"radioentrenarequipo\" value=\"Federado\" >Federado\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"entrenarEquipo2\" name=\"radioentrenarequipo\"  value=\"Amateur\">Amateur\n");
      out.write("                            </div>\n");
      out.write("                            <div class=\"radio-inline\">\n");
      out.write("                                <input type=\"radio\"  id=\"entrenarEquipo3\" name=\"radioentrenarequipo\"  value=\"Cualquiera\">Cualquiera\n");
      out.write("                            </div>\n");
      out.write("                        </div>\n");
      out.write("                    </div> \n");
      out.write("                    <div class=\"form-group\">\n");
      out.write("                        <label for=\"contact-email\" class=\"col-lg-3\">Email:</label>\n");
      out.write("                        <div class=\"col-lg-9\">\n");
      out.write("                            <input type=\"email\" class=\"form-control\" id=\"contact-email\" name=\"Mail\" placeholder=\"tu@ejemplo.com\" value=\"");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${valorEmail}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("\" required=\"\">\n");
      out.write("                        </div>\n");
      out.write("                    </div>                     \n");
      out.write("                </div>             \n");
      out.write("                <div class=\"modal-footer\">\n");
      out.write("                    <a class=\"btn btn-default\" data-dismiss=\"modal\">Cerrar</a> \n");
      out.write("                    <button class=\"btn btn-primary\" id=\"registrarse\" type=\"button\" onclick=\"validacionRegistro()\">Únete</button>\n");
      out.write("                    <div class=\"mensajeResultado\" style=\"margin-top:20px\">\n");
      out.write("                        <label for =\"mensaje-resultado\" class=\"col-md-12\">");
      out.write((java.lang.String) org.apache.jasper.runtime.PageContextImpl.evaluateExpression("${mensajeError}", java.lang.String.class, (PageContext)_jspx_page_context, null));
      out.write("</label>\n");
      out.write("                        <input type=\"hidden\" name=\"nombrejsp\" value=\"valorRegistro\">\n");
      out.write("                    </div>\n");
      out.write("                </div>\n");
      out.write("            </form>  \n");
      out.write("        </div>  \n");
      out.write("    </div>      \n");
      out.write("</div>  ");
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
