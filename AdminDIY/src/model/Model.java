/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

import java.io.FileWriter;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Time;
import java.time.LocalDate;
import java.time.Month;
import java.time.format.TextStyle;
import java.util.ArrayList;
import java.util.Locale;
import javax.swing.JOptionPane;
import view.View;

/**
 *
 * @author parra.raul
 */
public class Model {

    /**
     * Connection to dataBase
     *
     * @return Connection
     */
    public static Connection connect() {
        Connection conn = null;
        try {
            String url = "jdbc:mysql://192.168.72.76:3306/db_garage";
            String user = "Administrador";
            String password = "admin123";
            conn = DriverManager.getConnection(url, user, password);
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }

        return conn;

    }

    public ArrayList<Users> readUsers() {
        ArrayList<Users> users = new ArrayList<>();
        String taula = "users";
        String sql = "SELECT * FROM " + taula;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Users u = new Users(rs.getString("User_Id"), rs.getString("Name"), rs.getString("Surname"), rs.getInt("TLF"), rs.getString("Email"), rs.getString("Password"));
                users.add(u);
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return users;
    }

    //+addUser(usuario:User): int
    public int addUsers(Users usuario) {
        String sql = "INSERT INTO users(User_Id,Name,Surname,TLF,Email,Password) VALUES(?,?,?,?,?,?)";
        try (Connection conn = connect();
                PreparedStatement ptmt = conn.prepareStatement(sql)) {
            ptmt.setString(1, usuario.getUserId());
            ptmt.setString(2, usuario.getName());
            ptmt.setString(3, usuario.getSurname());
            ptmt.setInt(4, usuario.getTLF());
            ptmt.setString(5, usuario.getEmail());
            ptmt.setString(6, usuario.getPassword());
            ptmt.executeUpdate();
            return 1;
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
            return 0;
        }
    }

    public void deleteUsers(Users usuario) {
        String sql = "DELETE FROM users WHERE User_Id = ?";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, usuario.getUserId());
            pstmt.executeUpdate();

        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public void updateUsers(Users usuario) {
        String sql = "UPDATE users SET User_Id = ? ,"
                + "Name = ? ,"
                + "Surname = ?,"
                + "TLF= ? ,"
                + "Email= ?,"
                + "password = ? ,";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, usuario.getUserId());
            pstmt.setString(2, usuario.getName());
            pstmt.setString(3, usuario.getSurname());
            pstmt.setInt(4, usuario.getTLF());
            pstmt.setString(5, usuario.getEmail());
            pstmt.setString(6, usuario.getPassword());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public ArrayList<Bookings> readBookings() {

        ArrayList<Bookings> bookings = new ArrayList<>();
        String taula = "bookings";
        String sql = "SELECT * FROM " + taula;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Bookings b = new Bookings(rs.getInt("Booking_Id"), rs.getString("User_Id"), rs.getInt("Cabin_Id"), rs.getDate("Date").toLocalDate(), rs.getTime("Hour").toLocalTime(), rs.getString("Employee_Id"), rs.getDouble("Price"));
                bookings.add(b);
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return bookings;

    }

    public int addBookings(Bookings reserva) {

        String sql = "INSERT INTO bookings(Booking_Id,User_Id,Cabin_Id,Date,Hour,Employee_Id,Price) VALUES(?,?,?,?,?,?,?)";
        try (Connection conn = connect();
                PreparedStatement ptmt = conn.prepareStatement(sql)) {
            ptmt.setInt(1, reserva.getBookingId());
            ptmt.setString(2, reserva.getUserId());
            ptmt.setInt(3, reserva.getCabinId());
            ptmt.setDate(4, Date.valueOf(reserva.getDate()));
            ptmt.setTime(5, Time.valueOf(reserva.getHour()));
            ptmt.setString(6, reserva.getEmployeeId());
            ptmt.setDouble(7, reserva.getPrice());
            ptmt.executeUpdate();
            return 1;
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
            return 0;
        }

    }

    public void deleteBookings(Bookings reserva) {

        String sql = "DELETE FROM bookings WHERE Bookings_Id = ?";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, reserva.getBookingId());
            pstmt.executeUpdate();

        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public static double bookingsFacturation() {
        String taula = "bookings";
        String sql = "SELECT * FROM " + taula;
        double total = 0;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                double count = rs.getDouble("Price");
                total = total + count;
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
    }

