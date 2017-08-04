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
public class InfoUsuario {
    
    private String codUsuario;
    private String elClub="";
    private String trayectoria="";
    private String queBusco="";
    private String sobremi="";
    private String experiencia="";
    
    
     public InfoUsuario() {
        codUsuario = null;        
    }
    public InfoUsuario(String pCodUsuario,String pElClub,String pTrayectoria,String pQueBusco,String pSobremi,String pExperiencia){
    
    this.codUsuario=pCodUsuario;
    this.elClub=pElClub;
    this.trayectoria=pTrayectoria;
    this.queBusco=pQueBusco;
    this.sobremi=pSobremi;
    this.experiencia=pExperiencia;
    }

    public String getCodUsuario() {
        return codUsuario;
    }

    public void setCodUsuario(String pCodUsuario) {
        this.codUsuario = pCodUsuario;
    }
    
    public String getElClub() {
        return elClub;
    }

    public void setElClub(String pElClub) {
        this.elClub = pElClub;
    }
    
    public String getTrayectoria() {
        return trayectoria;
    }

    public void setTrayectoria(String pTrayectoria) {
        this.trayectoria = pTrayectoria;
    }
    public String getQueBusco() {
        return queBusco;
    }

    public void setQueBusco(String pQueBusco) {
        this.queBusco = pQueBusco;
    }
    public String getSobremi() {
        return sobremi;
    }

    public void setSobremi(String pSobremi) {
        this.sobremi = pSobremi;
    }
    public String getExperiencia() {
        return experiencia;
    }

    public void setExperiencia(String pExperiencia) {
        this.experiencia = pExperiencia;
    }
}
