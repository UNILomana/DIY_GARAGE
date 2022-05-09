<!DOCTYPE html>
<html>

<head>
    <title>DIY GARAGE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Styles/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!---NAVBAR-->
    <nav class="navbar navbar-expand-md  navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="./Images/Logo.png" alt="Logo" style="width:100px;" class="rounded-pill"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto"></ul>
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
                        <p>Email:</p>
                        <input style='width:95%;' type='text' name='email' />
                        <p>Password:</p>
                        <input style='width:95%;' type='password' id='pasahitza' name='password' />
                        <input type="checkbox" onclick="showPass()">Show Password </br>
                        <input type="submit" name="sartu" class="mt-3 btn btn-secondary" value='Entry'>
                        <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
                    </form>
                    <p id="login_text"></p>
                    <a class="btn btn-outline-warning " href="./Logins/register.php">Register</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id='register-card-body' class="col-6 mx-auto card text-white">
            <div class="card-body row ">
                <h5 class="card-title">Contact Form</h5>
                <form class="col-xl-5 boxr mt-4 mb-4" id="registro" name="registro" method="POST" action="./mail.php">
                    <label class="col-4 mt-3" >Name</label> <input class="col-4" type="text" name="name"></br>
                    <label class="col-4 mt-3 mb-3">Your Email</label> <input class="col-4" type="text" name="email"></br>
                    <label>Message</label></br><textarea  name="message" rows="6" cols="27"></textarea></br>
                    <p class="col-8 mt-3" id='contact_text'></p>
                    <input type="submit" value="Send"></br><input type="reset" value="Clear"></br>
                </form>
                <div class="col-lg-6">
                    <img src="./Images/mail.png" width="95%">
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<!--If is an error on the booking-->
<?php
        if (isset($_GET['incorrect'])) {
            if ($_GET['incorrect']  == 'no') {
                echo "<script>document.getElementById('contact_text').innerHTML = 'Send!' </script>";
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