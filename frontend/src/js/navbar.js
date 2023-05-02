function getRoleNavbar(){
    let uname = localStorage.getItem("userName");
    let uimg = localStorage.getItem("userImage");
    $("h6[data-attVal='userName']").html("<span>Hi,</span> "+uname);
    $("div[role='banner'] img").attr("src","http://www.gate.com/frontend/src/images/logo.png");
    $("img[data-img='1']").attr("src",uimg);
    let roleID = localStorage.getItem("roleID");
	var form_data = new FormData();  
    form_data.append('roleID',roleID);
    let urlProtocall = getURLProtocall();
    callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/json_get_roleDetails',form_data,false,false,false,(res)=>{
        if(res.status == 200){
        	for(var key in res.details){
        		let htmlContent = "<a class='' href='"+res.details[key].urlLink+"'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user'><path d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'></path><circle cx='12' cy='7' r='4'></circle></svg> "+res.details[key].roleName+"</a>";
        		$("#roleTypeis").html(htmlContent)
        	}
        }else{
            alertMsg(res.result);
            console.log(res.error);
        }
    })
}
getRoleNavbar();