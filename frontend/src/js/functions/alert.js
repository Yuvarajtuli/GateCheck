function alertMsg(msg='',padding='2em',redirect=false,{url='',amsg=''}={}){
    swal({
        title: msg,
        padding: padding
    }).then(()=>{
        if(redirect == true){
            if(url!=""){
                if(url.toLowerCase() == "reload"){
                    location.reload();
                }else{
                    window.open(url,"_self");
                }
            }else if(amsg!=''){
                swal({
                    title: amsg,
                    padding: padding
                })
            }
        }
    })
    
}
function alertNotification(msg='',redirect=false,{url='',amsg=''}={}){
    Snackbar.show({
        text: msg,
        width:'auto',
        duration: 5000,
        pos: 'top-right',
        onActionClick: function(element) {
            if(redirect == true){
                if(url!=""){
                    if(url.toLowerCase() == "reload"){
                        location.reload();
                    }else{
                        window.open(url,"_self");
                    }
                }else if(amsg!=''){
                    Snackbar.show({
                        text: amsg,
                        width:'auto',
                        pos: 'top-right'
                    })
                }
            }else{
                $(element).css('opacity', 0);
            }
        }
    });    
}