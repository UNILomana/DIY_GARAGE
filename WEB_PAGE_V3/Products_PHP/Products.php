<?php 
//Control de sesion iniciada
//Discomment the next line not showing the errors. No se mostrara ningun error
//error_reporting(error_reporting() & ~E_NOTICE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!$_SESSION["Email"] || $_SESSION["Password"] == null){
    
	echo "<html> <marquee><h1>You don't have permission to load this page.<h1></marquee><html>";
	die();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
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
//session_start();
//include("../connect_db.php");
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
                    <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='../Bookings_PHP/MyBookings.php'>My Bookings</a></button>
                    <button class="btn btn-info mt-2"><a style='text-decoration:none; color:black' href='./MyPurchases.php'>My Purchases</a></button></br>
                    <button class="btn btn-secondary mt-2"><a style='text-decoration:none; color:white' href='../Logins/PHP_InOut.php?logout=yes'>Log Out</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--BOOKING FORM-->
    <?php
    //include("../connect_db.php");
    $link = connectDataBase();
    $result = mysqli_query($link, "select * from products");
    ?>

    <div id='booking-card-body' class="col-6 mx-auto card text-white">
        <div class="card-body row mt-2">
            <h5 class="card-title">Products list</h5>
            <table>
                <tr>
                    <th scope="col">&nbsp;Product_Id</th>
                    <th scope="col">&nbsp;Name</th>
                    <th scope="col">&nbsp;Price</th>
                    <th scope="col">&nbsp;Stock</th>
                </tr>
                <?php
                while ($erregistroa = mysqli_fetch_array($result)) {
                    printf(
                        "<tr>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                            </tr>",
                        $erregistroa["Product_Id"],
                        $erregistroa["Name"],
                        $erregistroa["Price"],
                        $erregistroa["Stock"]
                    );
                }
                // mysqli_free_result($result);
                //mysqli_close($link);
                ?>
            </table>

            <form id="newbooking" name="newbooking" method="POST" action="PHP_Purchase.php">
                <h1>Buy Product</h1>
                <div class="form-group">
                    <?php
                    $result = mysqli_query($link, "select * from products");

                    echo '<select name="products">';
                    while ($erregistroa = mysqli_fetch_array($result)) {
                        echo '<option value="' . $erregistroa['Product_Id'] . '">' . $erregistroa['Name'] . '</option>';
                    }
                    echo '</select></br>';
                    mysqli_free_result($result);
                    mysqli_close($link);
                    ?>
                </div>
                <input type="text" pattern="[0-9]+" name="zenbatekoa" placeholder="Quantity" min="1" required />
                <input type="submit" id="newbookings" value="Erosi" name="getpurchase" />
            </form>
            <a href="./MyPurchases.php"><input type="button" value="MyPurchases"></a>

        </div>
    </div>

    <?php
    //ondo erosi baldin bada mezua azaldu
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