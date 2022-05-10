<?php
if(isset($_POST['sartu']))
{
   login();
} 

else if($_GET['logout'] == 'yes')
{
   logout();
} else{}



function logout(){
	session_start();
	session_destroy();	
    //echo "<script language=Javascript> location.href=\"index.php\"; </script>";
    //destruye las sesiones y vamos a index
    header("Location: ../index.php");
}

function login(){
    include("../connect_db.php");
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
            header("Location: ../index.php?incorrect=yes");
        }
        /*FOR USERS*/ 
        else if ($erregistroa = mysqli_fetch_array($result_users)) {
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

                header("Location: ../Users/users_web.php");
            }
        }
        /*FOR EMPLOYEES*/ 
        else if ($erregistroa = mysqli_fetch_array($result_employees)) {
            if ($email = $erregistroa['Email'] & $password = $erregistroa['Password']) {

                session_start();
                $email = $erregistroa['Email'];
                $_SESSION["Email"] = $erregistroa['Email'];
                $_SESSION["Name"] = $erregistroa['Name'];
                $_SESSION["Surname"] = $erregistroa['Surname'];
                $_SESSION["TLF"] = $erregistroa['TLF'];
                $_SESSION["Password"] = $erregistroa['Password'];
                $_SESSION["Employee_Id"] = $erregistroa['Employee_Id'];

                header("Location: ../Employees/employees_web.php");
            }
        }
    }
}


?>
