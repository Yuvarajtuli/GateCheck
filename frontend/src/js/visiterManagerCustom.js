let urlProtocall = getURLProtocall();
// global to the file
let dataCNT=1;
// to open details of the visiter
let openList = (noid)=>{
    let thisval = "invoice-0000"+noid;
    var getDataInvoiceAttr = $("#"+thisval).attr('data-invoice-id');
    var getDataName = $("#"+thisval).attr('data-name');
    var getDataEmail = $("#"+thisval).attr('data-email');
    var getDataMobile = $("#"+thisval).attr('data-mobile');
    var getParentDiv = $("#"+thisval).parents('.doc-container');
    var getParentInvListContainer = $("#"+thisval).parents('.inv-list-container');
    var $el = $('.' + thisval).show();
    $('#ct > div').not($el).hide();
    var setInvoiceNumber = getParentDiv.find('.invoice-inbox .inv-number').text('#'+ getDataInvoiceAttr);
    var showInvHeaderSection = getParentDiv.find('.invoice-inbox .invoice-header-section').css('display', 'flex');
    var showInvHeaderSection = getParentDiv.find('.invoice-inbox .invoice-header-section .makeACall').html("<a href='tel:"+getDataMobile+"'><button class='btn btn-success'>Make a call</button></a>");
    var showInvHeaderSection = getParentDiv.find('.invoice-inbox .invoice-header-section .sendMails').html("<button class='btn btn-warning' data-name='"+getDataName+"' data-email='"+getDataEmail+"'>Send Mail</button>");
    var showInvContentSection = getParentDiv.find('.invoice-inbox #ct').css('display', 'block');
    var showInvContentSection = getParentDiv.find('.invoice-inbox').css('height', 'calc(100vh - 215px)');
    var hideInvEmptyContent = getParentDiv.find('.invoice-inbox .inv-not-selected').css('display', 'none');
    var hideInvEmptyContent = getParentDiv.find('.invoice-container .inv--thankYou').css('display', 'block');
    if ($("#"+thisval).parents('.tab-title').hasClass('open-inv-sidebar')) {
      $("#"+thisval).parents('.tab-title').removeClass('open-inv-sidebar');
    }
    $(".doc-container #pills-tab .list-actions").removeClass('active');
    $("#"+thisval).addClass('active');
  
    var myDiv = document.getElementsByClassName('invoice-inbox')[0];
    myDiv.scrollTop = 0;
}
// send mail function
$(".invoice-inbox .invoice-header-section .sendMails").on("click",()=>{
    if($(".spinner-border").is(":visible")){
        alertMsg("Sending Mail!");
    }else{
        uname = $(".invoice-inbox .invoice-header-section .sendMails button").attr("data-name");
        uemail = $(".invoice-inbox .invoice-header-section .sendMails button").attr("data-email"); 
        $(".invoice-inbox .invoice-header-section .sendMails").html("<button class='btn btn-warning' data-name='"+uname+"' data-email='"+uemail+"'><div class='spinner-border text-white align-self-center loader-sm ' style='width:17px;height:17px'></div> Send Mail</button>");
        let form_data = new FormData();  
        form_data.append('SendName',uname);
        form_data.append('SendEmail',uemail);
        form_data.append('contentData', "change your password");
        form_data.append('subject', "You have a visiter wait!");
        callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/mail/mail',form_data,false,false,false,(res)=>{
            if(res.status == 200){
                $(".invoice-inbox .invoice-header-section .sendMails").html("<button class='btn btn-warning' data-name='"+uname+"' data-email='"+uemail+"'>Send Mail</button>");
                alertMsg(res.result);
            }else{
                alertMsg(res.result);
                $(".invoice-inbox .invoice-header-section .sendMails").html("<button class='btn btn-warning' data-name='"+uname+"' data-email='"+uemail+"'>Send Mail</button>");
                console.log(res.error);
            }
        })
    }
})
// get list of visiter
let getAllVisiterList = ()=>{
    // get time details
    let time = $(".doc-container #pills-tab li").first().attr("data-time");
    if(time == undefined){
        time = ''
    }else{
        time = time.slice(0,-3);
    }
    var form_data = new FormData();  
    form_data.append('time',time);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_visiterDetailNLog',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            for(var key in res.details){
                // imp date
                let d1 = new Date(res.details[key].entryTime.date)
                // whatsapp check
                if(res.details[key].whatsapp==1){
                    whatapp="yes";
                }else{
                    whatapp="no";
                }
                let htmlStr1 = "<li class='nav-item' data-time='"+res.details[key].entryTime.date+"'>";
                htmlStr1+='<div class="nav-link list-actions" onclick="openList('+dataCNT+')" data-mobile="'+res.details[key].visitorMobile+'" data-name="'+res.details[key].visitorName+'" data-email="'+res.details[key].visitorEmail+'" id="invoice-0000'+dataCNT+'" data-invoice-id="0000'+dataCNT+'">';
                htmlStr1+="<div class='f-m-body'>";
                htmlStr1+="<div class='f-head'>";
                htmlStr1+="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user'><path d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'></path><circle cx='12' cy='7' r='4'></circle></svg>";
                htmlStr1+="</div>";
                htmlStr1+="<div class='f-body'>";
                htmlStr1+="<p class='invoice-number'>Visiter #0000"+dataCNT+"</p>";
                htmlStr1+="<p class='invoice-customer-name'><span>Name:</span> "+res.details[key].visitorName+"</p>";
                htmlStr1+="<p class='invoice-generated-date'>Date: "+d1.toDateString()+"</p>";
                htmlStr1+="</div>";
                htmlStr1+="</div>";
                htmlStr1+="</div>";
                htmlStr1+="</li>";
                $(".doc-container #pills-tab").prepend(htmlStr1);
                // visiter details
                let htmlStr ="<div class='invoice-0000"+dataCNT+"' data-time="+res.details[key].entryTime.date+">";
                htmlStr+="<div class='content-section  animated animatedFadeInUp fadeInUp'>";
                htmlStr+="<div class='row inv--head-section'>";
                htmlStr+="<div class='col-sm-6 col-12'>";
                htmlStr+="<h3 class='in-heading'>VISITER</h3>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-6 col-12 align-self-center text-sm-right'>";
                htmlStr+="<div class='company-info'>";
                htmlStr+="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-hexagon'><path d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'></path></svg>";
                htmlStr+="<h5 class='inv-brand-name'>GATE Check</h5>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="<div class='row inv--detail-section'>";
                htmlStr+="<div class='col-sm-7 align-self-center'>";
                htmlStr+="<p class='inv-to'>Visit From</p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-5 align-self-center  text-sm-right order-sm-0 order-1'>";
                htmlStr+="<p class='inv-detail-title'>Visit To : "+res.details[key].personToMeet+"</p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-7 align-self-center'>";
                htmlStr+="<p class='inv-customer-name'>"+res.details[key].visitorName+"</p>";
                htmlStr+="<p class='inv-street-addr'>"+res.details[key].visitorAddress+"</p>";
                htmlStr+="<p class='inv-email-address'>"+res.details[key].visitorEmail+"</p>";
                htmlStr+="<p class='inv-email-address'>"+res.details[key].visitorMobile+"</p>";
                htmlStr+="<p class='inv-email-address'><img src='"+res.details[key].visitorImage+"' style='width:200px;border-radius:5px;'></p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-5  text-sm-right order-2'>";
                htmlStr+="<p class='inv-list-number'><span class='inv-title'>Reason to visit: </span> "+res.details[key].reason+"</p>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="<div class='row mt-4'>";
                htmlStr+="<div class='col-sm-5 col-12 order-sm-0 order-1'>";
                htmlStr+="<div class='inv--payment-info'>";
                htmlStr+="<div class='row'>";
                htmlStr+="<div class='col-sm-12 col-12'>";
                htmlStr+="<h6 class=' inv-title'>Other Details:</h6>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-4 col-12'>";
                htmlStr+="<p class=' inv-subtitle'>Has Whatsapp: </p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-8 col-12'>";
                htmlStr+="<p class=''>"+whatapp+"</p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-4 col-12'>";
                htmlStr+="<p class=' inv-subtitle'>Entry Time : </p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-8 col-12'>";
                htmlStr+="<p class=''>"+d1.toLocaleTimeString()+"</p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-4 col-12'>";
                htmlStr+="<p class=' inv-subtitle'>Current Status : </p>";
                htmlStr+="</div>";
                htmlStr+="<div class='col-sm-8 col-12'>";
                htmlStr+="<p class=''>entry "+res.details[key].actionStatus+"</p>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                htmlStr+="</div>";
                $("#ct").append(htmlStr);
                dataCNT++;
            }          
        }else{
            console.log(res.error);
        }
    })
    
}
setInterval(function(){
    getAllVisiterList();
},1000)

