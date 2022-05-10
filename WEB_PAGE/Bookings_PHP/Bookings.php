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
    <div id='booking-card-body' class="card col-6 mx-auto text-white">
        <div class="row card-body mt-2">
            <h5 class="card-title">New Booking</h5>

            <form method="POST" action="./PHP_Bookings.php">
                <!--id="newbooking" name="newbooking"-->
                <div class="form-group">
                    <input type="date" name="data" min="<?php echo date("Y-m-d"); ?>" required></br>
                    <!--NOT PAST DATES-->
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
                </div>

                <div class="form-group">
                    <label>Select your vehicle:</label>
                    <div class="form-check">
                        <input type="radio" name="vehicles" value="Cars" required> Car </input></br>
                        <input type="radio" name="vehicles" value="Motorbikes"> Motorbike </input></br>
                        <input type="radio" name="vehicles" value="Big vehicles"> Big vehicle </input></br>
                    </div>
                </div>

                <div class="form-group">
                    <label>Do you need help?</label>
                    <div class="form-check">
                        <input type="radio" name="yes_no" value="yes"> Yes </input></br>
                        <input type="radio" name="yes_no" value="no"> No </input></br>
                    </div>
                </div>

                <p id='status_button'></p>
                <!--Shows if saved-->
                <input type="submit" value="Book" name="insert_book" />
            </form>
        </div>
    </div>

    <!--If is an error on the booking-->
    <?php
        if (isset($_GET['incorrect'])) {
            if ($_GET['incorrect']  == 'yes') {
                echo "<script>document.getElementById('status_button').innerHTML = 'This date is not available!' </script>";
            }
            if ($_GET['incorrect'] == 'no'){
                echo "<script>document.getElementById('status_button').innerHTML = 'Saved!' </script>";
            }
        }
    ?>

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