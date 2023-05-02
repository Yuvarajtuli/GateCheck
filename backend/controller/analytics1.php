<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$type = $_REQUEST["type"];
// check
if($type == "monthlyStats"){
    $sql = "select * from MonthlyStats";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['result']="Monthly Stats!";
        $data['type']=$type;
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['month']]=array(
                "vcnt"=>$res['visitors'],
                "fcnt"=>$res['feedbacks']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="No data found";
        $data['error']="Some internal error!";
    }
}else if($type == "deviceStats"){
    $sql = "select * from dbo.deviceStats";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['result']="Device Stats!";
        $data['type']=$type;
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['device']]=array(
                "persentage"=>$res['perentage']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="No data found";
        $data['error']="Some internal error!";
    }
}else if($type == "weeklyStats"){
    $sql = "select * from dbo.weeklyStats";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['result']="Weekly Stats!";
        $data['type']=$type;
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['day']]=array(
                "visiters"=>$res['visiters'],
                "feedbacks"=>$res['feedbacks']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="No data found";
        $data['error']="Some internal error!";
    }
}else if($type == "feedback"){
    $sql = "select visiterID,isnull(rating,0) [rating] ,isnull(feedback,'') [feedback],total,visitorName,visitorImage,feedbackTime from (
        select top 1 * from feedback order by feedbackTime desc) as aa,
        (select SUM(rating) [total] from feedback group by Year(feedbackTime)) as bb,
        (select ID,visitorName,visitorImage from visitorList where orgID = 1) as cc
        where aa.visiterID = cc.ID";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['result']="top feedback!";
        $data['type']=$type;
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['visiterID']]=array(
                "visiterID"=>$res['visiterID'],
                "rating"=>$res['rating'],
                "feedback"=>$res['feedback'],
                "feedbackTime"=>$res['feedbackTime'],
                "total"=>$res['total'],
                "visitorName"=>$res['visitorName'],
                "visitorImage"=>$res['visitorImage'],
            );
        }
    }else{
        $data['status']=500;
        $data['result']="No data found";
        $data['error']="Some internal error!";
    }
}


$json = json_encode($data);
echo $json;


?>