<!DOCTYPE html>
<html>

<head>
    <title>IÑT GARAGE</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./Images/page2.png">
    <link rel="stylesheet" href="./Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <!---NAVBAR-->
    <nav class="navbar navbar-expand-lg cstm-bg py-2 justify-content-center">
        <div class="col-4 text-center">
            <a class="navbar-brand" href="index.php"><img src="./Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
        </div>
        <div class="col-4">
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <ul class="navbar-nav navbar-hover me-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href="./Products_PHP/Products_Unloged.php">Products</a></ul>
                <ul class="navbar-nav navbar-hover mx-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href="./contact_php/contact.php">Contact</a></ul>
            </div>
        </div>
        <div class="col-4 text-center">
            <p class="text-danger" id="login_text"></p>
            <button id='Login' class="mx-auto btn btn-outline-dark" type="button">Login</button>
        </div>
    </nav>


    <!--LOGIN CARD-->

    <div id='card' class="ms-auto">
        <div id='card-body' class="card">
            <div class="card-body cscard-bg">
                <h5 class="card-title">Login</h5>
                <form action='./Logins/PHP_InOut.php' method="POST">
                    <label>Email:</label></br>
                    <input style='width:95%;' type='email' name='email' id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="this.setCustomValidity('Use a valid format. Example: pedro@gmail.com')" />
                    <label>Password:</label></br>
                    <input style='width:95%;' type='password' id='pasahitza' name='password' />
                    <input type="checkbox" onclick="showPass()">Show Password </br>
                    <input type="submit" name="sartu" class="mt-3 btn btn-secondary" value='Entry'>
                    <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
                </form>

                <a class="btn btn-secondary mt-3" href="./Logins/register.php">Register</a>
            </div>
        </div>
    </div>


    <div class="container mt-5 text-center">
        <h2>Welcome to DIY garage </h2>
        <br>
        <h3>The garage for all your car and mechanical problems</h3>
        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./Images/garagecarousel.png" class="d-block w-70" style="height: 500px; width: 1000px;" alt="1">
                </div>
                <div class="carousel-item">
                    <img src="./Images/ferrari.jpeg" class="d-block w-70" style="height: 500px; width: 1000px;" alt="2">
                </div>
                <div class="carousel-item">
                    <img src="./Images/moto2.jpg " class="d-block w-70" style="height: 500px; width: 1000px;" alt="3">
                </div>
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <p class="mt-3">On this website you can make reservations, buy products for the car, and so you can change all kinds of components of the car without any problem. </br>
            We offer you the place and the tools to do it and you do everything else.</br>
            In case you need help, our experts will be on site to help and advise you.</p>
    </div>


    <!--FOOTER-->
    <div class="cstm-bg d-flex justify-content-around p-3">
        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="./Products_PHP/Products_Unloged.php">Products</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="./contact_php/contact.php">Contact</a>
        </div>

        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="#"><i class="fa fa-phone"></i> 34-12345678</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="#"><i class="fa fa-envelope"></i> diygarage@gmail.com</a>
        </div>

        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="#"><i class="fa fa-instagram"></i> Instagram</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="#"><i class="fa fa-facebook"></i> Facebook</a>
        </div>
    </div>

</body>

</html>

<?php
if (isset($_GET['incorrect'])) {
    if ($_GET['incorrect']  == 'yes') {
        echo "<script>document.getElementById('login_text').innerHTML = 'Incorrect username or password please try again' </script>";
    }
}
?>

<!--JQuery Script abrir pestaña login-->
<script>
    $(document).ready(function() {

        $('button#Login').click(function() {
            $("#card").fadeToggle('slow');
        })

        $('#cancel').click(function() {
            $('#card').fadeToggle('slow');
        })
    })

    function showPass() {
        var x = document.getElementById("pasahitza");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>