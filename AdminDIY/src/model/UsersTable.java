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
public class UsersTable extends AbstractTableModel{

    private ArrayList<Users> usuarios = new ArrayList<>();
    private String[] columns = {"User_Id","Name","Surname","TLF","Email","Password"};
    
    public UsersTable(ArrayList<Users> users){
        this.usuarios = users;
    }
    
    @Override
    public int getRowCount() {
       return usuarios.size();
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
        case 0: return usuarios.get(rowIndex).getUserId();
        case 1: return usuarios.get(rowIndex).getName();
        case 2: return usuarios.get(rowIndex).getSurname();
        case 3: return usuarios.get(rowIndex).getTLF();
        case 4: return usuarios.get(rowIndex).getEmail();
        case 5: return usuarios.get(rowIndex).getPassword();
        default: return null;
        }
    }
    
}
