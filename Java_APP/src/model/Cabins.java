/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author parra.raul
 */
public class Cabins {
 
    private int Cabin_Id;
    private String Type;
    private Boolean Disponibility;

    public Cabins(int CabinId, String Type, Boolean Disponibility) {
        this.Cabin_Id = CabinId;
        this.Type = Type;
        this.Disponibility = Disponibility;
    }

    public int getCabinId() {
        return Cabin_Id;
    }

    public void setCabinId(int CabinId) {
        this.Cabin_Id = CabinId;
    }

    public String getType() {
        return Type;
    }

    public void setType(String Type) {
        this.Type = Type;
    }

    public Boolean getDisponibility() {
        return Disponibility;
    }

    public void setDisponibility(Boolean Disponibility) {
        this.Disponibility = Disponibility;
    }

    @Override
    public String toString() {
        return "Cabins{" + "Cabin_Id=" + Cabin_Id + ", Type=" + Type + ", Disponibility=" + Disponibility + '}';
    }


    
}
