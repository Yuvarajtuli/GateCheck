let urlProtocall = getURLProtocall();
let hotNot = ''

let getDataTable = (forID,status)=>{
    var form_data = new FormData();  
    form_data.append('status',status);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_visitorDetails',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            for(var key in res.details){
                if(res.details[key].actionStatus == 'pending'){
                    htmlStr = "<tr><td>"+res.details[key].visitorName+"</td><td>"+res.details[key].visitorEmail+"</td><td><span class='shadow-none badge badge-warning'>"+res.details[key].actionStatus+"</span></td><td class='text-center'><button class='btn btn-outline-primary' onclick='markApproved("+res.details[key].ID+")'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check-circle'><path d='M22 11.08V12a10 10 0 1 1-5.93-9.14'></path><polyline points='22 4 12 14.01 9 11.01'></polyline></svg></button><button class='btn btn-outline-danger' onclick='markSuspended("+res.details[key].ID+")'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg></button></td></tr>";
                }else if(res.details[key].actionStatus == 'approved'){
                    htmlStr = "<tr><td>"+res.details[key].visitorName+"</td><td>"+res.details[key].visitorEmail+"</td><td><span class='shadow-none badge badge-primary'>"+res.details[key].actionStatus+"</span></td><td class='text-center'><button class='btn btn-outline-primary' onclick='markExit("+res.details[key].ID+")'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-log-out'><path d='M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4'></path><polyline points='16 17 21 12 16 7'></polyline><line x1='21' y1='12' x2='9' y2='12'></line></svg></button></td></tr>";
                }
                $("#"+forID+" tbody").prepend(htmlStr);
            }
            if($("#endTableScriptFiles").children().length <= 0 ){
                // scripts
                let script1 = "<script src='"+urlProtocall+"www.gate.com/frontend/lightSrc/plugins/table/datatable/datatables.js'></script>";
                let script2 = "<script src='"+urlProtocall+"www.gate.com/frontend/lightSrc/plugins/table/datatable/custom_miscellaneous.js'></script>";
                $("#endTableScriptFiles").append(script1);
                $("#endTableScriptFiles").append(script2);
            }           
        }else{
            console.log(res.error);
            if($("#endTableScriptFiles").children().length <= 0 ){
                // scripts
                let script1 = "<script src='"+urlProtocall+"www.gate.com/frontend/lightSrc/plugins/table/datatable/datatables.js'></script>";
                let script2 = "<script src='"+urlProtocall+"www.gate.com/frontend/lightSrc/plugins/table/datatable/custom_miscellaneous.js'></script>";
                $("#endTableScriptFiles").append(script1);
                $("#endTableScriptFiles").append(script2);
            } 
        }
    })
}
getDataTable("column-filter","pending")
getDataTable("column-filter1","approved")
// notifications
let getNotications = (action,type='')=>{
    // alert(action);
    var form_data = new FormData();  
    form_data.append('action',action);
    form_data.append('type',type);
    form_data.append('orgID',1);
    form_data.append('step','guard');
  
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/notifications',form_data,false,false,false,(res)=>{
      if(res.status == 200){
        if(res.type == "active"){
          for(var key in res.details){
            if(res.details[key].nTime.date != hotNot){
              hotNot = res.details[key].nTime.date;
              alertNotification(res.details[key].nTitle);
            }     
          }
        }
      }else{
          console.log(res.error);
      }
    })
  }
getNotications('show','active',);
getNotications('update');
setInterval(function(){
    getNotications('show','active',);
    getNotications('update');
  },2000);
let markApproved = (id)=>{
    var form_data = new FormData();  
    form_data.append('id',id);
    form_data.append('status',"approved");
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/ws_change_visitorDetails',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            alertMsg(res.result,'2em',true,{
                url:"reload"
            });
        }
    })
}
let markSuspended = (id)=>{
    var form_data = new FormData();  
    form_data.append('id',id);
    form_data.append('status',"suspended");
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/ws_change_visitorDetails',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            alertMsg(res.result,'2em',true,{
                url:"reload"
            });
        }
    })
}
let markExit = (id)=>{
    var form_data = new FormData();  
    form_data.append('id',id);
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/ws_change_visitorLog',form_data,false,false,false,(res)=>{
        if(res.status == 200){
            alertMsg("Exit Marked!",'2em',true,{
                url:"reload"
            });
        }
    })
}
let loadRe = setInterval(function(){
    location.reload();
},20000);
