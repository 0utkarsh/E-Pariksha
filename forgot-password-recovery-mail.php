<?php
include_once 'dbConnection.php';
if(!class_exists('PHPMailer')) {
    require('PHPMailer.php');
	require('SMTP.php');
}

require_once("mail_configuration.php");

use PHPMailer\PHPMailer\PHPMailer;
include_once "Exception.php";
include_once 'dbConnection.php';
$mail = new PHPMailer(true);
$email=$user['email'];

$generator="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$generator=substr(str_shuffle($generator),0,20);

$expires=date_default_timezone_set('Asia/Kolkata');

$now = time();
$ten_minutes = $now + (10 * 60);
$expires= date('Y-m-d H:i:s',$ten_minutes);	
$result1 = mysqli_query($con,"DELETE FROM reset WHERE email='$email' ") or die('Error2');
$result = mysqli_query($con,"INSERT INTO `reset` VALUES ('$email','$generator','$expires')") or die('Error1');
$emailBody = "<div>Hello " . $user["name"] .  ",<br><br><p>Click on this link to recover your password: <a href='" . PROJECT_HOME . "reset_password.php?id=$generator&email=$email&q=0'>Reset Password</a><br><br>Note that the link will automatically expire after 10 minutes.<br><br></p>Regards,<br><br> Admin.</div>";

	
			 

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = PORT;  
$mail->Username = MAIL_USERNAME;
$mail->Password = MAIL_PASSWORD;
$mail->Host     = MAIL_HOST;
$mail->Mailer   = MAILER;

$mail->SetFrom(SERDER_EMAIL, SENDER_NAME);
$mail->AddReplyTo(SERDER_EMAIL, SENDER_NAME);
$mail->ReturnPath=SERDER_EMAIL;	
$mail->AddAddress($user["email"]);
$mail->Subject = "Password Recovery";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	$error_message = 'Problem in Sending Password Recovery Email';
} else {
	$success_message = 'Please check your email to reset password!';
}

?>
