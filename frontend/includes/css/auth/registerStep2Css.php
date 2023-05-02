<?php 
session_start();
$UIcolor = isset($_SESSION['uiColor'])?$_SESSION['uiColor']:'light';
if($UIcolor == "dark"){
    $uiURL = "http://www.gate.com/frontend/darkSrc/";
}else{
    $uiURL = "http://www.gate.com/frontend/lightSrc/";
}
$basicURL = "http://www.gate.com/frontend/src/";
?>
<link rel="icon" type="image/x-icon" href="<?php echo $uiURL; ?>assets/img/favicon.ico"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="<?php echo $uiURL; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $uiURL; ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $uiURL; ?>assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->    
<link rel="stylesheet" type="text/css" href="<?php echo $uiURL; ?>assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="<?php echo $uiURL; ?>assets/css/forms/switches.css">
<link href="<?php echo $uiURL; ?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $uiURL; ?>plugins/animate/animate.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $uiURL; ?>plugins/sweetalerts/promise-polyfill.js"></script>
<link href="<?php echo $uiURL; ?>plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $uiURL; ?>plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $uiURL; ?>assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<style>
        .preventScroll{
            position: fixed;
            height:100%;
            width: 100%;
            overflow: hidden;
        }
        .getScroll{
            height:auto;
            overflow-y: scroll;
        }
        /* width */
        .getScroll::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        .getScroll::-webkit-scrollbar-track {
        background: #060818; 
        }
        
        /* Handle */
        .getScroll::-webkit-scrollbar-thumb {
        background:rgba(255,255,255,0.1); 
        border-radius: 20px;
        }

        /* Handle on hover */
        .getScroll::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.3); 
        }
        .getVerification{
            position: absolute;
            top:0%;
            right:0;
            height:60%;
            padding:10px 0 0 0;
            color:#009688;
            cursor:pointer;
            z-index:20;
        }
        .l-image{
            background-image: url('<?php echo $uiURL; ?>images/registerImg.jpg');
        }
    </style>