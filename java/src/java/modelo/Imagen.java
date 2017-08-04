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
public class Imagen {
    private String codUsu;
    private String urlImagen;
    
    
    
      public Imagen() {
        codUsu = null;
        urlImagen = null;
    }
    public Imagen(String pCodUsu,String pUrlImagen){
    
    this.codUsu=pCodUsu;
    this.urlImagen=pUrlImagen;   
    }
    public String getCodUsu() {
        return codUsu;
    }

    public void setCodUsuario(String pCodUsu) {
        this.codUsu = pCodUsu;
    }
    
    public String getUrlImagen() {
        return urlImagen;
    }

    public void setUrlImagen(String pUrlImagen) {
        this.urlImagen = pUrlImagen;
    }            
}
