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
import java.util.ArrayList;
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
    public Connection connect() {
        Connection conn = null;
        try {
            String url = "jdbc:mysql://localhost:3306/db_garage";
            String user = "root";
            String password = "";
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

//    public double bookingsFacturation() {
//        String taula = "bookings";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                double count = rs.getDouble("Price");
//                total = total + count;
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return total;
//    }
//    public String bookingsFacturationAnnual() {
//        String taula = "bookings";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//        String cadena = "";
//
//        int currentYear = LocalDate.now().getYear();
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                if (currentYear == rs.getDate("Date").toLocalDate().getYear()) {
//                    double count = rs.getDouble("Price");
//                    total = total + count;
//
//                }
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return cadena = " " + String.valueOf(currentYear) + " DIY FACTURATION   \n -------------------------- \n " + String.valueOf(total) + " € \n \n";
//    }
//    public double bookingsFacturationAnnualD() {
//        String taula = "bookings";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//
//        int currentYear = LocalDate.now().getYear();
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                if (currentYear == rs.getDate("Date").toLocalDate().getYear()) {
//                    double count = rs.getDouble("Price");
//                    total = total + count;
//
//                }
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return total;
//    }
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

//    public double purchaseFacturation() {
//        String taula = "purchase";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                double count = rs.getDouble("Total_Price");
//                total = total + count;
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return total;
//    }
//
//    public String purchaseFacturationAnnual() {
//        String taula = "purchase";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//        String cadena = "";
//        int currentYear = LocalDate.now().getYear();
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                if (currentYear == rs.getDate("Date").toLocalDate().getYear()) {
//                    double count = rs.getDouble("Total_Price");
//                    total = total + count;
//                }
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return cadena = " " + String.valueOf(currentYear) + " DIY FACTURATION   \n -------------------------- \n " + String.valueOf(total) + " € \n \n";
//    }
//
//    public double purchaseFacturationAnnualD() {
//        String taula = "purchase";
//        String sql = "SELECT * FROM " + taula;
//        double total = 0;
//        int currentYear = LocalDate.now().getYear();
//
//        try (Connection conn = connect();
//                Statement stmt = conn.createStatement();
//                ResultSet rs = stmt.executeQuery(sql)) {
//            while (rs.next()) {
//                if (currentYear == rs.getDate("Date").toLocalDate().getYear()) {
//                    double count = rs.getDouble("Total_Price");
//                    total = total + count;
//                }
//            }
//        } catch (Exception ex) {
//            JOptionPane.showMessageDialog(null, ex.getMessage());
//        }
//        return total;
//    }
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
            outputStream = new PrintWriter(new FileWriter("ArchivoUsers.csv"));
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
            outputStream = new PrintWriter(new FileWriter("ArchivoProducts.csv"));
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

    public void bookingsFactToFile(String archivo) {
        
        PrintWriter outputStream = null;

        try {
            outputStream = new PrintWriter(new FileWriter("BookingsFacturation.csv"));
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
            outputStream = new PrintWriter(new FileWriter("PurchaseFacturation.csv"));
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
            outputStream = new PrintWriter(new FileWriter("TotalFacturation.csv"));
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

    public String bookingsJan() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-01-01' AND '2022-01-31') AS 'Facturation_Month'";
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
        return cadena = " JANUARY BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseJan() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-01-01' AND '2022-01-31') AS 'Facturation_Month'";
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
        return cadena = " JANUARY PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsFeb() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-02-01' AND '2022-02-28') AS 'Facturation_Month'";
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
        return cadena = " FEBRUARY BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseFeb() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-02-01' AND '2022-02-28') AS 'Facturation_Month'";
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
        return cadena = " FEBRUARY PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsMarch() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-03-01' AND '2022-03-31') AS 'Facturation_Month'";
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
        return cadena = " MARCH BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseMarch() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-03-01' AND '2022-03-31') AS 'Facturation_Month'";
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
        return cadena = " MARCH PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsApr() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-04-01' AND '2022-04-30') AS 'Facturation_Month'";
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
        return cadena = " APRIL BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseApr() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-04-01' AND '2022-04-30') AS 'Facturation_Month'";
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
        return cadena = " APRIL BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsMay() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-05-01' AND '2022-05-31') AS 'Facturation_Month'";
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
        return cadena = " MAY BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseMay() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-05-01' AND '2022-05-31') AS 'Facturation_Month'";
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
        return cadena = " MAY PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsJune() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-06-01' AND '2022-06-30') AS 'Facturation_Month'";
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
        return cadena = " JUNE BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseJune() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-06-01' AND '2022-06-30') AS 'Facturation_Month'";
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
        return cadena = " JUNE PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsJuly() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-07-01' AND '2022-07-31') AS 'Facturation_Month'";
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
        return cadena = " JULY BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseJuly() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-07-01' AND '2022-07-31') AS 'Facturation_Month'";
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
        return cadena = " JULY PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsAug() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-08-01' AND '2022-08-31') AS 'Facturation_Month'";
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
        return cadena = " AUGUST BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseAug() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-08-01' AND '2022-08-31') AS 'Facturation_Month'";
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
        return cadena = " AUGUST PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsSep() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-09-01' AND '2022-09-30') AS 'Facturation_Month'";
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
        return cadena = " SEPTEMBER BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseSep() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-09-01' AND '2022-09-30') AS 'Facturation_Month'";
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
        return cadena = " SEPTEMBER PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsOct() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-10-01' AND '2022-10-31') AS 'Facturation_Month'";
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
        return cadena = " OCTOBER BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseOct() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-10-01' AND '2022-10-31') AS 'Facturation_Month'";
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
        return cadena = " OCTOBER PURCHASES \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsNov() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-11-01' AND '2022-11-30') AS 'Facturation_Month'";
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
        return cadena = " NOVEMBER BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseNov() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-11-01' AND '2022-11-30') AS 'Facturation_Month'";
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
        return cadena = " NOVEMBER PURCHASES \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsDec() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-12-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " DECEMBER BOOKINGS \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseDec() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-12-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " DECEMBER PURCHASE \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String bookingsTotal() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-01-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " TOTAL BOOKINGS FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String purchaseTotal() {
        String sql = "SELECT (SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-01-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " TOTAL PURCHASE FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String factJan() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-01-01' AND '2022-01-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-01-01' AND '2022-01-31') AS 'Facturation_Month'";
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
        return cadena = " JANUARY FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String factFeb() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-02-01' AND '2022-02-28') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-02-01' AND '2022-02-28') AS 'Facturation_Month'";
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
        return cadena = " FEBRUARY FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String factMar() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-03-01' AND '2022-03-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-03-01' AND '2022-03-31') AS 'Facturation_Month'";
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
        return cadena = " MARCH FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String factApr() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-04-01' AND '2022-04-30') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-04-01' AND '2022-04-30') AS 'Facturation_Month'";
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
        return cadena = " APRIL FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";

    }

    public String factMay() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-05-01' AND '2022-05-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-05-01' AND '2022-05-31') AS 'Facturation_Month'";
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
        return cadena = " MAY FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factJun() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-06-01' AND '2022-06-30') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-06-01' AND '2022-06-30') AS 'Facturation_Month'";
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
        return cadena = " JUNE FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factJul() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-07-01' AND '2022-07-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-07-01' AND '2022-07-31') AS 'Facturation_Month'";
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
        return cadena = " JULY FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factAug() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-08-01' AND '2022-08-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-08-01' AND '2022-08-31') AS 'Facturation_Month'";
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
        return cadena = " AUGUST FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factSep() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-09-01' AND '2022-09-30') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-09-01' AND '2022-09-30') AS 'Facturation_Month'";
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
        return cadena = " SEPTEMBER FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factOct() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-10-01' AND '2022-10-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-10-01' AND '2022-10-31') AS 'Facturation_Month'";
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
        return cadena = " OCTOBER FACTURATION \n -------------------------- \n " + String.valueOf(total) + " € \n \n";
    }

    public String factNov() {
        String sql = "SELECT (SELECT  SUM(Price) FROM bookings WHERE Date BETWEEN '2022-11-01' AND '2022-11-30' ) + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-11-01' AND '2022-11-30' ) AS 'Facturation_Month'";
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
        return cadena = " NOVEMBER FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String factDec() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-12-01' AND '2022-12-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-12-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " DECEMBER FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

    public String totalFact() {
        String sql = "SELECT (SELECT SUM(Price) FROM bookings WHERE Date BETWEEN '2022-01-01' AND '2022-12-31') + "
                + "(SELECT SUM(Total_Price) FROM purchase WHERE Date BETWEEN '2022-01-01' AND '2022-12-31') AS 'Facturation_Month'";
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
        return cadena = " TOTAL FACTURATION \n --------------------------  \n " + String.valueOf(total) + " € \n \n";

    }

}