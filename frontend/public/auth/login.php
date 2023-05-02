<?php 
session_start();
include_once '../a_parts/urlSection.php';
?>
<?php include_once '../../pageValidate/authValidate.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../../includes/css/auth/loginCss.php';?>
    <?php include_once '../../includes/css/a_parts/sweetAlertsCss.php'; ?>
</head>
<body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Log In to <a href="index.html"><span class="brand-name">GATE</span></a></h1>
                        <p class="signup-link">New Here? <a href="auth_register.html">Request an account</a></p>
                        <form class="text-left">
                            <div class="form">

                                <div id="userEmail-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="userEmail" name="userEmail" type="email" class="form-control" placeholder="User Email Address" value="<?php echo isset($_COOKIE['uemail'])?$_COOKIE['uemail']:'';?>">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="userPassword" name="userPassword" type="password" class="form-control" placeholder="Password" value="<?php echo isset($_COOKIE['upass'])?$_COOKIE['upass']:'';?>">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="button" class="btn btn-primary" value="" id="loginBtn">Log In</button>
                                    </div>
                                    
                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" id="userCookie" class="new-control-input">
                                          <span class="new-control-indicator"></span>Keep me logged in
                                        </label>
                                    </div>
                                </div>

                                <div class="field-wrapper">
                                    <a href="http://www.gate.com/frontend/public/auth/forgetPassword" class="forgot-pass-link">Forgot Password?</a>
                                </div>

                            </div>
                        </form>                        
                        <p class="terms-conditions">© 2023 All Rights Reserved. <a href="index.html">Gate</a> is a product by Yuvaraj Tuli. <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.</p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>
    <?php include_once '../../includes/js/auth/loginJs.php' ?>
    <?php include_once '../../includes/js/a_parts/sweetAlertsJs.php'; ?>
</body>
</html>