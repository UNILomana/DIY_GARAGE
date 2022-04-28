<?php

if(isset($_GET['erosketa']))
{
   delete_purchase($_GET['erosketa']);
} 

if(isset($_POST['getpurchase']))
{
   insert_purchase();
} 

function delete_purchase($erosketa){
    include("../connect_db.php");
    //$gakoa = $_GET["erosketa"];
    $gakoa = $erosketa;
    $link = connectDataBase();
    $delete = mysqli_query($link, "delete from purchase where Purchase_Id='$gakoa'");

        
    mysqli_close($link);
    /*Berriro ere hasierako fitxategiari deitzeko*/
    header("Location: ./MyPurchases.php");
}


function insert_purchase(){
    session_start();
    include("../connect_db.php");
    $link = connectDataBase();

    $ID = $_POST['products'];
    $quantity =  $_POST['zenbatekoa'];
    $sesioa = $_SESSION['User_Id'];
    $date = date("Y-m-d");
    
    $price = mysqli_query($link, "select * from products where Product_Id = $ID");
    $row = mysqli_fetch_assoc($price);
    $total_Price = ((float)$row['Price'] * (int)$quantity);  
    
    //INSERT VALUES
    $result = mysqli_query($link, "insert into purchase values ('', '$sesioa', '$ID', '$quantity', '$date', '$total_Price' )");

    mysqli_close($link);
    header("Location: ./Products.php");    
  
}
?>
