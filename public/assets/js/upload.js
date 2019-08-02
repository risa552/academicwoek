(function( $ ) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.fn.upload = function () {
        var $el = $(this);
        var ext = $el.attr('data-ext');
        var url = $el.attr('data-url');
        var callback = $el.attr('data-callback');
        var programid = $el.attr('data-programid');
        new ss.SimpleUpload({
            button: $el.get(0),
            url: url,
            allowedExtensions: ext.split(','),
            name: 'userfile',
            multipart: true,
            multiple: false,
            responseType: 'json',
            data:{'_token':token,program_id:programid},
            onComplete: function( filename, response )
            {
                if(response.status!=200)
                {
                    alert(response.message);
                    return false;
                }
                else
                {
                    window[callback](response,$el);
                }
            }
        });
    }
    $('.upload-file').upload();
}( jQuery ));