    public ArrayList<Purchases> readPurchase() {
        ArrayList<Purchases> compras = new ArrayList<>();
        String taula = "purchase";
        String sql = "SELECT * FROM " + taula;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Purchases p = new Purchases(rs.getInt("Purchase_Id"), rs.getString("User_Id"), rs.getInt("Product_Id"), rs.getInt("Quantity"), rs.getDate("Date").toLocalDate(), rs.getDouble("Total_Price"));
                compras.add(p);
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return compras;

    }

    public int addPurchase(Purchases compra) {

        String sql = "INSERT INTO purchase(Purchase_Id,User_Id,Product_Id,Quantity,Date,Total_Price) VALUES(?,?,?,?,?,?)";
        try (Connection conn = connect();
                PreparedStatement ptmt = conn.prepareStatement(sql)) {
            ptmt.setInt(1, compra.getPurchaseId());
            ptmt.setString(2, compra.getUserId());
            ptmt.setInt(3, compra.getProductId());
            ptmt.setInt(4, compra.getQuantity());
            ptmt.setDate(5, Date.valueOf(compra.getDate()));
            ptmt.setDouble(6, compra.getTotalPrice());
            ptmt.executeUpdate();
            return 1;
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
            return 0;
        }

    }

    public void deletePurchase(Purchases compra) {

        String sql = "DELETE FROM purchase WHERE Purchase_Id = ?";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, compra.getPurchaseId());
            pstmt.executeUpdate();

        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public void updatePurchase(Purchases compra) {
        String sql = "UPDATE purchase SET Purchase_Id = ? ,"
                + "User_Id = ? ,"
                + "Product_Id = ?,"
                + "Quantity= ? ,"
                + "Date= ?,"
                + "Total_Price = ? ,";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, compra.getPurchaseId());
            pstmt.setString(2, compra.getUserId());
            pstmt.setInt(3, compra.getProductId());
            pstmt.setInt(4, compra.getQuantity());
            pstmt.setDate(5, Date.valueOf(compra.getDate()));
            pstmt.setDouble(6, compra.getTotalPrice());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public static double purchaseFacturation() {
        String taula = "purchase";
        String sql = "SELECT * FROM " + taula;
        double total = 0;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                double count = rs.getDouble("Total_Price");
                total = total + count;
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
    }

    public ArrayList<Products> readProducts() {
        ArrayList<Products> producto = new ArrayList<>();
        String taula = "products";
        String sql = "SELECT * FROM " + taula;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Products pr = new Products(rs.getInt("Product_Id"), rs.getString("Name"), rs.getDouble("Price"), rs.getInt("Stock"));
                producto.add(pr);
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return producto;

    }

    public int addProduct(Products producto) {

        String sql = "INSERT INTO products(Product_Id,Name,Price,Stock) VALUES(?,?,?,?)";
        try (Connection conn = connect();
                PreparedStatement ptmt = conn.prepareStatement(sql)) {
            ptmt.setInt(1, producto.getProductId());
            ptmt.setString(2, producto.getName());
            ptmt.setDouble(3, producto.getPrice());
            ptmt.setInt(4, producto.getStock());
            ptmt.executeUpdate();
            return 1;
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
            return 0;
        }

    }

    public void deleteProduct(Products producto) {

        String sql = "DELETE FROM products WHERE Product_Id = ?";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, producto.getProductId());
            pstmt.executeUpdate();

        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public void updateProduct(Products producto) {
        String sql = "UPDATE products SET Product_Id = ? ,"
                + "Name = ? ,"
                + "Price = ?,"
                + "Stock= ? ,";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, producto.getProductId());
            pstmt.setString(2, producto.getName());
            pstmt.setDouble(3, producto.getPrice());
            pstmt.setInt(4, producto.getStock());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public ArrayList<Cabins> readCabins() {
        ArrayList<Cabins> cabinas = new ArrayList<>();
        String taula = "cabins";
        String sql = "SELECT * FROM " + taula;

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Cabins c = new Cabins(rs.getInt("Cabin_Id"), rs.getString("Type"), rs.getBoolean("Disponibility"));
                cabinas.add(c);
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return cabinas;

    }

