<?php 
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
$UIcolor = isset($_SESSION['uiColor'])?$_SESSION['uiColor']:'light';
if($UIcolor == "dark"){
    $uiURL = $url."/frontend/darkSrc/";
}else{
    $uiURL = $url."/frontend/lightSrc/";
}
$basicURL = $url."/frontend/src/";
?>