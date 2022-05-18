<!DOCTYPE html>
<html>

<head>
    <title>Register Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Images/page2.png">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md cstm-bg py-2 justify-content-center">
        <div class="col-4 text-center">
            <a class="navbar-brand" href="../index.php"><img src="../Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4 text-center">
        </div>
    </nav>



    <!--REGISTER FORM-->
    <div id='register-card-body' class="col-6 mx-auto card">
        <div class="card-body row ">
            <h5 class="card-title">Register</h5>
            <form class="col-xl-5 boxr mt-4 mb-4" id="registro" name="registro" method="POST" action="./register.php">
                <i id='register-icon' class="fa fa-user"></i>
                <input type="text" name="name" placeholder="Name" required pattern="[A-Za-zÀ-ÿ\s]*" title="You must enter only letters."></br>
                <i id='register-icon' class="fa fa-user"></i>
                <input type="text" name="apellido" placeholder="Surname" required pattern="[A-Za-zÀ-ÿ\s]*" title="You must enter only letters."></br>
                <i id='register-icon' class="fa fa-id-card"></i>
                <input type="text" name="dni" placeholder="ID card" required pattern="^[0-9]{8,8}[A-Z]$" title="The format must be 8 digits and one letter."></br>
                <i id='register-icon' class="fa fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" oninvalid="this.setCustomValidity('Use a valid format. Example: pedro@gmail.com')"> </br>
                <i id='register-icon' class="fa fa-lock"></i>
                <input type="password" id="password" placeholder="Password" name="password" minlength="8" required> </br>
                <i id='register-icon' class="fa fa-lock"></i>
                <input type="password" id="passwordrep" placeholder="Repeat password" name="password" minlength="8" required> </br>
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

    
    <!--FOOTER-->
    <div class="cstm-bg d-flex justify-content-around mt-5 p-3">
        <div class="d-flex flex-column">
            <a class="footer-hover text-decoration-none text-dark p-2" href="../Products_Unloged.php">Products</a>
            <a class="footer-hover text-decoration-none text-dark p-2" href="../contact_php/contact.php">Contact</a>
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


    <?php
    include("../connect_db.php");
    $link = connectDataBase();

    if (isset($_POST['email'])) {
        $result = $link->prepare("insert into users values (? , ? , ? , ? , ? , ? , ?)");
        $result->bind_param("sssssss", $dni, $name, $surname, $TLF, $email, $password, $profile_photo);

        $dni = $_POST["dni"];
        $name = $_POST["name"];
        $surname = $_POST["apellido"];
        $TLF = $_POST["TLF"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $profile_photo = '';

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
            $result->execute();
            echo "<script> document.getElementById('status_button').innerHTML = 'Saved!' </script>";
        }
        $result->close();
        $link->close();
    }
    ?>
</body>

</html>

<script>
    $("#registro").submit(function() {
        if ($("#password").val() != $("#passwordrep").val()) {
            alert("The passwords must match");
            return false;
        }
    })
</script>