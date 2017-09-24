<form action="{$home.link}/connector/save" method="post" enctype="multipart/form-data">
    <div class="panel">
        <div class="uploadFileButton" id="uploadFileButton" style="margin: 10px;">Upload File &gt;</div>
        <input type="file" id="getFile" name="files[]" multiple="multiple" />
    </div>
    
    <div class="progress">
        <div class="bar"></div >
        <div class="percent"></div >
    </div>
    
    <div id="wait">
        <div class="info" id="empty">Select files and upload</div>
    </div>
    
    <div id="status"></div>
    <div id="debug"></div>
</form>
            
<script type="text/javascript" src="{$home.link}/scripts/js/upload/jquery.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/jquery.form.js"></script>
<script type="text/javascript">

$( 'form' ).submit( function(){
    event.preventDefault( );
    return false;
} );

$( '#uploadFileButton' ).bind( {
    click : function( ){
        $( '#getFile' ).click();
    }
} );

var bar = $('.bar');

(function addXhrProgressEvent($) {
    var originalXhr = $.ajaxSettings.xhr;
    $.ajaxSetup({
        progress: function() { console.log("standard progress callback"); },
        xhr: function() {
            var req = originalXhr(), that = this;
            if (req) {
                if (typeof req.addEventListener == "function") {
                    req.upload.addEventListener("progress", function(evt) {
                        that.progress(evt);
                    },false);
                }
            }
            return req;
        }
    });
})($);

function send( file, block ){
    var interval = 1;
    if( window.FormData ){
        var formData = new FormData( );
        formData.append( 'files[0]', file );
        $.ajax( {
            url: '{$home.link}/connector/save',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            progress: function(e) {
                var percentage = e.loaded / e.total * 100;
                var bar = $( block ).find( '.bar' );
                bar.width( percentage + "%" );
            },
            beforeSend: function(){
                var wait = $( '#wait' );
                wait.html( '' );
            },
            success: function( response ){
                // Extract response:
                if(Array.isArray(response)){
                    response = response[0];
                }
                
                var bar = $( block ).find( '.bar' );
                var img = $( block ).find( 'img' );
                var message = $( block ).find( '.responseMessage' );
                
                // Store response:
                var res = $(block).find( 'input[name="response"]' );
                $(res).val(JSON.stringify(response));
                
                // Change img:
                if(response.image && response.image != ''){
                    $(img).attr('src', response.image);
                }
                
                // Find remove button:
                var remove = $(block).find( 'input[name="remove[]"]' );
                
                remove.click( function( e ){
                    var formData = new FormData( );
                    
                    formData.append('remove[]', response.id);
                    $.ajax( {
                        url: '{$home.link}/connector/delete',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function( response ){
                            var message = $( block ).find( '.responseMessage' );

                            var clas = '';
                            if( response.status == 0 ) clas = 'err';
                            else if( response.status == 1 ) clas = 'info';
                            else if( response.status == 2 ) clas = 'ok';
                            $( message ).attr( 'class', 'responseMessage ' + clas );

                            message.html( response.message );

                            if( response.status != 0 ){
                                //block.fadeOut( 300, 'linear', function( ){ $(block).remove( ) } );
                                window.setTimeout( function(){ $( block ).fadeOut( 300, 'linear', function(){ this.remove( ) } ) }, interval * 1000 );
                            }
                        },
                        error: function( jqXHR, textStatus, errorThrown ){
                            $( block ).find( '.responseMessage' );

                            var response = JSON.parse(jqXHR.responseText);
                            if(Array.isArray(response)){
                                response = response[0];
                            }

                            var clas = '';
                            if( response.status == 0 ) clas = 'err';
                            else if( response.status == 1 ) clas = 'info';
                            else if( response.status == 2 ) clas = 'ok';
                            $( message ).addClass( clas );

                            message.html( response.message );
                            block.fadeOut( 300, 'linear', function( ){ this.remove( ) } );
                        }
                    } );
                    event.preventDefault( );
                    return false;
                } );

                window.setTimeout( function(){ 
                    bar.width( 0 + '%' ); 
                    img.fadeTo( 250, 1 );

                    var clas = '';
                    if( response.status == 0 ) clas = 'err';
                    else if( response.status == 1 ) clas = 'info';
                    else if( response.status == 2 ) clas = 'ok';
                    $( message ).addClass( clas );

                    message.html( response.message );

                    if( response.status == 0 ){
                        window.setTimeout( function(){ $( block ).fadeOut( 300, 'linear', function(){ this.remove( ) } ) }, interval * 3 * 1000 );
                    }
                }, interval * 1000 );
            },
            error : function( jqXHR, textStatus, errorThrown ){
                var bar = $( block ).find( '.bar' );
                var img = $( block ).find( 'img' );
                var message = $( block ).find( '.responseMessage' );
                
                var response = JSON.parse(jqXHR.responseText);
                if(Array.isArray(response)){
                    response = response[0];
                }
                
                var clas = '';
                if( response.status == 0 ) clas = 'err';
                else if( response.status == 1 ) clas = 'info';
                else if( response.status == 2 ) clas = 'ok';
                $( message ).addClass( clas );

                message.html( response.message );
                
                //console.log(response.message);

                window.setTimeout( function(){ 
                    bar.width( 0 + '%' ); 
                    img.fadeTo( 250, 1 );

                    //message.html( textStatus );
                    window.setTimeout( function(){ $( block ).fadeOut( 300, 'linear', function(){ this.remove( ) } ) }, interval * 3 * 1000 );
                }, interval * 1000 );
            }
        } );
    }
}

