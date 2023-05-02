let vIA = 1;
// switch action
$("#checkCamera").on("click",()=>{
    if($("#checkCamera").prop('checked') == true){
        $("#camDIV").fadeIn();
        $("#uploadDIV").css("display","none");
    }else{
        $("#camDIV").css("display","none");
        $("#uploadDIV").fadeIn();
    }
})
// capture camera
let video = document.querySelector("#video");
let imgDisp = 0;
let canvas = document.querySelector("#canvas");
$("#start-camera").on("click",async ()=>{
    imgDisp = 0
    $("#video").fadeIn();
    $("#click-photo").fadeIn();
    $("#start-camera").css("display","none");
    $("#canvas").css("display","none");
    let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
    video.srcObject = stream;
})
$("#click-photo").on("click",()=>{
    imgDisp = 1;
    $("#start-camera").fadeIn();
    $("#canvas").fadeIn();
    $("#video").css("display","none");
    $("#click-photo").css("display","none");
    capture()
})
function capture() {
    var canvas = document.getElementById("canvas");
    var video = document.querySelector("video");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas
      .getContext("2d")
      .drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
  
    /** Code to merge image **/
    /** For instance, if I want to merge a play image on center of existing image **/
    const playImage = new Image();
    playImage.src = "path to image asset";
    playImage.onload = () => {
      const startX = video.videoWidth / 2 - playImage.width / 2;
      const startY = video.videoHeight / 2 - playImage.height / 2;
      canvas
        .getContext("2d")
        .drawImage(playImage, startX, startY, playImage.width, playImage.height);
      canvas.toBlob() = (blob) => {
        const img = new Image();
        img.src = window.URL.createObjectUrl(blob);
      };
    };
    /** End **/
}
// search and autofill
$("#searchNfill").on("click",()=>{
    let email = $("#vemail").val()
    if(email == ""){
        alertMsg("Email cannot be empty");
        return 0;
    }
    var form_data = new FormData();  
    form_data.append('vEmail',email);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_visitorDetails',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            for(var key in res.details){
                $("#vname").val(res.details[key].visitorName);
                $("#vemail").val(res.details[key].visitorEmail);
                $("#vmobile").val(res.details[key].visitorMobile);
                $("#vaddress").val(res.details[key].visitorAddress);
                $("#vmeet").val(res.details[key].personToMeet);
                $("#vreason").val(res.details[key].reason);
                // image
                $("#camDIV").css("display","none");
                $("#switchBoard").css("display","none");
                $("#uploadDIV").css("display","none");
                let scriptIMG = "<img src='"+res.details[key].visitorImage+"' style='width:100%;'>";
                $("#imgDIV").html(scriptIMG);
                $("#imgDIV").css("display","block");
                // whatsapp
                if(res.details[key].whatsapp == 1){
                    $("#vwhatsapp").prop("checked",true);
                }else{
                    $("#vwhatsapp").prop("checked",false);
                }
                // terms
                if(res.details[key].terms == 1){
                    $("#vterms").prop("checked",true);
                }else{
                    $("#vterms").prop("checked",false);
                }
            }
            alertMsg("Your details auto-filled ! ");
            vIA = 0;
        }else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
});
// submit form for entry request  
$("#request").on("click",()=>{

    // data
    let vName = $("#vname").val(); 
    let vEmail = $("#vemail").val();
    let vMobile = $("#vmobile").val();
    let vAddress = $("#vaddress").val();
    let vMeet = $("#vmeet").val();
    let vReason = $("#vreason").val();
    
    let vWhatsapp = $("#vwhatsapp").prop("checked");
    let vTerms = $("#vterms").prop("checked");
    // valid
    let err = "";
    let errFlag = 0;
    if(vName==""){
        err = "Name cannot be empty!";
        errFlag = 1;
    }else if(vEmail == ""){
        err = "Email cannot be empty!";
        errFlag = 1;
    }else if(vMobile == ""){
        err = "Mobile cannot be empty!";
        errFlag = 1;
    }else if(vAddress == ""){
        err = "Address cannot be empty!";
        errFlag = 1;
    }else if(vMeet == ""){
        err = "Please select whom to meet!";
        errFlag = 1;
    }else if(vReason == ""){
        err = "Please give a reason to visit!";
        errFlag = 1;
    }else if(vTerms == false){
        err = "Your have to accrept the terms and conditions!";
        errFlag = 1;
    }
    if(errFlag==1){
        alertMsg(err);
        return 0;
    }
    var form_data = new FormData();  
    form_data.append('vName',vName);
    form_data.append('vEmail',vEmail);
    form_data.append('vMobile', vMobile);
    form_data.append('vAddress', vAddress);
    form_data.append('vMeet', vMeet);
    form_data.append('vReason', vReason);
    
    
    if(vWhatsapp == true){
        vWhatsapp = 1
    }else{
        vWhatsapp = 0
    }
    form_data.append('vWhatsapp', vWhatsapp);
    if(vTerms == true){
        vTerms = 1
    }else{
        vTerms = 0
    }
    if($("#checkCamera").prop("checked") == true && vIA != 0){
        let vImage = canvas.toDataURL('image/png');
        if(imgDisp == 0){
            alertMsg("Please capture a picture!");
            return 0;
        }
        form_data.append('vCapture', vImage);
    }else if($("#checkCamera").prop("checked") == false && vIA != 0 ){
        let vImage = $('#vimage')[0].files[0];
        if($('#vimage').val() == ''){
            alertMsg("Please select a file to upload!");
            return 0;
        }
        form_data.append('vimage', vImage);
    }
    form_data.append('vTerms', vTerms);
    if(vIA == 0){
        vIA = $("#imgDIV img").attr("src");
    }else{
        vIA = 1
    }
    let device = 'laptop'
    if(window.matchMedia("(max-width: 767px)").matches){
        // The viewport is less than 768 pixels wide
        device = 'mobile'
    } else{
        // The viewport is at least 768 pixels wide
        device = 'laptop'
    }
    form_data.append('vIA', vIA);
    form_data.append('orgID', 1);
    form_data.append('device', device);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/ws_post_visiterData',form_data,false,false,false,(res)=>{
        if(res.status == 201){
            alertMsg(res.result,'2em',true,{
                amsg:"Please do not leave this page! Waiting for request acceptance."
            });
            let flag = 0
            let timmer = setInterval(function(){
                if(flag == 0){
                    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_visitorDetails',form_data,false,false,false,(res)=>{
                        if(res.status == 200){
                            for(var keys in res.details){
                                if(res.details[keys].actionStatus != 'pending'){
                                    flag = 1
                                    alertMsg("Your Entry Is "+res.details[keys].actionStatus,'2em',true,{
                                        url:"reload"
                                    });
                                }
                            }
                        }
                    })
                }
            },5000)
        }else if(res.status == 302){
            alertMsg(res.result,'2em',true,{
                url:"reload"
            });
        }
        else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
})