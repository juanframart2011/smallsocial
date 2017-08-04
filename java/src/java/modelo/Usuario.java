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
import java.util.ArrayList;

public class Usuario {

    private String codUsuario;
    private String nick;
    private String nomUsuario;
    private String pass;
    private String seguridad;
    private String localidad;
    private int edad;
    private String sexo; // 1-Chico 2-Chica
    private String tipoUsu; //1-Equipo 2-Jugador 3-Entrenador    v
    private String tipoEquipo; //1-Federado 2-Amateurv
    private String posicion; // 1-Portero 2-Cierre 3-Ala 4-Pivote 5-Cualquierav
    private String entrenarEquipo; //1-Federado 2-Amateur 3-Cualquierav
    private String email;
    private String fecha;
    private Boolean online;
    private int contFavoritos;
    private int contVisitas;
    private int contMensajes;
    private ArrayList<String> equipos;
    private ArrayList<String> jugadores;
    private ArrayList<String> entrenadores;

    // Si el usuario no existe.
    public Usuario() {
        pass = null;
        email = null;
        equipos = new ArrayList<>();
        jugadores = new ArrayList<>();
        entrenadores = new ArrayList<>();

    }

    // Si el usuario existe
    public Usuario(String pPass, String pEmail) {
        this.email = pEmail;
        this.pass = pPass;
        equipos = new ArrayList<>();
        jugadores = new ArrayList<>();
        entrenadores = new ArrayList<>();
    }

    public String getCodUsuario() {
        return codUsuario;
    }

    public void setCodUsuario(String pCodUsuario) {
        this.codUsuario = pCodUsuario;
    }

    public String getNick() {
        return nick;
    }

    public void setNick(String pNick) {
        this.nick = pNick;
    }

    public String getNomUsuario() {
        return nomUsuario;
    }

    public void setNomUsuario(String pNomUsuario) {
        this.nomUsuario = pNomUsuario;
    }

    public String getPass() {
        return pass;
    }

    public void setPass(String pPass) {
        this.pass = pPass;
    }

    public String getSeguridad() {
        return seguridad;
    }

    public void setSeguridad(String pSeguridad) {
        this.seguridad = pSeguridad;
    }

    public String getLocalidad() {
        return localidad;
    }

    public void setLocalidad(String pLocalidad) {
        this.localidad = pLocalidad;
    }

    public int getEdad() {
        return edad;
    }

    public void setEdad(int pEdad) {
        this.edad = pEdad;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String pSexo) {
        this.sexo = pSexo;
    }

    public String getTipoUsu() {
        return tipoUsu;
    }

    public void setTipoUsu(String pTipoUsu) {
        this.tipoUsu = pTipoUsu;
    }

    public String getTipoEquipo() {
        return tipoEquipo;
    }

    public void setTipoEquipo(String pTipoEquipo) {
        this.tipoEquipo = pTipoEquipo;
    }

    public String getPosicion() {
        return posicion;
    }

    public void setPosicion(String pPosicion) {
        this.posicion = pPosicion;
    }

    public String getEntrenarEquipo() {
        return entrenarEquipo;
    }

    public void setEntrenarEquipo(String pEntrenarEquipo) {
        this.entrenarEquipo = pEntrenarEquipo;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String pEmail) {
        this.email = pEmail;
    }

    public String getFecha() {
        return fecha;
    }

    public void setFecha(String pFecha) {
        this.fecha = pFecha;
    }

    public Boolean getOnline() {
        return online;
    }

    public void setOnline(Boolean pOnline) {
        this.online = pOnline;
    }
    public int getContFavoritos() {
        return contFavoritos;
    }

    public void setContFavoritos(int pContFavoritos) {
        this.contFavoritos = pContFavoritos;
    }
    public int getContVisitas() {
        return contVisitas;
    }

    public void setContVisitas(int pContVisitas) {
        this.contVisitas = pContVisitas;
    }
    public int getContMensajes() {
        return contMensajes;
    }

    public void setContMensajes(int pContMensajes) {
        this.contMensajes = pContMensajes;
    }

    public void agregarEquipo(String pEquipo) {
        this.equipos.add(pEquipo);
    }

    public void agregarJugador(String pJugador) {
        this.jugadores.add(pJugador);
    }

    public void agregarEntrenador(String pEntrenador) {
        this.entrenadores.add(pEntrenador);
    }

}
