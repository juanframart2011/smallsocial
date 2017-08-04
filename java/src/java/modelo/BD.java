/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

/**
 *
 * @author Orion
 */
import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.util.Date;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.springframework.security.crypto.bcrypt.BCrypt;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;

public class BD {

    Connection connection;
    Statement statement;
    ResultSet rs;

    public BD() {
// Load MySQL driver
        try {
            Class.forName("com.mysql.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.out.println(e);
        }
// Open connection
        try {
            connection = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/meeteam", "root", "mysql");
            connection.setAutoCommit(true);
            statement = connection.createStatement();
        } catch (SQLException e) {
            System.out.println(e);
        }
    }

    public void close() {
        try {
            statement.close();
            connection.close();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public boolean isClosed() throws SQLException {
        return connection.isClosed();
    }

    public String generarCodigoUsuario(String nomUsuario) {
        String codigo = null;
        try {
            int cuantosnom;
            String query = "select count(*) as cuantosnom from usuario where nombre_usu='" + nomUsuario + "'";
            rs = statement.executeQuery(query);
            if (rs.next()) { // Si es True es que hay uno o mas registrados con el mismo nombre
                cuantosnom = rs.getInt("cuantosnom");
            } else {
                cuantosnom = 0;
            }
            cuantosnom += 1;
            codigo = nomUsuario + cuantosnom;

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return codigo;
    }

    public String obtenerFechaHoy() {
        SimpleDateFormat formateador = new SimpleDateFormat("yyyy-MM-dd");
        Calendar cal = Calendar.getInstance();
        return formateador.format(cal.getTime());
    }

    public String obtenerFechaHaceDosDias() {
        SimpleDateFormat formateador = new SimpleDateFormat("yyyy-MM-dd");
        Calendar cal = Calendar.getInstance();
        cal.add(Calendar.DATE, -2);
        return formateador.format(cal.getTime());
    }

    public boolean validarNik(String pNick) {
        boolean hayNikIgual = false;
        try {
            String query = "select nick from usuario where nick = '" + pNick + "'";
            Statement st = connection.createStatement();
            ResultSet rs = st.executeQuery(query);
            if (rs.next()) {
                hayNikIgual = true;
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return hayNikIgual;
    }

    public boolean validarEmail(String pEmail) {
        boolean hayEmailIgual = false;
        try {
            String query = "select email from usuario where email = '" + pEmail + "'";
            Statement st = connection.createStatement();
            ResultSet rs = st.executeQuery(query);
            if (rs.next()) {
                hayEmailIgual = true;
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return hayEmailIgual;
    }

    public String insertarNuevoUsuario(String pCodUsuario, String pNombre, String pContrasena, String pSeguridad, String pLocalidad, int pEdad, String pSexo, String pTipoUsuario, String pTipoEquipo, String pPosicion, String pEntrenarEquipo, String pEmail, String pFechaAlta, Boolean pOnline, String pNick, int pContVisitas, int pContFavoritos, int pContMensajes) {
        String mensajeError = "";
        try {
            String query = "INSERT INTO usuario (cod_usuario, nombre_usu, contrasena, seguridad, localidad, edad, sexo, tipo_usu, tipo_equipo, posicion, entrenar_equipo, email, fecha_alta, online,nick,contvisitas,contfavoritos,contmensajes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            PreparedStatement preStmn = connection.prepareStatement(query);
            preStmn.setString(1, pCodUsuario);
            preStmn.setString(2, pNombre);
            preStmn.setString(3, pContrasena);
            preStmn.setString(4, pSeguridad);
            preStmn.setString(5, pLocalidad);
            preStmn.setInt(6, pEdad);
            preStmn.setString(7, pSexo);
            preStmn.setString(8, pTipoUsuario);
            preStmn.setString(9, pTipoEquipo);
            preStmn.setString(10, pPosicion);
            preStmn.setString(11, pEntrenarEquipo);
            preStmn.setString(12, pEmail);
            preStmn.setString(13, pFechaAlta);
            preStmn.setBoolean(14, pOnline);
            preStmn.setString(15, pNick);
            preStmn.setInt(16, pContVisitas);
            preStmn.setInt(17, pContFavoritos);
            preStmn.setInt(18, pContMensajes);
            preStmn.execute();
        } catch (SQLException ex) {
            mensajeError = "Error: " + ex;
        }
        return mensajeError;
    }

    public Usuario validarUser(String pEmail, String pPass) {
        Usuario usu = new Usuario();
        Boolean coincidePass = false;
        try {
            rs = statement.executeQuery("SELECT * FROM usuario WHERE email='" + pEmail + "'");
            rs.next();
            if (rs.getRow() == 1) {//Si devuelve la consulta algo es 1 
                //Comprobamos que la contraseña coincide respecto a la de base de datos con hash
                coincidePass = comprobarClavesHash(pPass, rs.getString(3));
                //Si la contraseña hash coincide setea el usuario (pPass - passwordSinHashear / rs.getString(3) - passwordHasheadoBaseDatos)
                if (coincidePass == true) {
                    usu.setCodUsuario(rs.getString(1));
                    usu.setOnline(true);
                    String query = "update usuario set online = 1 where cod_usuario = '" + usu.getCodUsuario() + "'";
                    statement.executeUpdate(query);
                } else {
                    usu.setCodUsuario("1");
                }
            } else {
                usu.setCodUsuario("0");
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return usu;
    }

    public void cambiarEstadoOnline(String codUsu) {
        try {
            String query = "update usuario set online = 0  where cod_usuario='" + codUsu + "'";
            statement.executeUpdate(query);
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    /*public Usuario validarUser(String pEmail, String pPass) {
     Usuario usu = new Usuario();

     try {
     rs = statement.executeQuery("SELECT * FROM usuario WHERE email='" + pEmail + "' and contrasena='" + pPass + "'");
     rs.next();
     if (rs.getRow() == 1) {//Si devuelve la consulta algo es 1 
     usu.setCodUsuario(rs.getString(1));
     usu.setOnline(true);
     } else {
     usu.setCodUsuario(null);
     }
     } catch (SQLException ex) {
     Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
     }
     System.out.println("Es el usuario:" + usu);
     return usu;
     }*/
    //Cogemos los datos del Usuario
    public Usuario getUserData(String codUser) {
        Usuario userData = new Usuario();
        try {
            rs = statement.executeQuery("SELECT * FROM usuario WHERE cod_usuario='" + codUser + "'");
            rs.next();
            if (rs.getRow() == 1) {//Si devuelve la consulta algo es 1 
                userData.setNomUsuario(rs.getString(2));
                userData.setLocalidad(rs.getString(5));
                userData.setEdad(rs.getInt(6));
                userData.setSexo(rs.getString(7));
                userData.setTipoUsu(rs.getString(8));
                userData.setTipoEquipo(rs.getString(9));
                userData.setPosicion(rs.getString(10));
                userData.setEntrenarEquipo(rs.getString(11));
                userData.setEmail(rs.getString(12));
                userData.setNick(rs.getString(15));
                userData.setContVisitas(rs.getInt(16));
                userData.setContFavoritos(rs.getInt(17));
                userData.setContMensajes(rs.getInt(18));

            } else {
                userData = null;
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }

        return userData;
    }

    public String getUsuario(String email, String seguridad) {
        String result = "";
        try {

            String select = "select cod_usuario from usuario where email='" + email + "' and seguridad = '" + seguridad + "'";
            ResultSet rs = statement.executeQuery(select);
            if (rs.next()) {
                result = rs.getString("cod_usuario");
            }
        } catch (SQLException ex) {
            result = "";
        }
        return result;
    }
    
    public String obtenerLocUsuario(String codUsuLoc) {
        String result = "";
        try {

            String select = "select localidad from usuario where cod_usuario='" + codUsuLoc + "'";
            ResultSet rs = statement.executeQuery(select);
            if (rs.next()) {
                result = rs.getString("localidad");
            }
        } catch (SQLException ex) {
            result = "";
        }
        return result;
    }

    public Boolean cambiarPassword(String codUsuario, String nuevaPass) {
        String nuevaPassHash = "";
        boolean actualiza = false;
        nuevaPassHash = encriptarClaveHash(nuevaPass);
        try {
            String update = "update usuario set contrasena = '" + nuevaPassHash + "' where cod_usuario = '" + codUsuario + "'";
            if (statement.executeUpdate(update) > 0) {
                actualiza = true;
            }
        } catch (SQLException ex) {
            System.out.println("No se encontro ningun usuario con los datos ofrecidos");
        }
        return actualiza;
    }

    public String encriptarClaveHash(String claveDesencriptada) {
        String claveEncriptada = null;
        claveEncriptada = BCrypt.hashpw(claveDesencriptada, BCrypt.gensalt());
        return claveEncriptada;
    }

    public boolean comprobarClavesHash(String claveForm, String claveAlmacenada) {
        boolean password_verified = false;

        if (null == claveAlmacenada || !claveAlmacenada.startsWith("$2a$")) {
            throw new java.lang.IllegalArgumentException("Invalid hash provided for comparison");
        }

        password_verified = BCrypt.checkpw(claveForm, claveAlmacenada);

        return (password_verified);
    }

    public ArrayList<ArrayList> obtenerGenteCercaLoc(String pTipoUsu, String pTipoEquipo, String pLocalidad, String pSexo, int pEdadDesde, int pEdadHasta, ArrayList<ArrayList> aCompCodUsu, String miCodUsu) {
        try {
            //String query = "SELECT * FROM usuario WHERE tipo_usu = ? and tipo_equipo = ? and localidad LIKE ('%' || ? || '%')";
            ResultSet results = null;
            if (pTipoUsu.equals("Equipo")) {
                if (pTipoEquipo.equals("Ambos")) {
                    String pTipoEquipo1 = "Federado";
                    String pTipoEquipo2 = "Amateur";
                    String query = "SELECT * FROM usuario WHERE tipo_usu = ? and tipo_equipo IN (?,?) and localidad LIKE ?";
                    PreparedStatement preStmn = connection.prepareStatement(query);
                    preStmn.setString(1, pTipoUsu);
                    preStmn.setString(2, pTipoEquipo1);
                    preStmn.setString(3, pTipoEquipo2);
                    preStmn.setString(4, "%" + pLocalidad + "%");
                    results = preStmn.executeQuery();
                } else {
                    String query = "SELECT * FROM usuario WHERE tipo_usu = ? and tipo_equipo = ? and localidad LIKE ?";
                    PreparedStatement preStmn = connection.prepareStatement(query);
                    preStmn.setString(1, pTipoUsu);
                    preStmn.setString(2, pTipoEquipo);
                    preStmn.setString(3, "%" + pLocalidad + "%");
                    results = preStmn.executeQuery();
                }
            } else if (pTipoUsu.equals("Jugador") || pTipoUsu.equals("Entrenador")) {
                if (pSexo.equals("Ambos")) {
                    String pSexo1 = "chico";
                    String pSexo2 = "chica";
                    //Si la edad hasta es mayor a 40, mostramos los mayores de 40 desde la edadDesde
                    if (pEdadHasta == 40) {
                        String query = "SELECT * FROM usuario WHERE tipo_usu = ? and sexo IN (?,?) and edad >= ? and localidad LIKE ?";
                        PreparedStatement preStmn = connection.prepareStatement(query);
                        preStmn.setString(1, pTipoUsu);
                        preStmn.setString(2, pSexo1);
                        preStmn.setString(3, pSexo2);
                        preStmn.setInt(4, pEdadDesde);
                        preStmn.setString(5, "%" + pLocalidad + "%");
                        results = preStmn.executeQuery();
                    } else {
                        String query = "SELECT * FROM usuario WHERE tipo_usu = ? and sexo IN (?,?) and edad BETWEEN ? and ? and localidad LIKE ?";
                        PreparedStatement preStmn = connection.prepareStatement(query);
                        preStmn.setString(1, pTipoUsu);
                        preStmn.setString(2, pSexo1);
                        preStmn.setString(3, pSexo2);
                        preStmn.setInt(4, pEdadDesde);
                        preStmn.setInt(5, pEdadHasta);
                        preStmn.setString(6, "%" + pLocalidad + "%");
                        results = preStmn.executeQuery();
                    }
                } else {
                    //Si la edad hasta es mayor a 40, mostramos los mayores de 40 desde la edadDesde
                    if (pEdadHasta == 40) {
                        String query = "SELECT * FROM usuario WHERE tipo_usu = ? and sexo = ? and edad >= ? and localidad LIKE ?";
                        PreparedStatement preStmn = connection.prepareStatement(query);
                        preStmn.setString(1, pTipoUsu);
                        preStmn.setString(2, pSexo);
                        preStmn.setInt(3, pEdadDesde);
                        preStmn.setString(4, "%" + pLocalidad + "%");
                        results = preStmn.executeQuery();
                    } else {
                        String query = "SELECT * FROM usuario WHERE tipo_usu = ? and sexo = ? and edad BETWEEN ? and ? and localidad LIKE ?";
                        PreparedStatement preStmn = connection.prepareStatement(query);
                        preStmn.setString(1, pTipoUsu);
                        preStmn.setString(2, pSexo);
                        preStmn.setInt(3, pEdadDesde);
                        preStmn.setInt(4, pEdadHasta);
                        preStmn.setString(5, "%" + pLocalidad + "%");
                        results = preStmn.executeQuery();
                    }
                }
            }

            //Si la consulta devuelve algo
            while (results.next()) {
                ArrayList aLocEquipo = new ArrayList();
                String file = "";
                String url = "";
                ArrayList<String> usumebloque = new ArrayList<String>();
                usumebloque = obtenerCodUsuMeBloquean(miCodUsu);

                String codUsu = results.getString(1);

                if (!usumebloque.contains(codUsu)) { // Para que no aparezcan los usuarios que te han bloqueado.
                    url = getImagePerf(codUsu);
                    if (url != "../img/imagenperfildefecto.png") {
                        file = url.substring(url.lastIndexOf("\\") + 1);
                        url = "..//imagenPerfil//" + file;
                    }
                    aLocEquipo.add(url);
                    String nickUsuario = results.getString(15);
                    /*
                    String localidad = results.getString(5);
                    int edad = results.getInt(6);
                    String tipoUsuario = results.getString(8);
                    String tipoEquipo = results.getString(9);
                    String posicion = results.getString(10);
                    String entrenEquipo = results.getString(11);
                    aLocEquipo.add(nickUsuario + ", ");

                    if (tipoUsuario.equals("Jugador") || tipoUsuario.equals("Entrenador")) {

                        aLocEquipo.add(edad + " años.");
                        aLocEquipo.add(tipoUsuario + ", ");
                        if (tipoUsuario.equals("Jugador")) {
                            aLocEquipo.add(posicion);
                        } else if (tipoUsuario.equals("Entrenador")) {
                            aLocEquipo.add("Equipo entrenar: " + entrenEquipo + ".");
                        }
                    } else if (tipoUsuario.equals("Equipo")) {
                        aLocEquipo.add(tipoEquipo);
                    }
                    aLocEquipo.add(localidad);
                    */
                    aLocEquipo.add(nickUsuario);
                    aLocEquipo.add(codUsu);
                    aCompCodUsu.add(aLocEquipo);
                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return aCompCodUsu;
    }

    public ArrayList<String> obtenerGenteCercaJugEntre(String pTipoUsu, String pSexo, int pEdad, String pLocalidad) {
        ArrayList usuariosLocalJugEntre = new ArrayList();
        try {
            rs = statement.executeQuery("SELECT * FROM usuario WHERE tipo_usu='" + pTipoUsu + "' and edad='" + pEdad + "' and contains(localidad,'" + pLocalidad + "')");
            if (rs.getRow() == 1) { //Si devuelve la consulta algo es 1 
                String nickUsuario = rs.getString(15);
                String localidad = rs.getString(5);
                int edad = rs.getInt(6);
                String tipoUsuario = rs.getString(8);
                usuariosLocalJugEntre.add(nickUsuario);
                usuariosLocalJugEntre.add(localidad);
                usuariosLocalJugEntre.add(edad);
                usuariosLocalJugEntre.add(tipoUsuario);
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return usuariosLocalJugEntre;
    }

    public boolean eliminarUsuario(String pCodUsu) {
        boolean actualiza = false;
        String query = "Delete from usuario where cod_usuario='" + pCodUsu + "'";
        try {
            if (statement.executeUpdate(query) > 0) {
                actualiza = true;
            }
        } catch (SQLException ex) {
            System.out.println("No se encontro ningun usuario con el dato ofrecido");
        }
        return actualiza;
    }

    public boolean cargarImagenPerfil(String pCodUsu, String pUrl) {
        boolean cargado = false;
        String urlImgAnt;
        try {
            String select = "select count(*) as cuantosnom from perfil_imagen where cod_usuario='" + pCodUsu + "'";
            ResultSet rs = statement.executeQuery(select);
            if (rs.next()) { // Si es True es que hay uno o mas registrados con el mismo nombre
                select = "select imagenurl as urlImgAnt from perfil_imagen where cod_usuario='" + pCodUsu + "'";
                rs = statement.executeQuery(select);
                if (rs.next()) {
                    urlImgAnt = rs.getString("urlImgAnt");
                    File fichero = new File(urlImgAnt);
                    fichero.delete();
                }
                select = "delete from perfil_imagen where cod_usuario='" + pCodUsu + "'";
                statement.executeUpdate(select);

            }
            String query = "INSERT INTO perfil_imagen (cod_usuario,imagenurl) VALUES (?,?)";
            PreparedStatement preStmn = connection.prepareStatement(query);
            preStmn.setString(1, pCodUsu);
            preStmn.setString(2, pUrl);
            preStmn.execute();
            cargado = true;
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return cargado;

    }

    public String getImagePerf(String pCodUsuario) {
        String url = "";
        try {

            String select = "select imagenurl from perfil_imagen where cod_usuario='" + pCodUsuario + "'";
            ResultSet rs = statement.executeQuery(select);
            if (rs.next()) {
                url = rs.getString("imagenurl");
            } else {
                url = "../img/imagenperfildefecto.png";
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return url;
    }

    public ArrayList<ArrayList> obtenerGenteCerca(String pTipoBusqueda, ArrayList<ArrayList> aCompCodUsu, String miCodUsu) {
        try {
            // ArrayList<String> usubloque = new ArrayList<String>();
            ArrayList<String> usumebloque = new ArrayList<String>();
            // usubloque = obtenerCodUsuBloqueados(miCodUsu);
            usumebloque = obtenerCodUsuMeBloquean(miCodUsu);
            String fechaActual = "";
            String fechaDosDias = "";
            ResultSet results = null;
            if (pTipoBusqueda.equals("Todos")) {
                String query = "SELECT * FROM usuario";
                PreparedStatement preStmn = connection.prepareStatement(query);
                results = preStmn.executeQuery();
            } else if (pTipoBusqueda.equals("Online")) {
                String query = "SELECT * FROM usuario where online = ?";
                PreparedStatement preStmn = connection.prepareStatement(query);
                preStmn.setString(1, "1");
                results = preStmn.executeQuery();
            } else if (pTipoBusqueda.equals("Nuevos")) {
                fechaDosDias = obtenerFechaHaceDosDias();
                fechaActual = obtenerFechaHoy();
                String query = "SELECT * FROM usuario where fecha_alta between ? and ?";
                PreparedStatement preStmn = connection.prepareStatement(query);
                preStmn.setString(1, fechaDosDias);
                preStmn.setString(2, fechaActual);
                results = preStmn.executeQuery();
            }

            //Si la consulta devuelve algo
            if (results != null) {
                String file = "";
                String url = "";
                String codUsu = "";
                while (results.next()) {
                    ArrayList aLocEquipo = new ArrayList();
                    codUsu = results.getString(1);
                    //if (!usubloque.contains(codUsu)) { //Para que no aparezcan los usuarios que bloqueas.
                    if (!usumebloque.contains(codUsu)) { // Para que no aparezcan los usuarios que te han bloqueado.
                        url = getImagePerf(codUsu);
                        if (url != "../img/imagenperfildefecto.png") {
                            file = url.substring(url.lastIndexOf("\\") + 1);
                            url = "..//imagenPerfil//" + file;
                        }
                        aLocEquipo.add(url);
                        String nickUsuario = results.getString(15);
                        String localidad = results.getString(5);
                        int edad = results.getInt(6);
                        String tipoUsuario = results.getString(8);
                        String tipoEquipo = results.getString(9);
                        String posicion = results.getString(10);
                        String entrenEquipo = results.getString(11);
                        //aLocEquipo.add(nickUsuario + ", ");
                        
                        aLocEquipo.add(nickUsuario); // Lo añadimos si queremos que solo salga el nick
                        /*
                        if (tipoUsuario.equals("Jugador") || tipoUsuario.equals("Entrenador")) {

                            aLocEquipo.add(edad + " años.");
                            aLocEquipo.add(tipoUsuario + ", ");
                            if (tipoUsuario.equals("Jugador")) {
                                aLocEquipo.add(posicion);
                            } else if (tipoUsuario.equals("Entrenador")) {
                                aLocEquipo.add("Equipo entrenar: " + entrenEquipo + ".");
                            }
                        } else if (tipoUsuario.equals("Equipo")) {
                            aLocEquipo.add(tipoEquipo);
                        }
                        aLocEquipo.add(localidad);
                        */
                        aLocEquipo.add(codUsu);
                        aCompCodUsu.add(aLocEquipo);
                    }
                    //}
                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return aCompCodUsu;
    }

    public String insertarInfo(String pCodUsuario, String pTipoUsu, String pElClub, String pTrayectoria, String pQuebusco, String pSobremi, String pExperiencia) {
        String mensajeError = "";
        ResultSet rs;
        try {
            String select = "select count(*) as cuantosnom from perfil_usuario where cod_usuario='" + pCodUsuario + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) { // Si es True es que hay uno o mas registrados con el mismo nombre
                select = "delete from perfil_usuario where cod_usuario='" + pCodUsuario + "'";
                statement.executeUpdate(select);
            }
            if ("Equipo".equals(pTipoUsu)) {
                try {
                    String query = "INSERT INTO perfil_usuario (cod_usuario, elclub, trayectoria, quebusco,sobremi, experiencia) VALUES (?,?,?,?,?,?)";
                    PreparedStatement preStmn = connection.prepareStatement(query);
                    preStmn.setString(1, pCodUsuario);
                    preStmn.setString(2, pElClub);
                    preStmn.setString(3, pTrayectoria);
                    preStmn.setString(4, pQuebusco);
                    preStmn.setString(5, " ");
                    preStmn.setString(6, " ");
                    preStmn.execute();
                } catch (SQLException ex) {
                    mensajeError = "Error: " + ex;
                }

            } else {

                try {
                    String query = "INSERT INTO perfil_usuario (cod_usuario, elclub, trayectoria, quebusco,sobremi, experiencia) VALUES (?,?,?,?,?,?)";
                    PreparedStatement preStmn = connection.prepareStatement(query);
                    preStmn.setString(1, pCodUsuario);
                    preStmn.setString(2, " ");
                    preStmn.setString(3, " ");
                    preStmn.setString(4, pQuebusco);
                    preStmn.setString(5, pSobremi);
                    preStmn.setString(6, pExperiencia);
                    preStmn.execute();
                } catch (SQLException ex) {
                    mensajeError = "Error: " + ex;
                }
            }
        } catch (SQLException ex) {
            mensajeError = "Error: " + ex;
        }
        return mensajeError;
    }

    public InfoUsuario obtenerInfo(String pCodUsuario) {
        InfoUsuario infoUsu = new InfoUsuario();
        try {
            String select = "select * from perfil_usuario where cod_usuario='" + pCodUsuario + "'";
            ResultSet rs = statement.executeQuery(select);
            if (rs.next()) {
                infoUsu.setElClub(rs.getString(2));
                infoUsu.setTrayectoria(rs.getString(3));
                infoUsu.setQueBusco(rs.getString(4));
                infoUsu.setSobremi(rs.getString(5));
                infoUsu.setExperiencia(rs.getString(6));

            }

        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return infoUsu;
    }

    public boolean cargarFotos(String pCodUsu, String pUrl) {
        boolean cargado = false;
        try {
            String query = "INSERT INTO usu_imagenes (cod_usuario,imagenesurl) VALUES (?,?)";
            PreparedStatement preStmn = connection.prepareStatement(query);
            preStmn.setString(1, pCodUsu);
            preStmn.setString(2, pUrl);
            preStmn.execute();
            cargado = true;
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return cargado;
    }

    public boolean cargarVideos(String pCodUsu, String pUrl) {
        boolean cargado = false;
        try {

            String query = "INSERT INTO usu_videos (cod_usuario,videosurl) VALUES (?,?)";
            PreparedStatement preStmn = connection.prepareStatement(query);
            preStmn.setString(1, pCodUsu);
            preStmn.setString(2, pUrl);
            preStmn.execute();
            cargado = true;
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return cargado;
    }

    public ArrayList<String> obtenerImagenes(String pCodUsu) {
        ArrayList<String> lista = new ArrayList<String>();
        String url = "";
        ResultSet rs;
        lista.add("../img/siluetaFoto.png");
        try {
            String select = "select imagenesurl from usu_imagenes where cod_usuario='" + pCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                url = rs.getString("imagenesurl");
                lista.add(url);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

    public ArrayList<String> obtenerVideos(String pCodUsu) {
        ArrayList<String> lista = new ArrayList<String>();
        String url = "";
        ResultSet rs;
        try {
            String select = "select videosurl from usu_videos where cod_usuario='" + pCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                url = rs.getString("videosurl");
                lista.add(url);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

    public boolean eliminarFoto(String codUsu, String urlFoto) {
        boolean elimina = false;
        String query = "Delete from usu_imagenes where cod_usuario='" + codUsu + "' and imagenesurl='" + urlFoto + "'";
        try {

            if (statement.executeUpdate(query) > 0) {

                elimina = true;
            }
        } catch (SQLException ex) {
            System.out.println("No se encontro ninguna foto con el dato ofrecido");
        }
        return elimina;
    }

    public boolean eliminarVideo(String codUsu, String urlVideo) {
        boolean elimina = false;
        String query = "Delete from usu_videos where cod_usuario='" + codUsu + "' and videosurl='" + urlVideo + "'";
        try {
            if (statement.executeUpdate(query) > 0) {
                elimina = true;
            }
        } catch (SQLException ex) {
            System.out.println("No se encontro ningun video con el dato ofrecido");
        }
        return elimina;
    }

    public ArrayList<String> obtenerImgVid(String pCodUsuario) {
        ArrayList<String> lista = new ArrayList<String>();

        return lista;
    }

    public boolean insertarBloqueado(String pCodUsu, String pCodUsuAjen) {
        boolean personaInsertada = true;
        Integer numBloq;
        ResultSet rs;
        String nik;
        try {
            String select = "select count(*) as cuantos from usuariosbloqueados where cod_usuario='" + pCodUsu + "' and usu_bloqueado='" + pCodUsuAjen + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) { // En este caso siempre va a dolver algo por lo que será true (devolvera 0 o lo que sea el count)
                numBloq = rs.getInt("cuantos");
                if (numBloq == 0) {
                    String query = "select nick from usuario where cod_usuario='" + pCodUsuAjen + "'";
                    rs = statement.executeQuery(query);
                    if (rs.next()) {
                        nik = rs.getString("nick");
                        String query2 = "INSERT INTO usuariosbloqueados (cod_usuario,usu_bloqueado,nickusu_bloq) VALUES (?,?,?)";
                        PreparedStatement preStmn = connection.prepareStatement(query2);
                        preStmn.setString(1, pCodUsu);
                        preStmn.setString(2, pCodUsuAjen);
                        preStmn.setString(3, nik);
                        preStmn.execute();
                    }

                } else {
                    personaInsertada = false;
                }
            }

        } catch (SQLException ex) {
            personaInsertada = false;
        }
        return personaInsertada;
    }

    public ArrayList<String> obtenerBloqueados(String pCodUsu) {
        ArrayList<String> lista = new ArrayList<String>();
        String nik = "";
        ResultSet rs;
        try {
            String select = "select nickusu_bloq from usuariosbloqueados where cod_usuario='" + pCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                nik = rs.getString("nickusu_bloq");
                lista.add(nik);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

    public boolean eliminarBloqueado(String codUsu, String nikUsuAjeno) {
        boolean elimina = false;
        try {
            String query = "Delete from usuariosbloqueados where cod_usuario='" + codUsu + "' and nickusu_bloq='" + nikUsuAjeno + "'";
            if (statement.executeUpdate(query) > 0) {
                elimina = true;

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return elimina;
    }

    public ArrayList<String> obtenerCodUsuBloqueados(String miCodUsu) {
        ArrayList<String> usubloque = new ArrayList<String>();
        String codUsuAje = "";
        ResultSet rs;
        try {
            String select = "select usu_bloqueado from usuariosbloqueados where cod_usuario='" + miCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                codUsuAje = rs.getString("usu_bloqueado");
                usubloque.add(codUsuAje);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return usubloque;
    }

    public ArrayList<String> obtenerCodUsuMeBloquean(String miCodUsu) {
        ArrayList<String> usumebloque = new ArrayList<String>();
        String codUsuMeBloq = "";
        ResultSet rs;
        try {
            String select = "select cod_usuario from usuariosbloqueados where usu_bloqueado='" + miCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                codUsuMeBloq = rs.getString("cod_usuario");
                usumebloque.add(codUsuMeBloq);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return usumebloque;
    }

    public boolean estaEnFavorito(String pCodUsu, String pCodUsuAjen) {
        int numFavor;
        boolean esta = true;
        try {
            String select = "select count(*) as cuantos from usuariosfavoritos where cod_usuario='" + pCodUsu + "' and usu_favorito='" + pCodUsuAjen + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) { // En este caso siempre va a dolver algo por lo que será true (devolvera 0 o lo que sea el count)
                numFavor = rs.getInt("cuantos");
                if (numFavor == 0) {
                    esta = false;

                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return esta;
    }

    public boolean insertarFavorito(String pCodUsu, String pCodUsuAjen) {
        boolean personaInsertada = true;
        ResultSet rs;
        String nik;
        try {
            String query = "select nick from usuario where cod_usuario='" + pCodUsuAjen + "'";
            rs = statement.executeQuery(query);
            if (rs.next()) {
                nik = rs.getString("nick");
                String query2 = "INSERT INTO usuariosfavoritos (cod_usuario,usu_favorito,nickusu_favorito) VALUES (?,?,?)";
                PreparedStatement preStmn = connection.prepareStatement(query2);
                preStmn.setString(1, pCodUsu);
                preStmn.setString(2, pCodUsuAjen);
                preStmn.setString(3, nik);
                preStmn.execute();
            }
        } catch (SQLException ex) {
            personaInsertada = false;
        }
        return personaInsertada;
    }

    public ArrayList<String> obtenerFavoritos(String pCodUsu) {
        ArrayList<String> lista = new ArrayList<String>();
        String nomfavorito = "";
        ResultSet rs;
        try {
            String select = "select usu_favorito from usuariosfavoritos where cod_usuario='" + pCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                nomfavorito = rs.getString("usu_favorito");
                lista.add(nomfavorito);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

    public ArrayList<String> obtenerCodUsuSoySuFavorito(String miCodUsu) {
        ArrayList<String> listaSoyFavor = new ArrayList<String>();
        String codUsuSoySuFavorito = "";
        ResultSet rs;
        try {
            String select = "select cod_usuario from usuariosfavoritos where usu_favorito='" + miCodUsu + "'";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                codUsuSoySuFavorito = rs.getString("cod_usuario");
                listaSoyFavor.add(codUsuSoySuFavorito);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return listaSoyFavor;
    }

    public boolean eliminarFavorito(String codUsu, String codUsuAje) {
        boolean elimina = false;
        try {
            String query = "Delete from usuariosfavoritos where cod_usuario='" + codUsu + "' and usu_favorito='" + codUsuAje + "'";
            if (statement.executeUpdate(query) > 0) {
                elimina = true;

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return elimina;
    }

    public boolean acumNumFavoritos(String codUserAj) {
        boolean contado = false;
        Integer num = 0;
        ResultSet rs;
        try {
            String select = "select contfavoritos as cont from usuario where cod_usuario='" + codUserAj + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) {
                num = rs.getInt("cont") + 1;
                String query = "update usuario set contfavoritos = '" + num + "' where cod_usuario = '" + codUserAj + "'";
                statement.executeUpdate(query);
                contado = true;

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return contado;

    }

    public boolean resetAcumNumFavoritos(String codUser) {
        boolean esta = false;
        ResultSet rs;
        try {
            String query = "update usuario set contfavoritos = 0 where cod_usuario = '" + codUser + "'";
            statement.executeUpdate(query);
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return esta;
    }

    public boolean estaEnVisitas(String pCodUsu, String pCodUsuAjen) {
        int numFavor;
        boolean esta = true;
        try {
            String select = "select count(*) as cuantos from usuariosvisitas where cod_usuario='" + pCodUsu + "' and cod_usuario_visita='" + pCodUsuAjen + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) { // En este caso siempre va a dolver algo por lo que será true (devolvera 0 o lo que sea el count)
                numFavor = rs.getInt("cuantos");
                if (numFavor == 0) {
                    esta = false;

                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return esta;
    }

    public boolean insertarVisita(String pCodUsu, String pCodUsuAjen, String pHoraVisita) {
        boolean personaInsertada = true;
        ResultSet rs;
        String nik;
        try {
            String query = "select nick from usuario where cod_usuario='" + pCodUsuAjen + "'";
            rs = statement.executeQuery(query);
            if (rs.next()) {
                nik = rs.getString("nick");
                String query2 = "INSERT INTO usuariosvisitas (cod_usuario,cod_usuario_visita,nickusu_visita,cuandovisita) VALUES (?,?,?,?)";
                PreparedStatement preStmn = connection.prepareStatement(query2);
                preStmn.setString(1, pCodUsu);
                preStmn.setString(2, pCodUsuAjen);
                preStmn.setString(3, nik);
                preStmn.setString(4, pHoraVisita);
                preStmn.execute();
            }
        } catch (SQLException ex) {
            personaInsertada = false;
        }
        return personaInsertada;
    }

    public boolean acumNumVisitas(String codUserAj) {
        boolean contado = false;
        Integer num = 0;
        ResultSet rs;
        try {
            String select = "select contvisitas as cont from usuario where cod_usuario='" + codUserAj + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) {
                num = rs.getInt("cont") + 1;
                String query = "update usuario set contvisitas = '" + num + "' where cod_usuario = '" + codUserAj + "'";
                statement.executeUpdate(query);
                contado = true;

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return contado;

    }

    public ArrayList<String> obtenerVisitas(String miCodUsu) {
        ArrayList<String> lista = new ArrayList<String>();
        String nomvisitas = "";
        ResultSet rs;
        try {
            String select = "select cod_usuario from usuariosvisitas where cod_usuario_visita='" + miCodUsu + "' order by cuandovisita desc";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                nomvisitas = rs.getString("cod_usuario");
                lista.add(nomvisitas);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

    public boolean resetAcumNumVisitas(String codUser) {
        boolean esta = false;
        ResultSet rs;
        try {
            String query = "update usuario set contvisitas = 0 where cod_usuario = '" + codUser + "'";
            statement.executeUpdate(query);
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return esta;
    }

    public String obtenerFechaHoraVisita() {
        DateFormat formateador = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Calendar cal = Calendar.getInstance();
        return formateador.format(cal.getTime());
    }

    public boolean actualizarHoraVisita(String pCodUsu, String pCodUsuAjen, String pNuevaHora) {
        boolean actualizado = false;
        try {
            String query = "update usuariosvisitas set cuandovisita = '" + pNuevaHora + "' where cod_usuario='" + pCodUsu + "' and cod_usuario_visita='" + pCodUsuAjen + "'";
            statement.executeUpdate(query);
            actualizado = true;
        } catch (SQLException ex) {
            Logger.getLogger(BD.class.getName()).log(Level.SEVERE, null, ex);
        }
        return actualizado;
    }

    public boolean añadirAmistoso(String pCodUsu) {
        boolean añadido = false;
        try {
            String query = "INSERT INTO amistosos (cod_usuario) VALUES (?)";
            PreparedStatement preStmn = connection.prepareStatement(query);
            preStmn.setString(1, pCodUsu);
            preStmn.execute();
            añadido = true;
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return añadido;
    }

    public boolean eliminarAmistoso(String pCodUsu) {
        boolean eliminar = false;
        try {
            String query = "Delete from amistosos where cod_usuario='" + pCodUsu + "'";
            if (statement.executeUpdate(query) > 0) {
                eliminar = true;
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return eliminar;
    }

    public boolean estaEquipoEnBolsaAmistoso(String pCodUsu) {
        int num;
        boolean esta = true;
        try {
            String select = "select count(*) as cuantos from amistosos where cod_usuario='" + pCodUsu + "'";
            rs = statement.executeQuery(select);
            if (rs.next()) { // En este caso siempre va a dolver algo por lo que será true (devolvera 0 o lo que sea el count)
                num = rs.getInt("cuantos");
                if (num == 0) {
                    esta = false;
                }
            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }

        return esta;
    }

    public ArrayList<String> obtenerAmistosos() {
        ArrayList<String> lista = new ArrayList<String>();
        String equipAmistoso = "";
        ResultSet rs;
        try {
            String select = "select cod_usuario from amistosos";
            rs = statement.executeQuery(select);
            while (rs.next()) {
                equipAmistoso = rs.getString("cod_usuario");
                lista.add(equipAmistoso);

            }
        } catch (SQLException ex) {
            Logger.getLogger(BD.class
                    .getName()).log(Level.SEVERE, null, ex);
        }
        return lista;
    }

}
