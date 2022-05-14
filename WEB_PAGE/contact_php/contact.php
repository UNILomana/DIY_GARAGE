<!DOCTYPE html>
<html lang="en">

<head>
  <title>DIY GARAGE</title>
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-placement="bottom" title="Menua" data-bs-target="#collapsibleNavbar">
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
        <ul class="navbar-nav navbar-hover me-5"><a class="text-dark text-decoration-none p-3 rounded-pill h5" href="../Products_PHP/Products_Unloged.php">Products</a></ul>
      </div>
    </div>
    <div class="col-4 text-center">
      <p class="me-3 text-danger" id="login_text"></p>
      <button id='Login' class="btn btn-outline-dark" type="button">Login</button>
    </div>
  </nav>

  <!--LOGIN CARD-->

  <div id='card' class="ms-auto">
    <div id='card-body' class="card ">
      <div class="card-body cscard-bg">
        <h5 class="card-title">Login</h5>
        <form action='../Logins/PHP_InOut.php' method="POST">
          <label>Email:</label></br>
          <input style='width:95%;' type='email' name='email' id="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" oninvalid="this.setCustomValidity('Use a valid format. Example: pedro@gmail.com')" />
          <label>Password:</label></br>
          <input style='width:95%;' type='password' id='pasahitza' name='password' />
          <input type="checkbox" onclick="showPass()">Show Password </br>
          <input type="submit" name="sartu" class="mt-3 btn btn-secondary" value='Entry'>
          <input type="reset" id="cancel" class="mt-3 btn btn-secondary" value="Cancel" />
        </form>

        <a class="btn btn-secondary mt-3" href="../Logins/register.php">Register</a>
      </div>
    </div>
  </div>


  <div class="d-flex justify-content-center">
    <div class="d-flex flex-column w-50 justify-content-center  m-5">
      <h2>Contact us</h2>
      <form class="bg-light px-5 py-3" id="registro" name="registro" method="POST" action="./mail.php">
        <div class="form-row">
          <div class="form-group">
            <label for="inputAddress">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Your name....">
          </div>
          <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" placeholder="your email...." id="inputEmail4">
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Subject</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="Subject....">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Your message</label>
            <textarea class="form-control" placeholder="Your message...." id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>
        </div>
        <p class="col-8 mt-3" id='contact_text'></p>
        <input type="submit" class="btn btn-outline-dark my-3 me-3" value="Send"><input type="reset"  class="btn btn-outline-dark my-3" value="Clear"></br>
      </form>
    </div>
  </div>

  <!--FOOTER-->
  <div class="cstm-bg d-flex justify-content-around p-3">
    <div class="d-flex flex-column">
      <a class="footer-hover text-decoration-none text-dark p-2" href="../Products_PHP/Products_Unloged.php">Products</a>
      <a class="footer-hover text-decoration-none text-dark p-2" href="./contact.php">Contact</a>
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


<?php
if (isset($_GET['incorrect'])) {
  if ($_GET['incorrect']  == 'yes') {
    echo "<script>document.getElementById('login_text').innerHTML = 'Incorrect username or password please try again' </script>";
  }
}
?>

<!--If is an error on the booking-->
<?php
if (isset($_GET['mail'])) {
    if ($_GET['mail']  == 'no') {
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

  const email = document.getElementById("email");

  email.addEventListener("input", function(event) {
    if (email.validity.typeMismatch) {
      email.setCustomValidity("¡Se esperaba una dirección de correo electrónico!");
    } else {
      email.setCustomValidity("");
    }
  });
</script>