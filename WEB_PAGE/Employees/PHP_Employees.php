<?php
include("../connect_db.php");
if(isset($_GET['produktua']))
{
   delete_product($_GET['produktua']);
} 

if(isset($_POST['newproduct']))
{
   insert_product();
} 

function delete_product($produktua){
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
    $link = connectDataBase();

    //INSERT VALUES(CON SEGURIDAD PREPARED STATEMENTS)
    $result = $link -> prepare ("insert into products values (? , ? , ? , ? , ? )");
    $result -> bind_param("sssss", $product_id, $name, $price, $stocka , $bukaeraHelbidea);

    $product_id = '';
    $name = $_POST['product_name'];
    $price =  $_POST['product_price'];
    $stocka = $_POST['product_stock'];
 
    
    /*ARGAZKI TRATAMENDUA*/ 
    $serbitzarikoHelbidea = '../Images/Products'; 							# Karpeta sortu "Argazkiak", honen barruan beste bat "DB". 
    $helbideTemporala = 	$_FILES['argazkia']['tmp_name']; 				# Argazkiaren helbidea:
    $argazkiIzena = 		$_FILES['argazkia']['name']; 					# Argazki izena:
    $bukaeraHelbidea = 		$serbitzarikoHelbidea.'/'.$argazkiIzena; 	    # Bukaerako helbidearen helbidea gorde. 
    move_uploaded_file($helbideTemporala,$bukaeraHelbidea); 			    # Argazkiaren kopia bat egin "Argazkiak/DB" karpetan. 

    $result->execute();
    $result->close();
    $link->close();

    header("Location: ./Employee_Products.php");   
}
