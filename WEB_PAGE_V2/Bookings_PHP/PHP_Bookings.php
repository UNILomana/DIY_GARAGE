<?php
//control

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION["email"]) || $_SESSION["email"] == null) {
  echo "<html> <marquee><h1>You don't have permission to load this page<h1></marquee><html>";
  die();
}

?>

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
  include("../connect_db.php");
  //$gakoa = $_GET["erreserba"];
  $gakoa = $erreserba;
  $link = connectDataBase();

  $delete = mysqli_query($link, "delete from bookings where Booking_Id='$gakoa'");
  $result = mysqli_query($link, "select * from bookings");

  mysqli_close($link);
  /*Berriro ere hasierako fitxategiari deitzeko*/
  header("Location: ./MYBookings.php");
}


function insert_bookings()
{
  session_start();
  $sesioa = $_SESSION['User_Id'];
  include("../connect_db.php");
  $link = connectDataBase(); //connect_db.php-ko funtzioa

  $date = $_POST['data'];
  $time = $_POST['ordua'];
  $type = $_POST['vehicles'];
  $help = $_POST['yes_no'];
  $hours = $_POST['use_hours'];


  //COMPRUEBA QUE LAS FECHAS ESTAN DISPONIBLES
  $kabina = mysqli_query($link, "select * from cabins where Type = '$type' and Disponibility = '1'");
  $emaitza2 = mysqli_num_rows($kabina);

  $lerroa = mysqli_fetch_assoc($kabina);
  $cabin = $lerroa['Cabin_Id'];
  
  if ($emaitza2 == 0) {

    //$kabina = mysqli_query($link, "select * from cabins where Type = '$type' and Disponibility = '1'");
  } else if ($emaitza2 > 0) {
    $kaixo = mysqli_query($link, "select * from bookings where Date = '$date' and Hour= '$time' and Cabin_Id ='$cabin'"); //comprueba si existe alguna reserva con esa fecha
    $ilara = mysqli_num_rows($kaixo);

    if ($ilara > 0) {
      //echo "<script> document.getElementById('status_button').innerHTML = 'The dates are not avaliable' </script>"; //si alguna fecha existe salta error
      echo '<script type="text/javascript">alert("The dates are not avaliable");</script>';
      header("Location: ./Bookings.php");
    } else {

      //CABIN CALCULO



      //TOTAL_PRICE CALCULO
      $price = mysqli_query($link, "select * from vehicles where Type = '$type'");
      $row = mysqli_fetch_assoc($price);
      //Horas de trabajo a pagar en caso de necesitar ayuda
      if ($help == 'yes') {
        $worker_hours = $hours * 15;
      } else if ($help == 'no') {
        $worker_hours = 0;
      }
      $worker_hours = 0;
      $total_price = ((float)$row['Price_Hour'] * (int)$hours + (float)$worker_hours);


      //Bookings_Id al ser AUTO_INCREMENT hay que dejarlo vacío
      //Cuidado con el NULL ha dado problemas
      if ($help == 'yes') {
        $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', '44444444F' , '$hours', '$total_price')");
        echo "<script> document.getElementById('status_button').innerHTML = 'Saved!' </script>";
      } else if ($help == 'no') {
        $result = mysqli_query($link, "insert into bookings values ('','$sesioa','$cabin','$date', '$time', '$type', '$help', NULL, '$hours', '$total_price')");
        echo "<script> document.getElementById('status_button').innerHTML = 'Saved!' </script>";
      }

      mysqli_close($link);
      header("Location: ./Bookings.php");
    }
  }
}
?>