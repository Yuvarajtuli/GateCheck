<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$email = isset($_POST["vEmail"])?$_POST["vEmail"]:'';
$status = isset($_REQUEST["status"])?$_REQUEST["status"]:'';

// check
if($email != ''){
    $sql = "select top 1 vli.* from visitorList as vli where vli.visitorEmail = '".$email."' order by ID desc";
}else{
    if($status == ''){
        $sql = "select vli.* from visitorList as vli order by ID desc";
    }else if($status == 'pending'){
        $sql = "select vli.* from visitorList as vli where vli.currentStatus = 1 and vli.actionStatus = 'pending' order by ID desc";
    }else if($status == 'suspended'){
        $sql = "select vli.* from visitorList as vli where vli.currentStatus = 1 and vli.actionStatus = 'suspended' order by ID desc";
    }else if($status == 'approved'){
        $sql = "select vli.* from visitorList as vli where vli.currentStatus = 1 and vli.actionStatus = 'approved' order by ID desc";
    }
}
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
$cnt = sqlsrv_num_rows($run);
if($cnt > 0){
        $data['status']=200;
        $data['result']="Visitor Details!";
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['ID']]=array(
                "ID"=>$res['ID'],
                "visitorName"=>$res['visitorName'],
                "visitorEmail"=>$res['visitorEmail'],
                "visitorMobile"=>$res['visitorMobile'],
                "visitorAddress"=>$res['visitorAddress'],
                "personToMeet"=>$res['personToMeet'],
                "reason"=>$res['reason'],
                "visitorImage"=>$res['visitorImage'],
                "whatsapp"=>$res['whatsapp'],
                "terms"=>$res['terms'],
                "currentStatus"=>$res['currentStatus'],
                "actionStatus"=>$res['actionStatus']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="Visitor not found!";
        $data['error']="No Such Visitor Exists!";
    }
$json = json_encode($data);
echo $json;


?>