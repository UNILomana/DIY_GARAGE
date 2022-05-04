<?php
//Control de sesion iniciada
//Discomment the next line not showing the errors. No se mostrara ningun error
//error_reporting(error_reporting() & ~E_NOTICE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION["Email"] || $_SESSION["Password"] == null) {

    echo "<html> <marquee><h1>You don't have permission to load this page.<h1></marquee><html>";
    die();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking FORM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<!--Datos de perfil para Usuario-->
<?php
include("../connect_db.php");
$link = connectDataBase();
$email = $_SESSION["Email"];
$name = $_SESSION["Name"];
$surname = $_SESSION["Surname"];
?>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Users/users_web.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="mr-5"><a href="../Bookings_PHP/Bookings.php">Bookings</a></li>
                    <li><a href="../Products_PHP/Products.php">Products</a></li>
                </ul>
                <button id='MyProfile' class="btn btn-outline-warning" type="button">MyProfile</button>
            </div>
        </div>
    </nav>

    <!--LOGIN CARD-->
    <div class="row">
        <div id='card' class="ms-auto">
            <div id='card-body' class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
                    <form action='index.php' method="POST">
                        <p>Email: <?php printf($email); ?> </p>
                        <p>Name: <?php printf($name);
                                    printf(' ');
                                    printf($surname); ?></p>
                    </form>
                    <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='./MyBookings.php'>My Bookings</a></button>
                    <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='../Products_PHP/MyPurchases.php'>My Purchases</a></button></br>
                    <button class="btn btn-secondary mt-2"><a style='text-decoration:none; color:white' href='../Logins/PHP_InOut.php?logout=yes'>Log Out</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--BOOKING FORM-->

    <div id='booking-card-body' class="col-6 mx-auto card text-white">
        <div class="card-body row mt-2">
            <h5 class="card-title">New Booking</h5>
            <table>
                <tr>
                    <th scope="col">&nbsp;Cabin_Id</th>
                    <th scope="col">&nbsp;Disponibility</th>
                </tr>
                <?php
                //include("../connect_db.php"); //Kontuz len deklaratua dago
                $link = connectDataBase();
                $result = mysqli_query($link, "select * from cabins");

                /*Kontuz imagenen src-arekin*/
                while ($erregistroa = mysqli_fetch_array($result)) {
                    if ($erregistroa["Disponibility"] == '1') {
                        printf(
                            "<tr>
                        <td>&nbsp;%s&nbsp;</td>
                        <td>
                            <img src='../Images/Available.png' width=30px>    
                        </td>
                    </tr>",
                            $erregistroa["Cabin_Id"],
                        );
                    } else if ($erregistroa["Disponibility"] == '0') {
                        printf(
                            "<tr>
                            <td>&nbsp;%s&nbsp;</td>
                            <td>
                                <img src='../Images/Forbidden.png' width=30px>     
                            </td>
                        </tr>",
                            $erregistroa["Cabin_Id"],
                        );
                    }
                }
                mysqli_free_result($result);
                mysqli_close($link);
                ?>
            </table>
            <form id="newbooking" name="newbooking" method="POST" action="./PHP_Bookings.php">
                <h1>New Booking</h1>

                <div class="form-group">
                    <input type="date" name="data" min="<?php echo date("Y-m-d"); ?>" required></br>
                    <!--NOT PAST DATES
                    <input type="time" name="ordua" min="09:00" max="18:00" step="3600" required></br>-->
                    <select name="ordua">
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                    <!--Hay errores aqui porque no se puede elegir solo las horas-->
                    <div class="form-group">
                        <label>Select vehicle:</label> *
                        <div class="form-check">
                            <input type="radio" name="vehicles" value="Cars" required> Cars </input></br>
                            <input type="radio" name="vehicles" value="Motorbikes"> Motorbikes </input></br>
                            <input type="radio" name="vehicles" value="Big vehicles"> Big vehicles </input></br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Do you need help?</label>
                        <div class="form-check">
                            <input type="radio" name="yes_no" value="yes"> Yes </input></br>
                            <input type="radio" name="yes_no" value="no"> No </input></br>
                        </div>
                    </div>
                    <label>Use hours:</label>
                    <input type="number" name="use_hours" placeholder="Hours" min='1' max='8' required></br>

                </div>
                <p id='status_button' class='button'> kaka!!</p>
                <!--Shows if saved-->
                <input type="submit" id="newbookings" value="book" name="insert_book" />
                <a href="./MyBookings.php"><input type="button" value="MyBookings"></a>

            </form>
        </div>
    </div>

</body>

</html>

<!--Script abrir pestaña MyProfile-->
<script>
    $(document).ready(function() {

        $('button#MyProfile').click(function() {
            $("#card").fadeToggle('slow');
        })

        $('#cancel').click(function() {
            $('#card').hide();
        })
    })
</script>