var Helper = {};
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
Helper.ajax = function(url,method,params,callback){
    if(typeof params === 'object'){
        if(method != 'GET'){
            params['_method']=method 
        }
    } else if(typeof params === 'string'){
        if(method != 'GET'){
            if(params==''){
                params+='_method='+method
            }else{
                params+='&_method='+method
            }
        }
    }
    $.ajax({
        url:url,
        type:method,
        dataType:'json',
        data:params,
        statusCode:
        {
            500:function(){
                alert('ขออภัยระบบเกิดความผิดพลาด');
            },
            400:function(response){
                console.log(response.responseJSON);          
                alert(response.responseJSON.message);
            },
        },
        success:function(response){
            console.log(response);  
            if(typeof callback ==='function'){
                callback(response);
            }else{
                alert(response.message);
            }
        }
    });
}
$(function(){
    $('.form-ajax').on('submit',function(e){
        e.preventDefault();
        var form = $(this);
        var url =form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();
        var callback = form.attr('callback');
        if(typeof callback !=='string'){
            callback = function(response){
                alert(response.message);
                if(typeof response.url === 'string' && response.url !=''){
                    window.location.href=response.url;
                }else{
                    window.location.reload();
                }
            }
        }
        Helper.ajax (url,method,data,callback)
    });
    $('.delete-item').on('click',function(e){
        e.preventDefault();
        if(confirm('ท่านต้องการจะลบรายการนี้ใช่หรือไม่')){
            var el = $(this);
            var url =el.attr('href');
            var method = 'DELETE';
            var data = '';
            callback = function(){
                    alert('ระบบได้ลบข้อมูลเรียนร้อยแล้ว');
                    window.location.reload();
            }
            Helper.ajax (url,method,data,callback)
        }
    });
});