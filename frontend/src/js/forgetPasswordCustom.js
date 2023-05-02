
$("#resetPass").on("click",function(){
    let uemail = $("#userEmail").val();
    // basic validation
    let err = "";
    let errFlag = 0;
    if(uemail == ""){
        err = "Email address cannot be empty";
        errFlag =1;
    }
    
    if(errFlag==1){
        alertMsg(err);
        return 0;
    }

    var form_data = new FormData();  
    form_data.append('SendName','user');
    form_data.append('SendEmail',uemail);
    form_data.append('contentData', "change your password");
    form_data.append('subject', "Password Change Request!");
    let urlProtocall = getURLProtocall();
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/mail/mail',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            $("#resetPass span").css("display",'none');
            alertMsg(res.result,'2em',true,{
                url:urlProtocall+"www.gate.com"
            });
        }else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
    $("#resetPass span").css("display",'inline-block');
})