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
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?php echo $uiURL; ?>assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?php echo $uiURL; ?>bootstrap/js/popper.min.js"></script>
<script src="<?php echo $uiURL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $uiURL; ?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo $uiURL; ?>assets/js/app.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="<?php echo $uiURL; ?>plugins/highlight/highlight.pack.js"></script>
<script src="<?php echo $uiURL; ?>assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="<?php echo $uiURL; ?>assets/js/authentication/form-1.js"></script>
<script src="<?php echo $uiURL; ?>assets/js/scrollspyNav.js"></script>
<script src="<?php echo $uiURL; ?>plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="<?php echo $uiURL; ?>plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
    let registerStep = localStorage.getItem("registerStep");
    if(registerStep == ""){
        localStorage.setItem("registerStep","1")
    }else if(registerStep == "2"){
        location.href = "http://www.gate.com/frontend/public/auth/registerStep2.php";
    }
    // for test
    $.fn.fillData = (active)=>{
        if(active == true){
            $("#oname").val("Workman technologies")
            $("#oemail").val("sales@workmantechnologies.com")
            $("#omobile").val("9999323733")
            $("#oaddress").val("A-90 Sector 23 Noida, Uttar Pradesh, India , 201301")
            $("#oproof").val("1234567890987654321")
            $("#agreeTerms").prop("checked",true)
        }
    }
    $.fn.fillData(true);
    // for email verification
    $('#oEmail-field .getVerification').on('click', function () {
        email = $("#oemail").val();
        if(email == ""){
            swal({
                title: 'Please enter your organizations email addresss!',
                padding: '2em'
            });
        }else{
            swal({
                title: 'Verification mail sent on : '+email,
                padding: '2em'
            })
        }
    
    })
    // for mobile verification
    $('#oMobile-field .getVerification').on('click', function () {
        mobile = $("#omobile").val();
        if(mobile == ""){
            swal({
                title: 'Please enter your organizations mobile number!',
                padding: '2em'
            });
        }else{
            swal({
                title: 'Verification SMS sent on : '+mobile,
                padding: '2em'
            })
        }
    
    })
    // for getting started
    $("#submitNext").on("click",()=>{
        let eflag = 0;
        let err = "";
        if($("#oname").val()==""){
            eflag = 1
            err = "Please fill you organization name";
        }else if($("#oemail").val()==""){
            eflag = 1
            err = "Please fill you organization email";
        }else if($("#omobile").val()==""){
            eflag = 1
            err = "Please fill you organization mobile";
        }else if($("#oaddress").val()==""){
            eflag = 1
            err = "Please fill you organization address";
        }else if($("#oproof").val()==""){
            eflag = 1
            err = "Please fill you organization proof";
        }else if(!$("#agreeTerms").is(":checked")){
            eflag = 1
            err = "Please agree the terms and conditions!";
        }
        if(eflag == 1){
            swal({
                    title: err,
                    padding: '2em'
            })
        }else{
            localStorage.setItem("registerStep","2")
            location.href = "http://www.gate.com/frontend/public/auth/registerStep2.php";
        }
    })
</script>
<script src="<?php echo $basicURL; ?>js/generalCustom.js"></script>