<?php
include '../Segments/connection.php';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../account.php");
    die;
}
$toEmail = mysqli_real_escape_string($conn, $_POST['email']);
$emailPass = getenv("sendgridPass");
require '../vendor/autoload.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.sendgrid.net'; 
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->Username = "apikey";
$mail->Password = "$emailPass";

$mail->From = "samplegameforum@gmail.com";
$mail->FromName = "SGF Password Support";

$mail->addAddress("$toEmail");

$mail->Subject = "Forgot Password";
$mail->Body = "You can't forget your password yet, stupid! Forget it later.";
if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";

header("Location: ../account.php");
die;
?>