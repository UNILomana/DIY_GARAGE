<?php

if(isset($_GET['produktua']))
{
   delete_product($_GET['produktua']);
} 

if(isset($_POST['newproduct']))
{
   insert_product();
} 

function delete_product($produktua){
    include("../connect_db.php");
    //$gakoa = $_GET["produktua"];
    $gakoa = $produktua;
    $link = connectDataBase();
    $delete = mysqli_query($link, "delete from products where Product_Id='$gakoa'");      
    mysqli_close($link);
    /*Berriro ere hasierako fitxategiari deitzeko*/
    header("Location: ./Employee_Products.php");
}


function insert_product(){
    session_start();
    include("../connect_db.php");
    $link = connectDataBase();


    $name = $_POST['product_name'];
    $price =  $_POST['product_price'];
    $stocka = $_POST['product_stock'];
    $produktu_argazkia = $_POST['argazkia']; 
    
    /*ARGAZKI TRATAMENDUA*/ 
    
    $serbitzarikoHelbidea = '../Images/Products'; 							# Karpeta sortu "Argazkiak", honen barruan beste bat "DB". 
    $helbideTemporala = 	$_FILES['argazkia']['tmp_name']; 				# Argazkiaren helbidea:
    $argazkiIzena = 		$_FILES['argazkia']['name']; 					# Argazki izena:
    $bukaeraHelbidea = 		$serbitzarikoHelbidea.'/'.$argazkiIzena; 	# Bukaerako helbidearen helbidea gorde. 
    move_uploaded_file($helbideTemporala,$bukaeraHelbidea); 			# Argazkiaren kopia bat egin "Argazkiak/DB" karpetan. 


    //INSERT VALUES
    $result = mysqli_query($link, "insert into products values ('', '$name', '$price', '$stocka', '$bukaeraHelbidea')");

    mysqli_close($link);
    header("Location: ./Employee_Products.php");   
}
?>
