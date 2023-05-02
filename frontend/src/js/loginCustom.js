// toggle password
$("#toggle-password").on("click",function(){
    let upass = $("#userPassword");
    if(upass.prop("type") === "password"){
        upass.prop("type","text");
    }else{
        upass.prop("type","password");
    }
});
$("#loginBtn").on("click",function(){
    let uemail = $("#userEmail").val();
    let upass = $("#userPassword").val();
    let ucookie = $("#userCookie");
    // basic validation
    let err = "";
    let errFlag = 0;
    if(uemail==""){
        err = "Email address cannot be empty";
        errFlag =1;
    }else if(upass == ""){
        err = "Password cannot be empty";
        errFlag =1;
    }

    if(errFlag==1){
        alertMsg(err);
        return 0;
    }
    var form_data = new FormData();  
    form_data.append('step',1);
    form_data.append('uemail',uemail);
    form_data.append('upass', upass);
    if(ucookie.prop("checked")==true){
        form_data.append('ucookie', 1);
    }else{
        form_data.append('ucookie', 0);
    }
    let urlProtocall = getURLProtocall();
    console.log(urlProtocall);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_login',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            localStorage.setItem("orgID",res.details.orgID)
            localStorage.setItem("roleID",res.details.roleID)
            localStorage.setItem("userName",res.details.userName)
            localStorage.setItem("userEmail",res.details.userEmail)
            localStorage.setItem("userMobile",res.details.userMobile)
            localStorage.setItem("userCountryCode",res.details.userCountryCode)
            localStorage.setItem("userImage",res.details.userImage)
            alertMsg(res.result,'2em',true,{
                url:urlProtocall+"www.gate.com"
            });
            
        }else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
    

})