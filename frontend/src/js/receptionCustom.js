// global accross page
let urlProtocall = getURLProtocall();

let hotNot = ''
// api call
let analysis = (type)=>{
  var form_data = new FormData();  
  form_data.append('type',type);
  callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/analytics1',form_data,false,false,false,(res)=>{
    if(res.status == 200){
      if(res.type == "monthlyStats"){
        let months = [];
        let vcnt = [];
        let fcnt = [];
        for(var key in res.details){
          months.push(key);
          vcnt.push(res.details[key].vcnt);
          fcnt.push(res.details[key].fcnt);
        }
        visiterFeedbackStats(vcnt,fcnt,months);
      }else if(res.type == "deviceStats"){
        let device = [];
        let devicePersentage = [];
        for(var key in res.details){
          device.push(key);
          devicePersentage.push(res.details[key].persentage);
        }
        visiterDeviceStats(device,devicePersentage);
      }else if(res.type == "weeklyStats"){
        let day = [];
        let visiter = [];
        let feedbacks =[];
        for(var key in res.details){
          day.push(key);
          visiter.push(res.details[key].visiters);
          feedbacks.push(res.details[key].feedbacks);
        }
        visiterWeeklyStats(day,visiter,feedbacks)
      }else if(res.type == "feedback"){
        for(var key in res.details){
          var d1 = new Date(res.details[key].feedbackTime.date);
          let hhs = "<div class='widget widget-card-one'>";
          hhs+="<div class='widget-content'>";

          hhs+="<div class='media'>";
          hhs+="<div class='w-img'>";
          hhs+="<img src='"+res.details[key].visitorImage+"' alt='avatar'>";
          hhs+="</div>";
          hhs+="<div class='media-body'>";
          hhs+="<h6>"+res.details[key].visitorName+"</h6>";
          hhs+="<p class='meta-date-time'>"+d1.toDateString()+"</p>";
          hhs+="<span style='font-size:12px;color:rgba(0,0,0,0.3);'>latest feedback</span>";
          hhs+="</div>";
          hhs+="</div>";

          hhs+="<p>"+res.details[key].feedback+"</p>";

          hhs+="<div class='w-action'>";
          hhs+="<div class='card-like'>";
          hhs+="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-thumbs-up'><path d='M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3'></path></svg>";
          hhs+="<span> "+res.details[key].total+" Feedbacks</span>";
          hhs+="</div>";
          hhs+="</div>";
          hhs+="</div>";
          hhs+="</div>";
          $("#feedbackLast").html(hhs);
        }
      }
    }else{
        alertMsg(res.result);
        console.log(res.error);
    }
  })
}
// get notications
let getNotications = (action,type='')=>{
  let timer = $(".item-timeline").first().attr("data-time");
  if(timer == undefined || timer == ''){
    timer = ''
  }else{
    timer = timer.slice(0,-3);
  }
  var form_data = new FormData();  
  form_data.append('action',action);
  form_data.append('type',type);
  form_data.append('orgID',1);
  form_data.append('step','reception');
  form_data.append('time',timer);

  callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/notifications',form_data,false,false,false,(res)=>{
    if(res.status == 200){
      if(res.type == "active"){
        for(var key in res.details){
          if(res.details[key].nTime.date != hotNot){
            hotNot = res.details[key].nTime.date;
            // hotNot = hotNot.slice(0,-3);
            // alert(hotNot + " and " + res.details[key].nTime.date)
            alertNotification(res.details[key].nTitle);
          }     
        }
      }else if(res.type == "inactive"){
        
        for(var key in res.details){
          let d1 = new Date(res.details[key].nTime.date)
          let hrmlstr = "<div class='item-timeline timeline-new' data-time='"+res.details[key].nTime.date+"'>";
          hrmlstr+="<div class='t-dot'>";
          hrmlstr+="<div class='t-primary'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-users'><path d='M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='9' cy='7' r='4'></circle><path d='M23 21v-2a4 4 0 0 0-3-3.87'></path><path d='M16 3.13a4 4 0 0 1 0 7.75'></path></svg></div>";
          hrmlstr+="</div>";
          hrmlstr+="<div class='t-content'>";
          hrmlstr+="<div class='t-uppercontent'>";
          hrmlstr+="<h5 style='text-transform:capitalize;'>"+res.details[key].nTitle+"</h5>";
          hrmlstr+="<span class=''>"+d1.toDateString()+"</span>";
          hrmlstr+="</div>";
          hrmlstr+="<p><span>Updated</span> Admin , Reception</p>";
          hrmlstr+="<div class='tags'>";
          hrmlstr+="<div class='badge badge-primary'> Reception </div>&nbsp;";
          hrmlstr+="<div class='badge badge-success'> Admin </div>&nbsp;";
          hrmlstr+="<div class='badge badge-warning'> Attend </div>&nbsp;";
          hrmlstr+="</div>";
          hrmlstr+="</div>";
          hrmlstr+="</div>";
          $(".timeline-line").prepend(hrmlstr);
        }
      }
    }else{
        console.log(res.error);
    }
  })
}

analysis('deviceStats');
analysis('monthlyStats');
analysis('weeklyStats');
analysis('feedback');
getNotications('show','active',);
getNotications('update');
getNotications('show','inactive');
setInterval(function(){
  getNotications('show','active',);
  getNotications('update');
  getNotications('show','inactive');
},2000);
setInterval(function(){
  analysis('deviceStats');
  analysis('monthlyStats');
  analysis('weeklyStats');
},20000)
