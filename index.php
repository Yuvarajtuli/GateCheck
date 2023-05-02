<?php  
session_start();
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
$domain = $_SERVER["HTTP_HOST"];
$url = $protocol . $domain;
if(isset($_SESSION['logActive'])){
  if(!isset($_SESSION['roleUrlLink'])){
    header("location:".$url."/frontend/public/auth/logout.php");
  }else{
    if($_SESSION['roleUrlLink'] == ""){
      header("location:".$url."/frontend/public/auth/logout.php");
    }else{
      header("location:".$url.$_SESSION['roleUrlLink'].".php");
    }
  }
}else{
     header("location:".$url."/frontend/public/auth/login.php");
}
 ?>