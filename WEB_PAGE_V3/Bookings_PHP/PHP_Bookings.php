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
  $sesioa = $_SESSION['User_Id'];
  $date = $_POST['data'];
  $time = $_POST['ordua'];
  $type = $_POST['vehicles'];
  $help = $_POST['yes_no'];
  $hours = $_POST['use_hours'];


  //Elegir la cabina y el ayudante SEGUN TYPE OF VEHICLE
  $kabina = mysqli_query($link, "select * from cabins where Type = '$type'");
  $kabina_lerroa = mysqli_fetch_assoc($kabina);
  $cabin = $kabina_lerroa['Cabin_Id'];
  $helper = $kabina_lerroa['Helper'];
  
  //COMPRUEBA QUE LAS FECHAS ESTAN DISPONIBLES
  $fecha= mysqli_query($link, "select * from bookings where Date = '$date' and Hour= '$time' and Cabin_Id ='$cabin'"); //comprueba si existe alguna reserva con esa fecha
  $fecha_lerroa = mysqli_num_rows($fecha);

  if ($fecha_lerroa > 0) {     
    header("Location: ./Bookings.php?incorrect=yes");
  } else {
    //TOTAL_PRICE CALCULO
    $price = mysqli_query($link, "select * from vehicles where Type = '$type'");
    $price_lerroa = mysqli_fetch_assoc($price);
    //Horas de trabajo a pagar en caso de necesitar ayuda
    if ($help == 'yes') {
      $worker_hours = $hours * 15;
    } else if ($help == 'no') {
      $worker_hours = 0;
    }
    $total_price = ((float)$price_lerroa['Price_Hour'] * (int)$hours + (float)$worker_hours);


    /*EN CASO DE QUITAR LAS HORAS */
    /*
    //TOTAL_PRICE CALCULO
    $price = mysqli_query($link, "select * from vehicles where Type = '$type'");
    $price_lerroa = mysqli_fetch_assoc($price);
    //Horas de trabajo a pagar en caso de necesitar ayuda
    if ($help == 'yes') {
      $worker_hours_price = 25;
    } else if ($help == 'no') {
      $worker_hours = 0;
    }
    $total_price = ((float)$price_lerroa['Price_Hour'] + (float)$worker_hours_price);*/


    //Bookings_Id al ser AUTO_INCREMENT hay que dejarlo vacío
    //Cuidado con el NULL ha dado problemas
    if ($help == 'yes') {
      $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', '$helper' , '$hours', '$total_price')");
    } else if ($help == 'no') {
      $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', NULL, '$hours', '$total_price')");
    }

    mysqli_close($link);
    header("Location: ./Bookings.php?incorrect=no");
    }
  }
?>