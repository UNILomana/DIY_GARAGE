/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.time.LocalDate;
import java.time.LocalTime;

/**
 *
 * @author parra.raul
 */
public class Bookings {
    
    private int Booking_Id;
    private String User_Id;
    private int Cabin_Id;
    private LocalDate Date;
    private LocalTime Hour;
    private String Employee_Id;
    private double Price;

    public Bookings(int BookingId, String UserId, int CabinId, LocalDate Date, LocalTime Hour, String EmployeeId, double Price) {
        this.Booking_Id = BookingId;
        this.User_Id = UserId;
        this.Cabin_Id = CabinId;
        this.Date = Date;
        this.Hour = Hour;
        this.Employee_Id = EmployeeId;
        this.Price = Price;
    }

    public int getBookingId() {
        return Booking_Id;
    }

    public void setBookingId(int BookingId) {
        this.Booking_Id = BookingId;
    }

    public String getUserId() {
        return User_Id;
    }

    public void setUserId(String UserId) {
        this.User_Id = UserId;
    }

    public int getCabinId() {
        return Cabin_Id;
    }

    public void setCabinId(int CabinId) {
        this.Cabin_Id = CabinId;
    }

    public LocalDate getDate() {
        return Date;
    }

    public void setDate(LocalDate Date) {
        this.Date = Date;
    }

    public LocalTime getHour() {
        return Hour;
    }

    public void setHour(LocalTime Hour) {
        this.Hour = Hour;
    }

    public String getEmployeeId() {
        return Employee_Id;
    }

    public void setEmployeeId(String EmployeeId) {
        this.Employee_Id = EmployeeId;
    }

    public double getPrice() {
        return Price;
    }

    public void setPrice(double Price) {
        this.Price = Price;
    }

    @Override
    public String toString() {
        return "Bookings{" + "Booking_Id=" + Booking_Id + ", User_Id=" + User_Id + ", Cabin_Id=" + Cabin_Id + ", Date=" + Date + ", Hour=" + Hour + ", Employee_Id=" + Employee_Id + ", Price=" + Price + '}';
    }
    
}
