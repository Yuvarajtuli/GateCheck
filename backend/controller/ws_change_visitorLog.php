<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$id = isset($_REQUEST["id"])?$_REQUEST["id"]:'';
// check
$sql = "update visitorLog set exitTime = GETDATE(),currentStatus = 0 where visitorID = ".$id." and DAY(entryTime) = DAY(getdate()) and MONTH(entryTime) = MONTH(getdate()) and YEAR(entryTime) = YEAR(getdate()) and currentStatus = 1";
$sql2 = "update visitorList set currentStatus = 0 where ID = ".$id;
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
$run = sqlsrv_query($conn,$sql2,array(), array( "Scrollable" => 'static' ));
// insert log
$data['status']=200;
$json = json_encode($data);
echo $json;


?>