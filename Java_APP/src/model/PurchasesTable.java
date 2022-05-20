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
public class PurchasesTable extends AbstractTableModel{
    private ArrayList<Purchases> purchases = new ArrayList<>();
    private String[] columns = {"Purchase_Id","UserId","ProductId","Quantity","Date","Price"};

     public PurchasesTable(ArrayList<Purchases> purchases){
        this.purchases = purchases;
      
    }
     
    @Override
    public int getRowCount() {
        return purchases.size();
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
            case 0: return purchases.get(rowIndex).getPurchaseId();
            case 1: return purchases.get(rowIndex).getUserId();
            case 2: return purchases.get(rowIndex).getProductId();
            case 3: return purchases.get(rowIndex).getQuantity();
            case 4: return purchases.get(rowIndex).getDate();
            case 5: return purchases.get(rowIndex).getTotalPrice();
            default: return null;
        }
    }
}
