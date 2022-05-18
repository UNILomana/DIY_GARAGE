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
    <!--LINK-s de referencia Jquery, Boostrap, css CUIDAR los link y versiones-->
    <title>Employees Web Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Images/page2.png">
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
    <nav class="navbar navbar-expand-md cstm-bg py-2 justify-content-center">
        <div class="col-4 text-center">
            <a class="navbar-brand" href="./employees_web.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
        </div>
        <div class="col-4">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <ul class="navbar-nav navbar-hover me-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href='./Employee_Products.php'>Products managment</a></ul>
                <ul class="navbar-nav navbar-hover me-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href='./ListBookingsForEmployees.php'>List of Bookings</a></ul>
            </div>
        </div>
        <div class="col-4 text-center">
            <p class="me-3 text-danger" id="login_text"></p>
            <button id='MyProfile' class="btn btn-outline-dark" type="button">MyProfile</button>
        </div>
    </nav>

    <!--MYPROFILE CARD-->

    <div id='card' class="ms-auto">
        <div id='card-body' class="card ">
            <div class="card-body cscard-bg">
                <h5 class="card-title">My Profile</h5>
                <form action='index.php' method="POST">
                    <p>Email: <?php printf($email); ?> </p>
                    <p>Name: <?php printf($name);
                                printf(' ');
                                printf($surname); ?></p>
                </form>
                <button class="btn btn-secondary"><a style='text-decoration:none; color:white' href='../Logins/PHP_InOut.php?logout=yes'>Log Out</a></button>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <h1>Employees Page</h1>
        <p>This page is dedicated to employees. Where you can add <b>new products</b> to the shop so that customers can buy them, and delete a product that is no longer available. </br>
        In the reservations tab you can view <b>all reservations</b> made by customers with all the information, you can also view only <b>today's reservations</b>.</p>
        <div class="row mt-5">
            <a href='../Employees/Employee_Products.php' class="col-md-5 me-auto text-decoration-none">
                <div class="card text-center justify-content-center" id="card_bookings" style='height:200px;'>
                    <h5 class="card-title">Products managment</h5>
                </div>
            </a>
            <a href='../Employees/ListBookingsForEmployees.php' class="col-md-5 mx-auto text-decoration-none">
                <div class="card text-center justify-content-center" id="card_products" style='height:200px;'>
                    <h5 class="card-title">List of Bookings</h5>
                </div>
            </a>
        </div>
    </div>

    <!--FOOTER-->
    <div class="cstm-bg d-flex justify-content-around p-3 mt-5">
        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="../Employees/Employee_Products.php">Products Management</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="../Employees/ListBookingsForEmployees.php">List of Bookings</a>
        </div>

        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="tel:123-456-7890"><i class="fa fa-phone"></i> 34-12345678</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="mailto:diygarage@gmail.com"><i class="fa fa-envelope"></i> diygarage@gmail.com</a>
        </div>

        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" target=”_blank” href="https://www.instagram.com/"><i class="fa fa-instagram"></i> Instagram</a>
            <a class="footer-hover text-decoration-none text-dark p-2" target=”_blank” href="https://www.facebook.com/"><i class="fa fa-facebook"></i> Facebook</a>
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