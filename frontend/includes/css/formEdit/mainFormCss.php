<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>GATE Admin Template - Starter Kit - Blank Page</title>
<link rel="icon" type="image/x-icon" href="<?php echo $basicURL; ?>images/logo.png"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="<?php echo $uiURL; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $uiURL; ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo $uiURL; ?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $uiURL; ?>plugins/select2/select2.min.css">
    <link href="<?php echo $uiURL; ?>plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $uiURL; ?>assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $uiURL; ?>assets/css/forms/switches.css">
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<?php include_once '../../includes/css/a_parts/sweetAlertsCss.php'; ?>

<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<style>
    .readCam{
        width: 100%;
        height:200px;
        background-color: black;
    }
    .showPic{
        width: 100%;
        height:200px;
        background-color: red;
    }
    @media (max-width: 767px) {
        .nav-logo{
            display: block;
        }
        .nav-logo .navbar-brand-name{
            display: none;
        }
    }
    @media (max-width: 991px) {
        .nav-logo{
            display: block;
        }
        .nav-logo .navbar-brand-name{
            display: none;
        }
    }
</style>