<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
$step = isset($_POST["step"])?$_POST['step']:0;
if($step == 1){
    $uemail = $_POST['uemail'];
    $upass = $_POST['upass'];
    $ucookie = $_POST['ucookie'];
    // check
    $sql = "select * from users where userEmail = '".$uemail."' and userPassword = '".$upass."' and usercurrentStatus = 1 and orgID in (select ID from Organizations where orgCurrentStatus = 1)";
    $run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
    $cnt = sqlsrv_num_rows($run);
    if($cnt > 0){
        $data['status']=200;
        $data['error']="";
        $data['result']="User login successful!";
        $res = sqlsrv_fetch_array($run);
        $data["details"]=array(
            "ID"=>$res['ID'],
            "orgID"=>$res['orgID'],
            "roleID"=>$res['roleID'],
            "userName"=>$res['userName'],
            "userEmail"=>$res['userEmail'],
            "userMobile"=>$res['userMobile'],
            "userImage"=>$res['userImage'],
            "userCountryCode"=>$res['userCountryCode'],
            "userCreateDate"=>$res['usercreateDate'],
            "userCurrentStatus"=>$res['usercurrentStatus']
        );
        if($ucookie == 1){
            setcookie("uemail", $uemail, time() + (86400 * 30), "/");
            setcookie("upass", $upass, time() + (86400 * 30), "/");
        }
        // make log
        $sqlMakeLog = "insert into logHandler(userID) values(".$res['ID'].")";
        $runMakeLog = sqlsrv_query($conn,$sqlMakeLog,array(), array( "Scrollable" => 'static' ));
        // get activate URL
        $sqlRoleURL = "select urlLink from roleList where ID = ".$res['roleID'];
        $runRoleURL = sqlsrv_query($conn,$sqlRoleURL,array(), array( "Scrollable" => 'static' ));
        $fetchRoleURL = sqlsrv_fetch_array($runRoleURL);
        session_start();
        $_SESSION['logActive'] = 1;
        $_SESSION['roleID'] = $res['roleID'];
        $_SESSION['ID'] = $res['ID'];
        $_SESSION['uiColor'] = "light";
        $_SESSION['roleUrlLink'] = $fetchRoleURL['urlLink'];
    }else{
        $data['status']=500;
        $data['result']="User login not successful!";
        $data['error']="Some internal error!";
    }

}else{
    $data['status']=300;
    $data['result']="User login not successful!";
    $data['error']="Invalid step value sent in the API!";
}
$json = json_encode($data);
echo $json;


?>