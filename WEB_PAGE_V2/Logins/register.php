<!DOCTYPE html>
<html>

<head>
    <title>DIY GARAGE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li><a href="../index.php">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!--LOGIN CARD-->
    <div class="row">
        <div id='card' class="ms-auto">
            <div id='card-body' class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action='index.php' method="POST">
                        <p>Email:</p>
                        <input style='width:95%;' type='text' name='email' />
                        <p>Password:</p>
                        <input style='width:95%;' type='password' name='password' /> </br>
                        <input type="submit" class=" mt-3 btn btn-secondary" value='Entry'>
                        <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
                    </form>
                    <a class="btn btn-outline-warning " href="./Logins/register.php">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!--REGISTER FORM--> <!--Deja registrarse como 'iker.fer@gmail' -->
    <div class="row">
        <div id='register-card-body' class="col-6 mx-auto card text-white">
            <div class="card-body row ">
                <h5 class="card-title">Register</h5>
                <form class="col-xl-5 boxr mt-4 mb-4" id="registro" name="registro" method="POST" action="register.php">
                    <i id='register-icon' class="fa fa-user"></i>
                    <input type="text" name="name" placeholder="Name" required pattern="[A-Za-z]*" title="You must enter only letters."></br>
                    <i id='register-icon' class="fa fa-user"></i>
                    <input type="text" name="apellido" placeholder="Surname" required pattern="[A-Za-z]*" title="You must enter only letters."></br>
                    <i id='register-icon' class="fa fa-id-card"></i>
                    <input type="text" name="dni" placeholder="ID card" required pattern="^[0-9]{8,8}[A-Za-z]$" title="The format must be 8 digits and one letter."></br>
                    <i id='register-icon' class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required> </br>
                    <!--ONDO IPINI-->
                    <i id='register-icon' class="fa fa-lock"></i>
                    <input type="password" id="password" placeholder="Password" name="password" minlength="6" required> </br>
                    <i id='register-icon' class="fa fa-lock"></i>
                    <input type="password" id="passwordrep" placeholder="Repeat password" name="password" minlength="6" required> </br>
                    <i id='register-icon' class="fa fa-phone"></i>
                    <input type="int" name="TLF" placeholder="TLF"> </br>
                    <input type="submit" value='Register'>
                    <p id='status_button' class='button'></p>
                    <!--Shows if saved-->
                </form>
                <div class="col-lg-7">
                    <img src="../Images/pic-register.svg">
                </div>
                <a href="../index.php">Go to login</a>
            </div>
        </div>
    </div>

    <?php
    include("../connect_db.php");
    $link = connectDataBase();

    if (isset($_POST['email'])) {  //recogemos los datos del formulario
        $name = $_POST["name"];
        $surname = $_POST["apellido"];
        $dni = $_POST["dni"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $TLF = $_POST["TLF"];

        //VALIDACIÓN DE EMAIL
        $sqlEmail = "select * from users where email= '$email'";
        $resultEmail = mysqli_query($link, $sqlEmail);

        //VALIDACIÓN DE DNI
        $sqlID = "select * from users where User_Id= '$dni'";
        $resultID = mysqli_query($link, $sqlID);

        if (mysqli_num_rows($resultEmail) > 0) {
            $email_error = "Sorry... email already taken";
            echo "<script> document.getElementById('status_button').innerHTML = '$email_error' </script>";
        } else if (mysqli_num_rows($resultID) > 0) {
            $dni_error = "Sorry... ID card already taken";
            echo "<script> document.getElementById('status_button').innerHTML = '$dni_error' </script>";
        } else {
            $query = mysqli_query($link, "insert into users values ('$dni','$name','$surname','$TLF', '$email', '$password', '')");

            echo "<script> document.getElementById('status_button').innerHTML = 'Saved!' </script>";
        }
    }
    ?>

    <script>
        // validación de registro, comprueba contraseña

        $("#registro").submit(function() {

            if ($("#password").val() != $("#passwordrep").val()) {
                alert("The passwords must match");
                return false;
            }
        })
        $("#registro").submit(function() {

            if ($("#password").val() != $("#passwordrep").val()) {
                alert("The passwords must match");
                return false;
            }
        })
    </script>
</body>

</html>