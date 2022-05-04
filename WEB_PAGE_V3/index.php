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
                <ul class="navbar-nav me-auto">
                    <li><a href="">Products</a></li>
                </ul>
                <button id='Login' class="btn btn-outline-warning" type="button">Login</button>
            </div>
        </div>
    </nav>

    <!--LOGIN CARD-->
    <div  class="row">
        <div id='card' class="ms-auto">
            <div  id='card-body' class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action='./Logins/PHP_InOut.php' method="POST">
                        <p>Email:</p>
                        <input style='width:95%;' type='text' name='email' />
                        <p>Password:</p>
                        <input style='width:95%;' type='password' name='password' /> </br>
                        <input type="submit" class=" mt-3 btn btn-secondary" name="sartu" value='Entry'>
                        <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
                    </form>
                    <p id="login_text"></p>
                    <a class="btn btn-outline-warning " href="./Logins/register.php">Register</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <p>Who we are? xvfxv</p>

    </div>

</body>

</html>

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