    public void updateCabins(Cabins cabina) {
        String sql = "UPDATE cabins SET Cabin_Id = ? ,"
                + "Type = ? ,"
                + "Disponibility = ?,";

        try (Connection conn = connect();
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setInt(1, cabina.getCabinId());
            pstmt.setString(2, cabina.getType());
            pstmt.setBoolean(3, cabina.getDisponibility());
            pstmt.executeUpdate();
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, e.getMessage());
        }
    }

    public String getUsers() {
        return readUsers().toString();
    }

    public String getPurchases() {
        return readPurchase().toString();
    }

    public String getBookings() {
        return readBookings().toString();
    }

    public String getProducts() {
        return readProducts().toString();
    }

    public String getCabins() {
        return readCabins().toString();
    }

    public void usersToFile() {
        ArrayList<Users> listausuarios = readUsers();
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/ArchivoUsers.csv"));
            String l;
            for (Users us : listausuarios) {

                outputStream.println(us.getUserId() + " , " + us.getName() + " , " + us.getSurname() + " , " + us.getTLF() + " , " + us.getEmail() + " , " + us.getPassword() + " . ");
            }

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " ArchivoUsers.csv " + " fitxategian.");
            }
        }
    }

    public void productsToFile() {
        ArrayList<Products> listaproductos = readProducts();
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/ArchivoProducts.csv"));
            String l;
            for (Products pd : listaproductos) {

                outputStream.println(pd.getProductId() + " , " + pd.getName() + " , " + pd.getPrice() + " , " + pd.getStock());
            }

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " ArchivoProducts.csv " + " fitxategian.");
            }
        }
    }
    
    public void bookingsToFile() {
        ArrayList<Bookings> listabookings = readBookings();
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/ArchivoBookings.csv"));
            String l;
            for (Bookings res : listabookings) {

                outputStream.println(res.getBookingId() + " , " + res.getUserId() + " , " + res.getCabinId() + " , " + res.getDate() + " , " + res.getHour());
            }

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " ArchivoBookings.csv " + " fitxategian.");
            }
        }
    }
    
    public void bookingsFactToFile(String archivo) {
        
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/BookingsFacturation.csv"));
            String l;
            

                outputStream.println(archivo);
            

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " BookingsFacturation.csv " + " fitxategian.");
            }
        }
    }
    
    public void purchaseFactToFile(String archivo) {
        
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/PurchaseFacturation.csv"));
            String l;
            

                outputStream.println(archivo);
            

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " PurchaseFacturation.csv " + " fitxategian.");
            }
        }
    }
    
    public void TotalFactToFile(String archivo) {
        
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("./files/TotalFacturation.csv"));
            String l;
            

                outputStream.println(archivo);
            

        } catch (Exception e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
        } finally {

            if (outputStream != null) {
                outputStream.close();
                System.out.println("Datuak gorde dira " + " TotalFacturation.csv " + " fitxategian.");
            }
        }
    }
    
    public String bestUserB() {
        String taula = "bookings";
        double bestUser = 0;
        String best = null;

        for (int i = 0; i < readUsers().size(); i++) {
            double totalUser = 0;
            String currentUser = readUsers().get(i).getUserId();
            String sql = "SELECT * FROM " + taula + " WHERE User_Id = '" + currentUser + "'";

            try (Connection conn = connect();
                    Statement stmt = conn.createStatement();
                    ResultSet rs = stmt.executeQuery(sql)) {
                while (rs.next()) {

                    double count = rs.getDouble("Price");
                    totalUser = totalUser + count;
                    if (totalUser > bestUser) {
                        bestUser = totalUser;
                        best = rs.getString("User_Id") + " , Gastatua:" + bestUser + " €";
                    }
                }
            } catch (Exception ex) {
                JOptionPane.showMessageDialog(null, ex.getMessage());
            }
        }

        return best;
    }

    public String bestUserP() {
        String taula = "purchase";
        double bestUser = 0;
        String best = null;

        for (int i = 0; i < readUsers().size(); i++) {
            double totalUser = 0;
            String currentUser = readUsers().get(i).getUserId();
            String sql = "SELECT * FROM " + taula + " WHERE User_Id = '" + currentUser + "'";

            try (Connection conn = connect();
                    Statement stmt = conn.createStatement();
                    ResultSet rs = stmt.executeQuery(sql)) {
                while (rs.next()) {

                    double count = rs.getDouble("Total_Price");
                    totalUser = totalUser + count;
                    if (totalUser > bestUser) {
                        bestUser = totalUser;
                        best = rs.getString("User_Id") + " , Gastatua:" + bestUser + " €";
                    }
                }
            } catch (Exception ex) {
                JOptionPane.showMessageDialog(null, ex.getMessage());
            }
        }

        return best;
    }
        
    public static Double bookingsTotal() {
        //prueba se cambia string por double, para controller textareafacturation
        int year = LocalDate.now().getYear();
        
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '"+year+"-01-01' AND '"+year+"-12-31') AS 'Facturation_Month'";
        double total = 0;
        String cadena = "";

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                total = rs.getDouble("Facturation_Month");

            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
    //return cadena = " TOTAL BOOKINGS FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public static Double purchaseTotal() {
        //prueba se cambia string por double, para controller textareafacturation
        int year = LocalDate.now().getYear();
        
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '"+year+"-01-01' AND '"+year+"-12-31') AS 'Facturation_Month'";
        double total = 0;
        String cadena = "";

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                total = rs.getDouble("Facturation_Month");

            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
        //return cadena = " TOTAL PURCHASE FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }
    
