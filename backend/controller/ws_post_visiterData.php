<?php
include '../functions/connection.php'; 
header('Content-Type: application/json; charset=utf-8');
$data = array();
// getting data
$vName = $_POST['vName'];
$vEmail = $_POST['vEmail'];
$vMobile = $_POST['vMobile'];
$vAddress = $_POST['vAddress'];
$vMeet = $_POST['vMeet'];
$vReason = $_POST['vReason'];
$orgID = $_POST['orgID'];
$device = $_POST['device'];
// upload pic
$vImage = isset($_FILES['vimage']['name'])?$_FILES['vimage']['name']:'';
$vImageTemp = isset($_FILES['vimage']['tmp_name'])?$_FILES['vimage']['tmp_name']:'';
// save capture
$vCapture = isset($_POST['vCapture'])?$_POST['vCapture']:'';
// prevent action
$vImgAction = isset($_POST['vIA'])?$_POST['vIA']:1;
// 
$vWhatsapp =$_POST['vWhatsapp'];
$vTerms = $_POST['vTerms'];
// validation
$checkSql = "select * from visitorList where currentStatus = 1 and (visitorEmail = '".$vEmail."' or visitorMobile = '".$vMobile."')";
$checkRun = sqlsrv_query($conn,$checkSql,array(), array( "Scrollable" => 'static' ));
$checkCnt = sqlsrv_num_rows($checkRun);
if($checkCnt>0){
    $data['status']=302;
    $data['result']="Request Already sent from this email or mobile number!";
    $json = json_encode($data);
    echo $json;
    die();
}
// check capture or upload
if($vCapture == '' && (empty($vImage) || $vImage == '') && $vImgAction == 1){
    $data['status']=400;
    $data['result']="Invalide!";
    $data["error"]="Either caputer an image or upload one!";
    $json = json_encode($data);
    echo $json;
    die();
}else if($vCapture != ''){
    $folderName = $vName.$vEmail.$vMobile;
    $dirName = "../../uploadedFiles/visitors/".$folderName;
    if(!is_dir($dirName)){
        mkdir($dirName);    
    }
    $filteredData=substr($vCapture, strpos($vCapture, ",")+1);
    $decodedData=base64_decode($filteredData);
    $uplodPath = $dirName."/perspic.png";
    $fp = fopen( $uplodPath, 'wb' );
    fwrite( $fp, $decodedData);
    fclose( $fp );
    $vImage = "https://www.gate.com/uploadedFiles/visitors/".$folderName."/perspic.png";
}else if(!empty($vImage)){
    $folderName = $vName.$vEmail.$vMobile;
    $dirName = "../../uploadedFiles/visitors/".$folderName;
    if(!is_dir($dirName)){
        mkdir($dirName);    
    }
    $fileType1 = explode(".",$vImage);
    $fileType = $fileType1[1];
    $uplodPath = $dirName."/perspic.".$fileType;
    if(!move_uploaded_file($vImageTemp,$uplodPath)){
        $data['status']=400;
        $data['result']="File Error";
        $data["error"]="File Not Uploaded!";
        $json = json_encode($data);
        echo $json;
        die();
    }else{
        $vImage = "https://www.gate.com/uploadedFiles/visitors/".$folderName."/perspic.".$fileType;
    }
}else{
    $vImage = $vImgAction;
}
// new notification
$insNotSql = "insert into notifications (orgID,stepStatus,nTitle,nIcon) values (1,'guard','new visiter','')";
$insNotRun = sqlsrv_query($conn,$insNotSql,array(), array( "Scrollable" => 'static' ));
// new visiter
$sql = "insert into visitorList (visitorName,visitorEmail,visitorMobile,visitorAddress,personToMeet,reason,visitorImage,whatsapp,terms,orgID,device) values
('".$vName."','".$vEmail."','".$vMobile."','".$vAddress."','".$vMeet."','".$vReason."','".$vImage."',".$vWhatsapp.",".$vTerms.",".$orgID.",'".$device."')";
$run = sqlsrv_query($conn,$sql,array(), array( "Scrollable" => 'static' ));

$data['status']=201;
$data['result']="New visitor created!";
$json = json_encode($data);
echo $json;

?>