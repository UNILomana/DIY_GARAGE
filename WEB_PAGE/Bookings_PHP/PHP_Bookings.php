<?php
include("../connect_db.php");

if (isset($_GET['erreserba'])) {
  delete_bookings($_GET['erreserba']);
}

if (isset($_POST['insert_book'])) {
  insert_bookings();
}

function delete_bookings($erreserba)
{
  $gakoa = $erreserba;
  $link = connectDataBase();

  $delete = mysqli_query($link, "delete from bookings where Booking_Id='$gakoa'");

  mysqli_close($link);
  header("Location: ./MYBookings.php");
}


function insert_bookings()
{
  $link = connectDataBase(); 
  session_start();

  //INSERT VALUES(CON SEGURIDAD PREPARED STATEMENTS)
  //Bookings_Id al ser AUTO_INCREMENT hay que dejarlo vacío
  //Cuidado con el NULL ha dado problemas
  $result = $link -> prepare ("insert into bookings values (?,?,?,?,?,?,?,?,?)");
  $result -> bind_param("sssssssss", $booking_id, $sesioa , $cabin , $date , $time , $type , $help , $helper , $total_price);

  $booking_id = '';
  $sesioa = $_SESSION['User_Id'];
  $date = $_POST['data'];
  $time = $_POST['ordua'];
  $type = $_POST['vehicles'];
  $help = $_POST['yes_no'];

  //Elegir la cabina y el ayudante SEGUN TYPE OF VEHICLE
  $kabina = mysqli_query($link, "select * from cabins where Type = '$type'");
  $kabina_lerroa = mysqli_fetch_assoc($kabina);
  $cabin = $kabina_lerroa['Cabin_Id'];
  
  //COMPRUEBA QUE LAS FECHAS ESTAN DISPONIBLES
  $fecha= mysqli_query($link, "select * from bookings where Date = '$date' and Hour= '$time' and Cabin_Id ='$cabin'"); 
  $fecha_lerroa = mysqli_num_rows($fecha);

  if ($fecha_lerroa > 0) {     
    header("Location: ./Bookings.php?incorrect=yes");
  } else {
   
    //TOTAL_PRICE CALCULO
    $price = mysqli_query($link, "select * from vehicles where Type = '$type'");
    $price_lerroa = mysqli_fetch_assoc($price);
    //Horas de trabajo a pagar en caso de necesitar ayuda
    if ($help == 'yes') {
      $worker_hours_price = 25;
    } else if ($help == 'no') {
      $worker_hours_price = 0;
    }
    $total_price = ((float)$price_lerroa['Price_Hour'] + (float)$worker_hours_price);

    if ($help == 'yes') {
      $helper = $kabina_lerroa['Helper'];
    } else if ($help == 'no') {
      $helper = NULL;
    }

    $result->execute();
    $result->close();
    $link->close();

    header("Location: ./Bookings.php?incorrect=no");
    }
  }