(function() {
    
var percent = $('.percent');
var empty = $( '#empty' );
var wait = $( '#wait' );
var debug = $( '#debug' );
var getFile = $( '#getFile' );
var status = $( '#status' );

getFile.bind( {
    change : function( ){
        var files = this.files;

        if( window.FileReader ){
            for( var i = 0; f = files[i]; i++ ){
                if( f.type.match( 'image.*' ) ){
                    var reader = new FileReader( );
                    reader.onload = (function( file ){
                        return function( e ){
                            var div = $( '<div>' );
                            div.addClass( 'tile' );
                            div.html( [ 
                                '<div class="imgContener">',
                                    '<div class="cross">',
                                            '<input type="text" name="file_name" value="' + file.name + '" class="file_name" readonly="readonly" />',
                                    '<input type="submit" name="remove[]" value="" class="close" title="Remove" />',
                                '</div>',
                                    '<img class="thumb" src="' + e.target.result + '" title="' + file.name + '" />',
                                '</div>',
                                '<div class="progress">',
                                    '<div class="bar"></div>',
                                    '<input type="hidden" name="response" value=\'\' />',
                                    '<div class="responseMessage"></div>',
                                '</div>',
                            ].join( '' ) );
                            $(div).find('img').fadeTo(250, 0.33);
                            status.prepend( div );
                            $(div).find( 'input[name="remove[]"]' ).bind({
                                submit: function( e ){
                                    event.preventDefault();
                                    return false;
                                } 
                            });
                            send( file, div );
                        };
                    })( f );
                    // read the image file :
                    reader.readAsDataURL( f );
                } else {
                    var div = $( '<div>' );
                    div.addClass( 'tile' );
                    div.html( [ 
                        '<div class="imgContener">',
                            '<div class="cross">',
                                '<input type="text" name="file_name" value="' + f.name + '" class="file_name" />',
                            '<input type="submit" name="remove[]" value="" class="close" title="Remove" />',
                        '</div>',
                            '<img class="thumb" src="" title="' + f.name + '" />',
                        '</div>',
                        '<div class="progress">',
                            '<div class="bar"></div>',
                            '<div class="responseMessage">',
                                '<input type="hidden" name="response" value=\'\' />',
                            '</div>',
                        '</div>',
                    ].join( '' ) );
                    $( div ).find( 'img' ).fadeTo(250, 0.33);
                    status.prepend( div );

                    $( div ).find( 'input[name="remove[]"]' ).bind( {
                        submit: function( e ){
                            event.preventDefault( );
                            return false;
                        } 
                    } );
                    send(f, div);
                }
            }
        }
        $( getFile ).val( '' );
    }
});
})();       
</script>