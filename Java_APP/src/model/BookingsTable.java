/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;
import java.util.ArrayList;
import javax.swing.table.AbstractTableModel;

/**
 *
 * @author parra.raul
 */
public class BookingsTable  extends AbstractTableModel {
    
    private ArrayList<Bookings> reservas = new ArrayList<>();
    private String[] columns = {"Booking_Id","User_Id","Cabin_Id","Date","Hour"};

    public BookingsTable(ArrayList<Bookings> reservas){
        this.reservas = reservas;
      
    }
    @Override
    public int getRowCount() {
        return reservas.size();
    }

    @Override
    public int getColumnCount() {
        return columns.length;
    }
    
    @Override
    public String getColumnName(int column){
        return columns[column];
    }
    
    @Override
    public Object getValueAt(int rowIndex, int columnIndex) {
       switch(columnIndex){
            case 0: return reservas.get(rowIndex).getBookingId();
            case 1: return reservas.get(rowIndex).getUserId();
            case 2: return reservas.get(rowIndex).getCabinId();
            case 3: return reservas.get(rowIndex).getDate();
            case 4: return reservas.get(rowIndex).getHour();
            default: return null;
        }
    }
    
}
