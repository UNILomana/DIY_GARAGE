<!DOCTYPE html>
<html>
<?php 
	include("../connect_db.php");
	$link = connectDataBase();
	$result = mysqli_query($link, "select * from products");
?>
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
                    <li><a href="../contact.php">Contact us</a></li>
                    
                </ul>
                <button id='Login' class="btn btn-outline-warning" type="button">Login</button>
            </div>
        </div>
    </nav>

    <!--LOGIN CARD-->
    <div class="row">
        <div id='card' class="ms-auto">
            <div id='card-body' class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action='./Logins/PHP_InOut.php' method="POST">
                        <label>Email:</label></br>
                        <input style='width:95%;' type='email' name='email' id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" oninvalid="this.setCustomValidity('Use a valid format. Example: pedro@gmail.com')"/>
                        <label>Password:</label></br>
                        <input style='width:95%;' type='password' id='pasahitza' name='password' />
                        <input type="checkbox" onclick="showPass()">Show Password </br>
                        <input type="submit" name="sartu" class="mt-3 btn btn-secondary" value='Entry'>
                        <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
                    </form>

                    <a class="btn btn-outline-warning mt-3" href="./Logins/register.php">Register</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
		<div class="row">
			<?php
			while ($erregistroa = mysqli_fetch_array($result)){
				$argazki_helbidea = $erregistroa["Product_picture"];
				printf(
					"<div class= 'col-sm-3'>
						<img src='$argazki_helbidea' width='150px' height='150px'></img>
						<p>&nbsp;%s&nbsp;</p>
						<p>&nbsp;%s&nbsp;€</p>
					</div>",
					$erregistroa["Name"],
					$erregistroa["Price"]
				);
			};
			?>
		</div>
    </div>

</body>


<!--Script abrir pestaña login-->
<script>
    $(document).ready(function() {

        $('button#Login').click(function() {
            $("#card").fadeToggle('slow');
        })

        $('#cancel').click(function() {
            $('#card').fadeToggle('slow');
        })
    })
</script>

<!--PHP FOR LOGIN-->
<?php /*
include("./connect_db.php");
$link = connectDataBase();
if (isset($_POST['email'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $result_users = mysqli_query($link, "select * from users 
                                        where Email='$email' 
                                        and Password = '$password'");
    $result_employees = mysqli_query($link, "select * from employees 
                                        where Email='$email' 
                                        and Password = '$password'");

    if (mysqli_num_rows($result_users) == 0 && mysqli_num_rows($result_employees) == 0) {
        echo "<script>alert('Incorrect username or password please try again');</script>";
    }
    /*FOR USERS*/ /*else if ($erregistroa = mysqli_fetch_array($result_users)) {
        if ($email = $erregistroa['Email'] & $password = $erregistroa['Password']) {

            session_start();

            //guardamos en variables de session los datos que utilizaremos a lo largo de la sesion:
            $email = $erregistroa['Email'];
            $_SESSION["Email"] = $erregistroa['Email'];
            $_SESSION["Name"] = $erregistroa['Name'];
            $_SESSION["Surname"] = $erregistroa['Surname'];
            $_SESSION["TLF"] = $erregistroa['TLF'];
            $_SESSION["Password"] = $erregistroa['Password'];
            $_SESSION["User_Id"] = $erregistroa['User_Id'];

            echo "<script>alert('Welcome to the system " . $_SESSION["Name"] . "');</script>";
            header("Location: ./Users/users_web.php");
        }
    }
    /*FOR EMPLOYEES*//* else if ($erregistroa = mysqli_fetch_array($result_employees)) {
        if ($email = $erregistroa['Email'] & $password = $erregistroa['Password']) {

            session_start();
            $email = $erregistroa['Email'];
            $_SESSION["Email"] = $erregistroa['Email'];
            $_SESSION["Name"] = $erregistroa['Name'];
            $_SESSION["Surname"] = $erregistroa['Surname'];
            $_SESSION["TLF"] = $erregistroa['TLF'];
            $_SESSION["Password"] = $erregistroa['Password'];
            $_SESSION["Employee_Id"] = $erregistroa['Employee_Id'];

            echo "<script>alert('Welcome to the system " . $_SESSION["Name"] . "');</script>";
            header("Location: ./Employees/employees_web.php");
        }
    }
}*/
?>

</html>