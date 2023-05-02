<?php 
function authVerify(){
    if(!isset($_SESSION['logActive'])){
        header("location:https://www.gate.com");
    }else{
        $serverName ="DESKTOP-55L232S\DELL2022";
        $connectionInfo = array( "Database"=>"gate");
        $conn = sqlsrv_connect($serverName,$connectionInfo);
        if(!$conn){
            phpinfo();
            die(print_r(sqlsrv_errors(),true));    
        }
        $sql = "select * from users where ID = ".$_SESSION['ID']." and roleID in (select ID from roleList where ID = ".$_SESSION['roleID'].")";
        $runs = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));
        $cnt = sqlsrv_num_rows($runs);
        if($cnt <= 0){
            header("location:https://www.gate.com/frontend/public/auth/logout");
        }
    }
}
authVerify();
?>