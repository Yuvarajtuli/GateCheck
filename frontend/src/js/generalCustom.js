
// change UI Color
$("#UIMode").on("click",()=>{
	// alert("hello");
    let urlProtocall = getURLProtocall();
	callAPI('POST','JSON',urlProtocall+'www.gate.com/backend/controller/ws_change_UI','',false,false,false,(res)=>{
        if(res.status == 200){
            location.reload();           
        }
    })
});