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
    <!--LINK-s de referencia Jquery, Boostrap, css CUIDAR los link y versiones-->
    <title>List of bookings</title>
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
?>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./employees_web.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="mr-5"><a href='./Employee_Products.php'>Products managment</a></li>
                    <li class="mr-5"><a href='./GarageAvailability.php'>Garage Availability</a></li>
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
    <div class="container mt-5 table-responsive-xl">
        <H1>Booking list for employees</H1>
        <form method="post">
            <input type="submit" name="todayList" value="Today´s bookings" />
            <input type="submit" name="allList" value="All bookings" />
        </form>
        <table>
            <tr>
                <th scope="col">&nbsp;Booking_Id</th>
                <th scope="col">&nbsp;User_Id</th>
                <th scope="col">&nbsp;Cabin_Id</th>
                <th scope="col">&nbsp;Date</th>
                <th scope="col">&nbsp;Hour</th>
                <th scope="col">&nbsp;Type of vehicle</th>
                <th scope="col">&nbsp;Employee Help</th>
            </tr>
            <?php
            /*Botoia sakatu ezkero bata edo bestea agertzen da. Funtzioetan gordeta daude*/
            if (array_key_exists('todayList', $_POST)) {
                gaurkoLista();
            } else if (array_key_exists('allList', $_POST)) {
                totalList();
            } else {
                gaurkoLista(); //directamente gaurko lista agertzeko
            }

            function gaurkoLista()
            {
                $link = connectDataBase();
                $result = mysqli_query($link, "select * from bookings");
                $gaur = date("Y-m-d"); //date erabiliz urtea-hilabetea-eguna gordetzen dira 
                echo  'Date= ', $gaur;
                while ($erregistroa = mysqli_fetch_array($result)) {
                    if ($erregistroa["Date"] == $gaur) { //DB-ko Date eremua berdina bada $gaur-ekin imprimatzen dira
                        printf(
                            "<tr>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                </tr>",
                            $erregistroa["Booking_Id"],
                            $erregistroa["User_Id"],
                            $erregistroa["Cabin_Id"],
                            $erregistroa["Date"],
                            $erregistroa["Hour"],
                            $erregistroa["Vehicle_Type"],
                            $erregistroa["Employee_Help"],
                        );
                    }
                }
                mysqli_free_result($result);
                mysqli_close($link);
            }
            function totalList()
            {

                $link = connectDataBase();
                $result = mysqli_query($link, "select * from bookings");

                while ($erregistroa = mysqli_fetch_array($result)) {

                    printf(
                        "<tr>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                    <td>&nbsp;%s&nbsp;</td>
                                </tr>",
                        $erregistroa["Booking_Id"],
                        $erregistroa["User_Id"],
                        $erregistroa["Cabin_Id"],
                        $erregistroa["Date"],
                        $erregistroa["Hour"],
                        $erregistroa["Vehicle_Type"],
                        $erregistroa["Employee_Help"],
                    );
                }
                mysqli_free_result($result);
                mysqli_close($link);
            }
            ?>
        </table>
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