/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

import java.util.ArrayList;
import java.util.Iterator;

/**
 *
 * @author Orion
 */
public class ListaImagenes {

    private ArrayList<Imagen> listaImg;

    public ListaImagenes() {
        this.listaImg = new ArrayList<Imagen>();
    }

    private Iterator<Imagen> getIterador() {
        return listaImg.iterator();
    }

    public void anadirImagen(Imagen pImagen) {
        listaImg.add(pImagen);
    }
}
   


