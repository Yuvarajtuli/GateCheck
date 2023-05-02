<?php
ini_set('max_execution_time', '3000');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($SendName,$SendEmail,$contentData,$subject,$SendCc,$SendBcc,$attachment){
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	require 'PHPMailer/src/Exception.php';
	$mail = new PHPMailer;
	$mail->isSMTP();     
	$mail->SMTPDebug = 0;
	$mail->Host = gethostbyname('smtp.gmail.com');
	$mail->SMTPAuth = true;
	$mail->Username = 'yuvarajtuli@gmail.com';
	$mail->Password = 'sysgupcrjyxcvhda';
	$mail->SMTPSecure = 'tls';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port = 587;
	$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
	$mail->setFrom('yuvarajtuli@gmail.com','Yuvaraj Tuli');
	$mail->addAddress($SendEmail,$SendName);
	$mail->isHTML(true);
	$mail->Subject = strval($subject);
	$mail->Body    = strval($contentData);
	if(!$mail->send()) {
		return false;
	}else{
		return true;
	}
}

?>