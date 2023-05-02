<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$roleID = $_POST["roleID"];
// check
$sql = "select * from menuList where ID in (select menuID from roleMenus where roleID = ".$roleID.") and menuCurrentStatus = 1";
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
$cnt = sqlsrv_num_rows($run);
if($cnt > 0){
        $data['status']=200;
        $data['result']="Menu List!";
        while($res = sqlsrv_fetch_array($run)){
            $data["details"][$res['menuName']]=array(
                "menuParent"=>$res['menuHasParent'],
                "menuIcon"=>$res['menuIcon'],
                "menuPageURL"=>$res['menuPageURL']
            );
        }
    }else{
        $data['status']=500;
        $data['result']="Menu list not found!".$sql;
        $data['error']="Some internal error!";
    }
$json = json_encode($data);
echo $json;


?>