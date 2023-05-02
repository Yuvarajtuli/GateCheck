<?php 
session_start();
header('Content-Type: application/json; charset=utf-8');
$data = array();
$ui=$_SESSION['uiColor'];
if($ui == "dark"){
	$_SESSION['uiColor'] = "light";
}else{
	$_SESSION['uiColor'] = "dark";
}
$data['status']=200;
$data['result']="UI Color" . $_SESSION['uiColor'];
$json = json_encode($data);
echo $json;
?>