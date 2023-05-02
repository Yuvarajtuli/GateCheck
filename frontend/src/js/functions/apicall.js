function callAPI(method,dataType,url,form_data,cache,contentType,processData,callback=''){
    if(form_data==''){
        $.ajax({
            type: method,
            dataType: dataType,
            url: url,
            cache: cache,
            contentType: contentType,
            processData: processData
        }).done(function (result) {
            if(callback!=''){
                callback(result);
            }
        }); 
    }else{
        $.ajax({
            type: method,
            dataType: dataType,
            url: url,
            cache: cache,
            contentType: contentType,
            processData: processData,
            data:  form_data 
        }).done(function (result) {
            if(callback!=''){
                callback(result);
            }
        }); 
    }
    
}