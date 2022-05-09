<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$formcontent=" From: $name \n Message: $message";
$recipient = "lomana.markel@uni.eus";
$subject = "Contact Form Web Page";
$mailheader = "From: $email \r\n";

//mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
header("Location: ./contact.php?incorrect=no");
?>