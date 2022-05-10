<?php
include("../connect_db.php");
if(isset($_GET['erosketa']))
{
   delete_purchase($_GET['erosketa']);
} 

if(isset($_POST['getpurchase']))
{
   insert_purchase();
} 

function delete_purchase($erosketa){
    $gakoa = $erosketa;
    $link = connectDataBase();
    $delete = mysqli_query($link, "delete from purchase where Purchase_Id='$gakoa'");

    mysqli_close($link);
    header("Location: ./MyPurchases.php");
}


function insert_purchase(){
    session_start();
    $link = connectDataBase();

    //INSERT VALUES(CON SEGURIDAD PREPARED STATEMENTS)
    //a todos los valores ponerles string('s') bestela no funciona
    $result = $link->prepare("insert into purchase values (? , ? , ? , ? , ? , ? )");
    $result -> bind_param("ssssss", $purchase_Id, $sesioa , $ID , $quantity , $date , $total_Price );

    $purchase_Id = '';
    $ID = $_POST['products'];
    $quantity =  $_POST['zenbatekoa'];
    $sesioa = $_SESSION['User_Id'];
    $date = date("Y-m-d");
    
    $price = mysqli_query($link, "select * from products where Product_Id = $ID");
    $row = mysqli_fetch_assoc($price);
    $total_Price = ((float)$row['Price'] * (int)$quantity);  
    
    $result->execute();
    $result->close();
    $link->close();
  
    header("Location: ./Products.php?correct=yes");
}
?>
