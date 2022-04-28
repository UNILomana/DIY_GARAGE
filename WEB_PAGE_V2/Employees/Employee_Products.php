<!DOCTYPE html>
<html>

<head>
    <!--LINK-s de referencia Jquery, Boostrap, css CUIDAR los link y versiones-->
    <title>Employees</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php
session_start();
include("../connect_db.php");
$link = connectDataBase();
$email = $_SESSION["Email"];
$name = $_SESSION["Name"];
$surname = $_SESSION["Surname"];
$result = mysqli_query($link, "select * from products");
?>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="Home.html"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="mr-5"> <a href="./employees_web.php">Home</a></li>
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
    <div class="container mt-5">
        
        <!--Select-a-->
        <H1>Products list</H1>

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

        <button id='addProduct' class="btn btn-outline-warning" type="button">Add Product</button>
        
        <div id='productuberria' style="display: none">
            <form id="newproduct" name="newproduct" method="POST" action="PHP_Employees.php">
                <h1>New Product</h1>
                <input type="text" name="product_name" placeholder="Name" min="1" required /> </br>
                <input type="text" pattern="[+-]?([0-9]*[.])?[0-9]+" name="product_price" placeholder="Unit price" min="1" required /> </br>
                <input type="text" pattern="[0-9]+" name="product_stock" placeholder="Stock" min="1" required /> </br>
                <input type="submit" id="newproduct" value="ADD" name="newproduct"/>
            </form>
        </div>
        </br>
        
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