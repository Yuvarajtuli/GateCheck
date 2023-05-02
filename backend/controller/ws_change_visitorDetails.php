<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$id = isset($_POST["id"])?$_POST["id"]:'';
$status = isset($_POST["status"])?$_POST["status"]:'';
// update
if($status == "approved"){
    $sql = "update visitorList set actionStatus = '".$status."' where ID = ".$id;
}else if($status == "suspended"){
    $sql = "update visitorList set currentStatus = 0, actionStatus = '".$status."' where ID = ".$id;
}
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
// insert log
$getDevice = "select device from visitorList where ID = ".$id;
$runGetDevice = sqlsrv_query($conn,$getDevice,array(), array( "Scrollable" => 'static' ));
$fetchGetDevice = sqlsrv_fetch_array($runGetDevice);
$insSql = "insert into visitorLog (visitorID,device) values (".$id.",'".$fetchGetDevice['device']."')";
$insRun = sqlsrv_query($conn,$insSql,array(), array( "Scrollable" => 'static' ));
// new notification
$dd = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
$insNotSql = "insert into notifications (orgID,stepStatus,nTitle,nIcon) values (1,'reception','new visiter','".$dd."')";
$insNotRun = sqlsrv_query($conn,$insNotSql,array(), array( "Scrollable" => 'static' ));
if($status == "suspended"){
    $ssql = "update visitorLog set exitTime = GETDATE(),currentStatus = 0 where visitorID = ".$id." and DAY(entryTime) = DAY(getdate()) and MONTH(entryTime) = MONTH(getdate()) and YEAR(entryTime) = YEAR(getdate()) and currentStatus = 1";
    $srun = sqlsrv_query($conn,$ssql,array(), array( "Scrollable" => 'static' ));
}
$data['status']=200;
if($status == "approved"){
    $data['result']="Visitor Approved !";
}else if($status == "suspended"){
    $data['result']="Visitor Suspended !";
}
$json = json_encode($data);
echo $json;


?>