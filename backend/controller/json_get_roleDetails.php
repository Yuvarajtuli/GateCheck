<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$roleID = $_POST["roleID"];
// check
$sql = "select * from roleList where ID = ".$roleID." and currentStatus = 1";
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
$cnt = sqlsrv_num_rows($run);
if($cnt > 0){
        $data['status']=200;
        $data['result']="role List!";
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['ID']]=array(
                "roleName"=>$res['roleName'],
                "roleDescription"=>$res['roleDescription'],
                "urlLink"=>$res['urlLink']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="role not found!".$sql;
        $data['error']="Some internal error!";
    }
$json = json_encode($data);
echo $json;


?>