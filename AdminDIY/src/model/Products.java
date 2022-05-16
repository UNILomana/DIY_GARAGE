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
public class Products {
    
    private int Product_Id;
    private String Name;
    private double Price;
    private int Stock;

    public Products(int ProductId, String Name, double Price, int Stock) {
        this.Product_Id = ProductId;
        this.Name = Name;
        this.Price = Price;
        this.Stock = Stock;
    }

    public int getProductId() {
        return Product_Id;
    }

    public void setProductId(int ProductId) {
        this.Product_Id = ProductId;
    }

    public String getName() {
        return Name;
    }

    public void setName(String Name) {
        this.Name = Name;
    }

    public double getPrice() {
        return Price;
    }

    public void setPrice(double Price) {
        this.Price = Price;
    }

    public int getStock() {
        return Stock;
    }

    public void setStock(int Stock) {
        this.Stock = Stock;
    }

    @Override
    public String toString() {
        return "Products{" + "Product_Id=" + Product_Id + ", Name=" + Name + ", Price=" + Price + ", Stock=" + Stock + '}';
    }


    
    
}
