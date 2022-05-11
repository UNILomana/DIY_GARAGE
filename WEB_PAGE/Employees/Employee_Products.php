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
    <title>Products of the shop</title>
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
include("../connect_db.php");
$link = connectDataBase();
$email = $_SESSION["Email"];
$name = $_SESSION["Name"];
$surname = $_SESSION["Surname"];
$result = mysqli_query($link, "select * from products");
?>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./employees_web.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="mr-5"><a href='./GarageAvailability.php'>Garage Availability</a></li>
                    <li class="mr-5"> <a href='./ListBookingsForEmployees.php'>List of Bookings</a></li>
                </ul>
                <button id='MyProfile' class="btn btn-outline-warning" type="button">MyProfile</button>
            </div>
        </div>
    </nav>

    <!--MYPROFILE CARD-->
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
                    <button class="btn btn-secondary"><a style='text-decoration:none; color:white' href='../Logins/PHP_InOut.php?logout=yes'>Log Out</a></button>
                </div>
            </div>
        </div>
    </div>

    <!--Main body-->
    <div class="row container mt-5 mx-auto">
        <h5>Products list</h5>
        <div class="col-md-6">
            <table>
                <tr>
                    <th scope="col">&nbsp;Product_Id</th>
                    <th scope="col">&nbsp;Name</th>
                    <th scope="col">&nbsp;Price</th>
                    <th scope="col">&nbsp;Stock</th>
                </tr>
                <?php
                while ($erregistroa = mysqli_fetch_array($result)) {
                    $argazki_helbidea = $erregistroa["Product_picture"];
                    printf(
                        "<tr>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td><img src='$argazki_helbidea' width='50' height='50'></td>
                                <td>
                                    <a href='./PHP_Employees.php?produktua=%s'> 
                                        <img src='..//Images/icon.png' width=30px>
                                    </a>
                                </td>

                            </tr>",
                        $erregistroa["Product_Id"],
                        $erregistroa["Name"],
                        $erregistroa["Price"],
                        $erregistroa["Stock"],
                        $erregistroa["Product_Id"]
                    );
                }
                ?>
            </table>
        </div>
        <div class="col-md-6">
            <button id='addProduct' class="btn btn-outline-warning">Add Product</button>

            <div id='productuberria' style="display: none">
                <form method="POST" action="PHP_Employees.php" enctype="multipart/form-data">
                    <h5 class="mt-2">New Product</h5>
                    <input type="text" class="mt-2" name="product_name"  placeholder="Name" required /> </br>
                    <input type="text" class="mt-2" name="product_price" placeholder="Unit price" pattern="[+-]?([0-9]*[.])?[0-9]+" min="1" required /> </br>
                    <input type="text" class="mt-2" name="product_stock" placeholder="Stock" pattern="[0-9]+" min="1" max="1000" required /> </br>
                    <input type="file" class="mt-2" name="argazkia" class="col-sm-8"  accept="image/png, image/jpeg"  required></br>
                    <input type="submit" class="mt-2" value="ADD" name="newproduct" />
                </form>
            </div>
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

        $('button#addProduct').click(function() {
            $("#productuberria").fadeToggle('slow');
        })
        
    })
</script>