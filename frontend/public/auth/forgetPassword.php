<?php 
session_start();
include_once '../a_parts/urlSection.php';
?>
<?php include_once '../../pageValidate/authValidate.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../includes/css/auth/forgotPasswordCss.php'; ?>
    <?php include_once '../../includes/css/a_parts/sweetAlertsCss.php'; ?>
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link">Enter your email and instructions will sent to you!</p>
                        <form class="text-left">
                            <div class="form">

                                <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="userEmail" name="email" type="text" value="" placeholder="Email">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <!-- <div class="field-wrapper"> -->
                                        <button type="button" id="resetPass" class="btn btn-primary btn-lg mb-4 mr-3" value="">
                                            <span style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></span>
                                        Reset</button>
                                    <!-- </div>                                     -->
                                </div>

                            </div>
                        </form>                        
                        <p class="terms-conditions">© 2023 All Rights Reserved. <a href="index.html">GateCheck</a> is a product by Yuvaraj Tuli. <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.</p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>
    
    <?php include_once '../../includes/js/auth/forgotPasswordJs.php'; ?>
    <?php include_once '../../includes/js/a_parts/sweetAlertsJs.php'; ?>

</body>
</html>