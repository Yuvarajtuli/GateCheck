<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$action=isset($_REQUEST['action'])?$_REQUEST['action']:'show';
$type=isset($_REQUEST['type'])?$_REQUEST['type']:'active';
$orgID=isset($_REQUEST['orgID'])?$_REQUEST['orgID']:'1';
$step=isset($_REQUEST['step'])?$_REQUEST['step']:'';
$time=isset($_REQUEST['time'])?$_REQUEST['time']:'';
if($action == "show"){
if($type=='active'){
    $sql = "select top 1 * from notifications where orgID = ".$orgID." and stepStatus = '".$step."' and DAY(nTime)=DAY(GETDATE()) and MONTH(nTime)=MONTH(GETDATE()) and YEAR(nTime)=YEAR(GETDATE()) and nStatus = 1 order by nTime desc";
}else{
    if($time!=''){
        $sql = "select * from notifications where orgID = ".$orgID." and stepStatus = '".$step."' and DAY(nTime)=DAY(GETDATE()) and MONTH(nTime)=MONTH(GETDATE()) and YEAR(nTime)=YEAR(GETDATE()) and nStatus = 0 and nTime > '".$time."' order by nTime desc";
    }else{
        $sql = "select * from notifications where orgID = ".$orgID." and stepStatus = '".$step."' and DAY(nTime)=DAY(GETDATE()) and MONTH(nTime)=MONTH(GETDATE()) and YEAR(nTime)=YEAR(GETDATE()) and nStatus = 0 order by nTime desc";
    }
}
// echo $sql;

$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['type']=$type;
        $data['result']="Notification!";
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['ID']]=array(
                "orgID"=>$res['orgID'],
                "stepStatus"=>$res['stepStatus'],
                "nTitle"=>$res['nTitle'],
                "nIcon"=>$res['nIcon'],
                "nTime"=>$res['nTime'],
                "nTags"=>$res['nTags'],
                "nStatus"=>$res['nTitle']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="No data found";
        $data['error']="Some internal error!";
    }
}else if("update"){
    $sql = "update notifications set nStatus=0 where orgID = ".$orgID." and stepStatus = '".$step."' and DAY(nTime)=DAY(GETDATE()) and MONTH(nTime)=MONTH(GETDATE()) and YEAR(nTime)=YEAR(GETDATE()) and nStatus = 1";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $data['status']=200;
    $data['result']="Notification!";
}


$json = json_encode($data);
echo $json;


?>