//    public String bookingsMonth(int month){
//        int year = LocalDate.now().getYear();
//        Month hilabetea = Month.of(month);
//        String mes = hilabetea.getDisplayName(TextStyle.FULL,Locale.ENGLISH);
//        
//        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') AS 'Facturation_Month'";
//        double total = 0;
//        String cadena = "";
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                total = rs.getDouble("Facturation_Month");
//
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return cadena = " " + mes + " Bookings \n -------------------------- \n " + String.valueOf(total) + " € \n \n";
//
//    }
//    
//    public String purchaseMonth(int month){
//        int year = LocalDate.now().getYear();
//        Month hilabetea = Month.of(month);
//        String mes = hilabetea.getDisplayName(TextStyle.FULL,Locale.ENGLISH);
//        
//        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') AS 'Facturation_Month'";
//        double total = 0;
//        String cadena = "";
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                total = rs.getDouble("Facturation_Month");
//
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return cadena = " " + mes + " Purchases  \n -------------------------- \n " + String.valueOf(total) + " € \n \n";
//    }
    
    
    public static Double purchaseMonthD(int month){
        int year = LocalDate.now().getYear();
        
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') AS 'Facturation_Month'";
        double total = 0;
        String cadena = "";

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                total = rs.getDouble("Facturation_Month");

            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
    }
    
    public static Double bookingsMonthD(int month){
        int year = LocalDate.now().getYear();
        
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') AS 'Facturation_Month'";
        double total = 0;
        String cadena = "";

        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                total = rs.getDouble("Facturation_Month");

            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
    }
    
    public static Double factMonth(int month){
        //prueba se cambia string por double, para controller textareafacturation
        int year = LocalDate.now().getYear();
        Month hilabetea = Month.of(month);
        String mes = hilabetea.getDisplayName(TextStyle.FULL,Locale.ENGLISH);
               
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '"+year+"-"+month+"-01' AND '"+year+"-"+month+"-31') AS 'Facturation_Month'"; 
        
        double total = 0;
        String cadena = "";
       
        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                     total = rs.getDouble("Facturation_Month");
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
        //return cadena = " " + mes + " Facturation \n --------------------------  \n " + String.valueOf(total) + " € \n \n";
    }
    
    public static double totalFact(int year) {
        //prueba se cambia string por double, para controller textareafacturation
        
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '"+year+"-01-01' AND '"+year+"-12-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '"+year+"-01-01' AND '"+year+"-12-31') AS 'Facturation_Annual'"; 
        
        double total = 0;
        String cadena = "";
       
        try (Connection conn = connect();
                Statement stmt = conn.createStatement();
                ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                     total = rs.getDouble("Facturation_Annual");
            }
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(null, ex.getMessage());
        }
        return total;
        //return cadena= " TOTAL FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

}
