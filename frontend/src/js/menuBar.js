function getMenu(){
	let roleID = localStorage.getItem("roleID");
	var form_data = new FormData();  
    form_data.append('roleID',roleID);
    let urlProtocall = getURLProtocall();
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_menuList',form_data,false,false,false,(res)=>{
        if(res.status == 200){
        	for(var key in res.details){
        		let htmlContent = "<li class='menu single-menu'><a href='"+urlProtocall+"www.gate.com"+res.details[key].menuPageURL+"'><div class=''>"+res.details[key].menuIcon+"<span>"+key+"</span></div></a></li>";
        		$("#topAccordion").append(htmlContent)
        	}
            menuActivate();
        }else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
}
// active
let menuActivate=()=>{
    let url = getFullURL() +window.location.pathname;
    var count = $("#topAccordion").children().length;
    $("#topAccordion .single-menu").removeClass("active");
    for(i=1;i<=count;i++){
        let anchor = $("#topAccordion .single-menu:nth-child("+i+") a").attr("href").trim();
        anchor = String(anchor);
        url = url.trim();
        url = String(url);
        if(anchor === url){
            $("#topAccordion .single-menu:nth-child("+i+")").addClass("active");
        }
    }
}
getMenu();