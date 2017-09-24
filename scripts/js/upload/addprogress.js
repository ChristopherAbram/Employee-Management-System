
// Xhr progress event:
(function addXhrProgressEvent( $ ){
    var originalXhr = $.ajaxSettings.xhr;
    $.ajaxSetup( {
        isLocal: true,
        progress: function(){  },
        xhr: function(){
            var req = originalXhr(), that = this;
            if( req ){
                if( typeof req.addEventListener == "function") {
                    req.upload.addEventListener( "progress", function( evt ){
                        that.progress( evt );
                    }, false );
                }
            }
            return req;
        }
    });
})( $ );