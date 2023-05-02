
<?php
$serverName ="DESKTOP-55L232S\DELL2022";
$connectionInfo = array( "Database"=>"gate");
$conn = sqlsrv_connect($serverName,$connectionInfo);
if($conn){
	//phpinfo();
	//echo "connection established";
}else{
	phpinfo();
	die(print_r(sqlsrv_errors(),true));
	
}

?>