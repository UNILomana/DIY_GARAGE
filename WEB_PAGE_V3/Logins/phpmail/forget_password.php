<!doctype html>
<!--HACER SI HAY TIEMPO DE SOBRA

https://www.tutsmake.com/send-reset-password-link-email-php/
-->
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
      <div class="container">
          <div class="card">
            <div class="card-header text-center">
              Send Reset Password Link with Expiry Time in PHP MySQL
            </div>
            <div class="card-body">
              <form action="password-reset-token.php" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" name="password-reset-token" class="btn btn-primary">
              </form>
            </div>
          </div>
      </div>
 
   </body>
</html>