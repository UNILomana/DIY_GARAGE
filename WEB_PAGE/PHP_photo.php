<?php
session_start();
include("./connect_db.php");
$link = connectDataBase();
$sesioa = $_SESSION['User_Id'];

    //INSERT VALUES(CON SEGURIDAD PREPARED STATEMENTS)
    $result = $link -> prepare("update users set Profile_Img = ? where User_Id = ?");
    $result -> bind_param('ss', $bukaeraHelbidea, $sesioa);

    //ARGAZKI TRATAMENDUA
    $serbitzarikoHelbidea = '../Images/Clients';                             # The folder to save the photos
    $helbideTemporala =     $_FILES['profilephoto']['tmp_name'];                 # Photos link:
    $argazkiIzena =         $_FILES['profilephoto']['name'];                     # Photos name:
    $bukaeraHelbidea =      $serbitzarikoHelbidea . '/' . $argazkiIzena;         # Save the end address. 
    move_uploaded_file($helbideTemporala, $bukaeraHelbidea);                 # Make a photo copy in ../Images/Clients. 
    
    $result->execute();
    $result->close();
    $link->close();

    header("Location: ./Users/users_web.php");
?>