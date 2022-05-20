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
public class ProductsTable extends AbstractTableModel{
    
    private ArrayList<Products> productos = new ArrayList<>();
    private String[] columns = {"Product_Id","Name","Price","Stock"};

     public ProductsTable(ArrayList<Products> products){
        this.productos = products;
      
    }
     
    @Override
    public int getRowCount() {
        return productos.size();
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
            case 0: return productos.get(rowIndex).getProductId();
            case 1: return productos.get(rowIndex).getName();
            case 2: return productos.get(rowIndex).getPrice();
            case 3: return productos.get(rowIndex).getStock();
            default: return null;
        }
    }
    
}
