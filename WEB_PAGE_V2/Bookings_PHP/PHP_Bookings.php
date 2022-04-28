<?php

if(isset($_GET['erreserba']))
{
   delete_bookings($_GET['erreserba']);
} 

if(isset($_POST['insert_book']))
{
   insert_bookings();
} 

function delete_bookings($erreserba){
    include("../connect_db.php");
    //$gakoa = $_GET["erreserba"];
    $gakoa = $erreserba;
    $link = connectDataBase();
    
    //Liberar disponibilidad de cabina TRIGGER
    //$update = mysqli_query($link, "update cabins set Disponibility = '1' where Cabin_Id = (SELECT Cabin_Id FROM bookings WHERE Booking_Id = '$gakoa');");

    $delete = mysqli_query($link, "delete from bookings where Booking_Id='$gakoa'");
    $result = mysqli_query($link, "select * from bookings");

    mysqli_close($link);
    /*Berriro ere hasierako fitxategiari deitzeko*/
    header("Location: ./MYBookings.php");
}


function insert_bookings(){
    session_start();
  $sesioa = $_SESSION['User_Id'];
  include("../connect_db.php");
  $link = connectDataBase(); //connect_db.php-ko funtzioa

  $date = $_POST['data'];
  $time = $_POST['ordua'];
  $type = $_POST['vehicles'];
  $help = $_POST['yes_no'];
  $hours = $_POST['use_hours'];

  //CABIN CALCULO
  
  $kabina = mysqli_query($link, "select * from cabins where Type = '$type' and Disponibility = '1' ");
  $lerroa = mysqli_fetch_assoc($kabina);
  $cabin = $lerroa['Cabin_Id']; 
  //Cambiar disponobility de cabina TRIGGER
 // $update = mysqli_query($link, "update cabins set Disponibility = '0' where Cabin_Id ='$cabin'");



  //TOTAL_PRICE CALCULO
  $price = mysqli_query($link, "select * from vehicles where Type = '$type'");
  $row = mysqli_fetch_assoc($price);
  //Horas de trabajo a pagar en caso de necesitar ayuda
  if($help == 'yes'){
    $worker_hours = $hours * 15;
  }
  else if($help == 'no'){
    $worker_hours = 0;
  }
  $worker_hours = 0;
  $total_price = ((float)$row['Price_Hour'] * (int)$hours + (float)$worker_hours ); 
  
 
  //Bookings_Id al ser AUTO_INCREMENT hay que dejarlo vacío
  //Cuidado con el NULL ha dado problemas
  if($help == 'yes'){
    $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', '44444444F' , '$hours', '$total_price')");
  }
  else if ($help == 'no'){
    $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', NULL, '$hours', '$total_price')");
  }

  mysqli_close($link);
  header("Location: ./Bookings.php");
}
?>
