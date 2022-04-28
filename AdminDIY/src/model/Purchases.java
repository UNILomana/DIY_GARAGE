/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.time.LocalDate;

/**
 *
 * @author parra.raul
 */
public class Purchases {
    
    private int Purchase_Id;
    private String User_Id;
    private int Product_Id;
    private int Quantity;
    private LocalDate Date;
    private double Total_Price;

    public Purchases(int PurchaseId, String UserId, int ProductId, int Quantity, LocalDate Date, double TotalPrice) {
        this.Purchase_Id = PurchaseId;
        this.User_Id = UserId;
        this.Product_Id = ProductId;
        this.Quantity = Quantity;
        this.Date = Date;
        this.Total_Price = TotalPrice;
    }

    public int getPurchaseId() {
        return Purchase_Id;
    }

    public void setPurchaseId(int PurchaseId) {
        this.Purchase_Id = PurchaseId;
    }

    public String getUserId() {
        return User_Id;
    }

    public void setUserId(String UserId) {
        this.User_Id = UserId;
    }

    public int getProductId() {
        return Product_Id;
    }

    public void setProductId(int ProductId) {
        this.Product_Id = ProductId;
    }

    public int getQuantity() {
        return Quantity;
    }

    public void setQuantity(int Quantity) {
        this.Quantity = Quantity;
    }

    public LocalDate getDate() {
        return Date;
    }

    public void setDate(LocalDate Date) {
        this.Date = Date;
    }

    public double getTotalPrice() {
        return Total_Price;
    }

    public void setTotalPrice(double TotalPrice) {
        this.Total_Price = TotalPrice;
    }

    @Override
    public String toString() {
        return "Purchases{" + "Purchase_Id=" + Purchase_Id + ", User_Id=" + User_Id + ", Product_Id=" + Product_Id + ", Quantity=" + Quantity + ", Date=" + Date + ", Total_Price=" + Total_Price + '}';
    }
    
    
}
