<?php
header('Content-Type: application/json; charset=utf-8');
$data = array();
$SendName = isset($_REQUEST['SendName'])?$_REQUEST['SendName']:'';
$SendEmail = isset($_REQUEST['SendEmail'])?$_REQUEST['SendEmail']:'';
$contentData = isset($_REQUEST['contentData'])?$_REQUEST['contentData']:'';
$subject = isset($_REQUEST['subject'])?$_REQUEST['subject']:'';
$SendCc = isset($_REQUEST['SendCc'])?$_REQUEST['SendCc']:'';
$SendBcc = isset($_REQUEST['SendBcc'])?$_REQUEST['SendBcc']:'';
$attachment = isset($_REQUEST['attachment'])?$_REQUEST['attachment']:'';
// $data["status"]=200;
// $data["result"]="Name : ".$SendName." Email : ".$SendEmail;
// $json = json_encode($data);
// echo $json;
// die();
if($SendName == "" || $SendEmail=="" || $subject==""){
	$data["status"]=300;
	$data["result"]="Mail not sent!";
	$data['error']="receiver name or receiver email or subject cannot be empty!";
	$json = json_encode($data);
	echo $json;
	die();
}
include 'sendMail.php';
$res = sendMail($SendName,$SendEmail,$contentData,$subject,$SendCc,$SendBcc,$attachment);
if($res == false){
	$data["status"]=500;
	$data["result"]="Mail not sent!";
	$data['error']="Some internal error!";
}else{
	$data["status"]=200;
	$data["result"]="Mail sent!";
	$data["error"]="";
}
$json = json_encode($data);
	echo $json;
?>