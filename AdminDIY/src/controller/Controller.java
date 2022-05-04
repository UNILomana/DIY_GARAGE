/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.time.Month;
import java.time.format.TextStyle;
import java.util.ArrayList;
import java.util.Locale;
import static javax.swing.WindowConstants.DISPOSE_ON_CLOSE;
import model.Bookings;
import model.BookingsTable;
import model.Model;
import model.Products;
import model.ProductsTable;
import model.Purchases;
import model.PurchasesTable;
import model.Users;
import model.UsersTable;
import view.View;

/**
 *
 * @author parra.raul
 */
public class Controller implements ActionListener {

    private Model model;
    private View view;

    public Controller(Model model, View view) {

        this.model = model;
        this.view = view;

        gehituActionListener(this);
    }

    private void gehituActionListener(ActionListener listener) {

        //GUIaren konponente guztiei listenerra gehitu
        view.jButtonUsers.addActionListener(listener);
        view.jButtonProducts.addActionListener(listener);
        view.jButtonExit.addActionListener(listener);
        view.jButtonSaveUsers.addActionListener(listener);
        view.jButtonBackUsers.addActionListener(listener);
        view.jButtonSaveProducts.addActionListener(listener);
        view.jButtonBackProducts.addActionListener(listener);
        view.jButtonPurchases.addActionListener(listener);
        view.jButtonBackPurchases.addActionListener(listener);
        view.jButtonBiling.addActionListener(listener);
        view.jButtonOK.addActionListener(listener);
        view.jComboBoxFacturation.addActionListener(listener);
        view.jButtonBestUser.addActionListener(listener);
        view.jButtonBACKUSER.addActionListener(listener);
        view.jButtonBACKFACTURATION.addActionListener(listener);
        view.jButtonBESTUSERP.addActionListener(listener);
        view.jButtonBOOKINGS.addActionListener(listener);
        view.jButtonBackBookings.addActionListener(listener);
        view.jButtonSaveFact.addActionListener(listener);
        view.jButtonSaveBookings.addActionListener(listener);
        view.jButtonGraphicsGeneral.addActionListener(listener);
        view.jButtonGraphicView.addActionListener(listener);
        view.jButtonBackView.addActionListener(listener);
        view.jButtonAnotherGraphic.addActionListener(listener);
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        String actionCommand = e.getActionCommand();
        //listenerrak entzun dezakeen eragiketa bakoitzeko. Konponenteek 'actionCommad' propietatea daukate
        switch (actionCommand) {
            case "USERS":
                System.out.println("Users botoia sakatu duzu");
                view.jDialogUsers.setVisible(true);
                view.jDialogUsers.setSize(600, 400);
                ArrayList<Users> users = model.readUsers();
                view.jTableUsers.setModel(new UsersTable(model.readUsers()));
                view.jLabelUsuariosCont.setText("There are " + users.size() + " users");
                view.setVisible(false);
                break;

            case "BOOKINGS":
                System.out.println("Users botoia sakatu duzu");
                view.jDialogBookings.setVisible(true);
                view.jDialogBookings.setSize(700, 450);
                view.jTableBookings.setModel(new BookingsTable(model.readBookings()));
                view.setVisible(false);
                break;

            case "PRODUCTS":
                System.out.println("Products botoia sakatu duzu");
                view.jDialogProducts.setVisible(true);
                view.jDialogProducts.setSize(600, 400);
                ArrayList<Products> products = model.readProducts();
                view.jTableProducts.setModel(new ProductsTable(model.readProducts()));
                view.jLabelProductsCont.setText("There are " + products.size() + " products");
                view.setVisible(false);
                break;

            case "EXIT":
                view.dispose();
                break;

            case "SAVE_USERS":
                System.out.println("Save botoia sakatu duzu");
                model.usersToFile();
                break;

            case "BACK_USERS":
                System.out.println("Back botoia sakatu duzu");
                view.jDialogUsers.setVisible(false);
                view.setVisible(true);
                break;

            case "SAVE_PRODUCTS":
                System.out.println("Save botoia sakatu duzu");
                model.productsToFile();
                break;

            case "BACK_PRODUCTS":
                System.out.println("Back botoia sakatu duzu");
                view.jDialogProducts.setVisible(false);
                view.setVisible(true);
                break;

            case "PURCHASES":
                System.out.println("Biling botoia sakatu duzu");
                view.jDialogPurchases.setVisible(true);
                view.jDialogPurchases.setSize(600, 400);
                ArrayList<Purchases> purchases = model.readPurchase();
                view.jTableBiling.setModel(new PurchasesTable(model.readPurchase()));
                view.setVisible(false);
                break;

            case "BACK_PURCHASES":
                System.out.println("Back botoia sakatu duzu");
                view.jDialogPurchases.setVisible(false);
                view.setVisible(true);
                break;

            case "FACTURATION":
                System.out.println("Biling botoia sakatu duzu");
                view.jDialogBiling.setVisible(true);
                view.jDialogBiling.setSize(225, 200);
                view.jTextAreaFacturation.setVisible(false);
                view.setVisible(false);
                break;

            case "OK":

                System.out.println("Ok botoia sakatu duzu");
                if (view.jComboBoxFacturation.getSelectedIndex() == 0) {
                    System.out.println("Bookings Facturacion Annual opzioa");
                    view.jDialogBiling.setSize(600, 400);
                    view.jTextAreaFacturation.setVisible(true);
                    view.jTextAreaFacturation.setText("");
                    for (int i = 1; i <= 12; i++) {
                        Month hilabetea = Month.of(i);
                        String mes = hilabetea.getDisplayName(TextStyle.FULL, Locale.ENGLISH);
                        view.jTextAreaFacturation.append(" " + mes + " Bookings \n -------------------------- \n " + model.bookingsMonthD(i) + " € \n \n");
                    }
                    view.jTextAreaFacturation.append(" TOTAL BOOKINGS FACTURATION \n -------------------------- \n " + model.bookingsTotal() + " € \n \n");
                    
                }
                if (view.jComboBoxFacturation.getSelectedIndex() == 1) {
                    System.out.println("Purchase Facturation Annual opzioa");
                    view.jDialogBiling.setSize(600, 400);
                    view.jTextAreaFacturation.setVisible(true);
                    view.jTextAreaFacturation.setText("");                    
                    for (int i = 1; i <= 12; i++) {
                        Month hilabetea = Month.of(i);
                        String mes = hilabetea.getDisplayName(TextStyle.FULL, Locale.ENGLISH);
                        view.jTextAreaFacturation.append(" " + mes + " Purchase \n -------------------------- \n " + model.purchaseMonthD(i) + " € \n \n");
                    }
                    view.jTextAreaFacturation.append(" TOTAL PURCHASE FACTURATION \n -------------------------- \n " + model.purchaseTotal() + " € \n \n");
                }
                if (view.jComboBoxFacturation.getSelectedIndex() == 2) {
                    System.out.println("Total Facturation Annual opzioa");
                    view.jDialogBiling.setSize(600, 400);
                    view.jTextAreaFacturation.setVisible(true);
                    view.jTextAreaFacturation.setText("");
                    for (int i = 1; i <= 12; i++) {
                        Month hilabetea = Month.of(i);
                        String mes = hilabetea.getDisplayName(TextStyle.FULL, Locale.ENGLISH);
                        view.jTextAreaFacturation.append(" " + mes + " Facturation \n --------------------------  \n " + model.factMonth(i) + " € \n \n");
                    }
                    view.jTextAreaFacturation.append(" TOTAL PURCHASE FACTURATION \n -------------------------- \n " + model.totalFact(2022) + " € \n \n");
                    
                    
//                    view.jTextAreaFacturation.setText(model.factMonth(1) + model.factMonth(2) + model.factMonth(3) + model.factMonth(4) + model.factMonth(5)
//                            + model.factMonth(6) + model.factMonth(7) + model.factMonth(8) + model.factMonth(9) + model.factMonth(10) + model.factMonth(11) + model.factMonth(12)
//                            + model.totalFact(2022));

                }
                break;

            case "BESTUSER":
                System.out.println("BEST USER botoia sakatu duzu");
                view.jDialogBESTUSER.setVisible(true);
                view.jDialogBESTUSER.setSize(400, 300);
                view.jDialogUsers.setVisible(false);
                view.jTextAreaBestUserB.setText(model.bestUserB());
                break;

            case "BACKUSER":
                view.jDialogBESTUSER.setVisible(false);
                view.jDialogUsers.setVisible(true);
                break;

            case "BACKFACTURATION":
                view.jDialogBiling.setVisible(false);
                view.setVisible(true);
                break;

            case "BESTUSERP":
                System.out.println("BEST USER P botoia sakatu duzu");
                view.jDialogBESTUSER.setVisible(true);
                view.jDialogBESTUSER.setSize(400, 300);
                view.jDialogPurchases.setVisible(false);
                view.jTextAreaBestUserB.setText(model.bestUserP());
                break;

            case "BACKBOOKINGS":
                System.out.println("Back botoia sakatu duzu");
                view.jDialogBookings.setVisible(false);
                view.setVisible(true);
                break;

            case "SAVE_FACT":
                System.out.println("Save botoia sakatu duzu");
                if (view.jComboBoxFacturation.getSelectedIndex() == 0) {
                    model.bookingsFactToFile(view.jTextAreaFacturation.getText());
                }
                if (view.jComboBoxFacturation.getSelectedIndex() == 1) {
                    model.purchaseFactToFile(view.jTextAreaFacturation.getText());
                }
                if (view.jComboBoxFacturation.getSelectedIndex() == 2) {
                    model.TotalFactToFile(view.jTextAreaFacturation.getText());
                }
                break;

            case "SAVE_Bookings":
                System.out.println("Save botoia sakatu duzu");
                model.bookingsToFile();
                break;

            case "GRAPHICS":

                System.out.println("Graphics botoia sakatu duzu");
                view.jDialogGraphicsGeneral.setVisible(true);
                view.jDialogGraphicsGeneral.setSize(600, 450);
                view.setVisible(false);
                break;

            case "Graphic":
                System.out.println("Graphic ikusteko botoia sakatu duzu");
                
                break;

            case "GraphicPieChart":
                System.out.println("Pie Chart botoia sakatu duzu");
                break;

            case "Another":
                System.out.println("Another botoia sakatu duzu");
                break;

            case "BACKVIEW":
                System.out.println("Back botoia sakatu duzu");
                view.setVisible(true);
                view.jDialogGraphicsGeneral.setVisible(false);
                break;

            case "Another2":
                System.out.println("Another2 botoia sakatu duzu");
        }
    }
}
