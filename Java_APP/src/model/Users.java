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
public class Users {
    
    private String User_Id;
    private String Name;
    private String Surname;
    private int TLF;
    private String Email;
    private String Password;

    public Users(String UserId, String Name, String Surname, int TLF, String Email, String Password) {
        this.User_Id = UserId;
        this.Name = Name;
        this.Surname = Surname;
        this.TLF = TLF;
        this.Email = Email;
        this.Password = Password;
    }

    public String getUserId() {
        return User_Id;
    }

    public void setUserId(String UserId) {
        this.User_Id = UserId;
    }

    public String getName() {
        return Name;
    }

    public void setName(String Name,String Surname) {
        this.Name = Name;
        this.Surname = Surname;
    }

    public String getSurname() {
        return Surname;
    }

    public void setSurname(String Surname) {
        this.Surname = Surname;
    }

    public int getTLF() {
        return TLF;
    }

    public void setTLF(int TLF) {
        this.TLF = TLF;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String Email) {
        this.Email = Email;
    }

    public String getPassword() {
        return Password;
    }

    public void setPassword(String Password) {
        this.Password = Password;
    }

    @Override
    public String toString() {
        return "Users{" + "User_Id=" + User_Id + ", Name=" + Name + ", Surname=" + Surname + ", TLF=" + TLF + ", Email=" + Email + ", Password=" + Password + '}';
    }
    
    
    
}
