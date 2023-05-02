<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$time = isset($_POST['time'])?$_POST['time']:'';
if($time == ''){
    $sql = "select vli.ID,vli.visitorName,vli.visitorEmail,vli.visitorMobile,
    vli.visitorAddress,vli.personToMeet,vli.reason,vli.visitorImage,
    vli.whatsapp,vli.terms,vli.currentStatus,vli.actionStatus,vlo.entryTime 
    from visitorList as vli,visitorLog as vlo 
    where 
    vli.ID = vlo.visitorID and 
    Day(vlo.entryTime) = day(getdate()) and 
    month(vlo.entryTime) = MONTH(getdate()) and 
    YEAR(vlo.entryTime) = YEAR(getdate()) and 
    vli.actionStatus = 'approved' and 
    vli.currentStatus = 1 and 
    vlo.currentStatus = 1 order by vlo.entryTime desc";
}else{
    $sql="select vli.ID,vli.visitorName,vli.visitorEmail,vli.visitorMobile,
    vli.visitorAddress,vli.personToMeet,vli.reason,vli.visitorImage,
    vli.whatsapp,vli.terms,vli.currentStatus,vli.actionStatus,vlo.entryTime 
    from visitorList as vli,visitorLog as vlo 
    where 
    vli.ID = vlo.visitorID and 
    Day(vlo.entryTime) = day(getdate()) and 
    month(vlo.entryTime) = MONTH(getdate()) and 
    YEAR(vlo.entryTime) = YEAR(getdate()) and 
    vli.actionStatus = 'approved' and 
    vli.currentStatus = 1 and 
    vlo.currentStatus = 1 and vlo.entryTime > '".$time."' order by vlo.entryTime desc";
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
                "actionStatus"=>$res['actionStatus'],
                "entryTime"=>$res['entryTime'],
            );
        }
    }else{
        if($time==''){
            $data['status']=500;
            $data['result']="Visitor not found!";
            $data['error']="No Such Visitor Exists!";
        }
    }
$json = json_encode($data);
echo $json;


?>