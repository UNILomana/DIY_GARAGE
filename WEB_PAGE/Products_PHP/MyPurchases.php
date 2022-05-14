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
    <title>My purchases List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Images/page2.png">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>


<?php
//session_start();
include("../connect_db.php");
$link = connectDataBase();
$email = $_SESSION["Email"];
$name = $_SESSION["Name"];
$surname = $_SESSION["Surname"];
$sesioa = $_SESSION['User_Id'];

/*Navbar Photo*/
$emaitza = mysqli_query($link, "select * from users where User_Id='$sesioa'");
$erregistroa = mysqli_fetch_array($emaitza);
if ($erregistroa["Profile_Img"] == NULL) {
    $argazki_helbidea = '../Images/Clients/none.png';
} else {
    $argazki_helbidea = $erregistroa["Profile_Img"];
}
?>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md cstm-bg py-2 justify-content-center">
        <div class="col-4 text-center">
            <a class="navbar-brand" href="../Users/users_web.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
        </div>
        <div class="col-4">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <ul class="navbar-nav navbar-hover me-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href="../Products_PHP/Products.php">Products</a></ul>
                <ul class="navbar-nav navbar-hover mx-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href="../Bookings_PHP/Bookings.php">Bookings</a></ul>
            </div>
        </div>
        <div class="col-4 text-center">
            <p class="me-3 text-danger" id="login_text"></p>
            <button id='MyProfile' class="btn " type="button">
                <img src="<?php printf($argazki_helbidea); ?>" alt="Logo" style="width:75px; height: 75px;" class="rounded-pill">
            </button>
        </div>
    </nav>

    <!--LOGIN CARD-->

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
                <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='../Bookings_PHP/MyBookings.php'>My Bookings</a></button>
                <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='./MyPurchases.php'>My Purchases</a></button></br>
                <button class="btn btn-secondary mt-2"><a style='text-decoration:none; color:white' href='../Logins/PHP_InOut.php?logout=yes'>Log Out</a></button>
                <button class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#photoModal">Change photo</button>
            </div>
        </div>
    </div>


    <!-- Photo Modal  -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Choose a photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="../Users/PHP_photo.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label>Select the photo to change:</label></br>
                        <input type="file" class="mt-2" name="profilephoto" class="col-sm-8" accept="image/png, image/jpeg" required></br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save" name="changephoto" /></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--MYPURCHASES CARD-->
    <div id='booking-card-body' class="col-6 mx-auto card text-white">
        <div class="card-body row mt-2">

            <h5>Your Purchases list</h5>
            <?php
            $sesioa = $_SESSION['User_Id'];
            $link = connectDataBase();
            $result = mysqli_query($link, "select * from purchase where User_Id = '$sesioa'");
            ?>
            <table>
                <tr>
                    <th scope="col">&nbsp;Purchase Id</th>
                    <th scope="col">&nbsp;Product Id</th>
                    <th scope="col">&nbsp;Quantity</th>
                    <th scope="col">&nbsp;Date</th>
                    <th scope="col">&nbsp;Total Price</th>
                </tr>
                <?php
                while ($erregistroa = mysqli_fetch_array($result)) {
                    printf(
                        "<tr>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>
                                    <a href='PHP_Purchase.php?erosketa=%s'> 
                                        <img src='..//Images/icon.png' width=30px>
                                    </a>
                                </td>
                            </tr>",
                        $erregistroa["Purchase_Id"],
                        $erregistroa["Product_Id"],
                        $erregistroa["Quantity"],
                        $erregistroa["Date"],
                        $erregistroa["Total_Price"],
                        $erregistroa["Purchase_Id"]
                    );
                }
                mysqli_free_result($result);
                mysqli_close($link);
                ?>
            </table>
        </div>
    </div>

    <!--FOOTER-->
    <div class="cstm-bg d-flex justify-content-around p-3 mt-5">
        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="../Products_PHP/Products.php">Products</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="../Bookings_PHP/Bookings.php">Bookings</a>
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