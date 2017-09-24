// JavaScript Document
/* 12.07.2014 */
/* Krzysztof Abram */

function AvatarUploader(options){
    
    // Default parameters:
    var form            = null;
    var file_input      = null;
    var file_button     = null;
    var delete_link     = '';
    var save_link       = '';
    var input_option    = null;
    var element         = null;
    var info            = null;
    var removeable      = null;
    var del_button      = null;
    var loading         = null;
    var domain          = null;
    
    // Extracting options:
    if(options.domain) domain = options.domain;
    if(options.form) form = options.form;
    if(options.fileinput) file_input = options.fileinput;
    if(options.filebutton) file_button = options.filebutton;
    if(options.deletebutton) del_button = options.deletebutton;
    if(options.delete) delete_link = options.delete;
    if(options.save) save_link = options.save;
    if(options.input) input_option = options.input;
    if(options.element) element = options.element;
    if(options.info) info = options.info;
    if(options.removeable) removeable = options.removeable;
    if(options.loading) loading = options.loading;
    
    var that = this;
    
    
    //jQuery.mobile.allowCrossDomainPages = true;
    
    // Construct:
    function init(){
        // Submit:
        form.submit( function(){
            //event.preventDefault();
            return true;
        });
        
        // File send button:
        file_button.bind({
            click : function(){
                file_input.click();
            }
        });
    };
    
    init();
    
    function toolInput(type, name, value){
        return type ? '<input type="' + type + '" name="' + name + '" value="' + value + '" />' : '';
    }
    
    function show_delete_button(){
        $('#avatar_image').fadeTo(250, 1);
        loading.css('display', 'none');
        del_button.css('display', 'inline-block');
    }

    function hide_delete_button(){
        $('#avatar_image').fadeTo(250, 0.33);
        loading.css('display', 'block');
        del_button.css('display', 'none');
    }

    function show_default_avatar(){
        var img = $('#avatar_image');
        loading.css('display', 'none');
        img.fadeTo(250, 0, function(){
            img.attr('src', domain + '/app/img/user_default.png');
            img.fadeTo(250, 1, function(){
                $('#upload_panel').html([
                    '<div class="uploadAvatarButton" id="uploadAvatarButton">Upload Image</div>',
                    '<input type="file" id="getAvatar" name="files[]" />'
                ].join(''));
                
                file_input = $('#getAvatar');
                file_input.css('display', 'none');
                file_button = $('#uploadAvatarButton');
                init();
                
                // Run uploader:
                that.run();

            });
        });

    }

    function deleteAvatar(){
        var info = $('#info');
        var Info = new Informer(info);
        var fm = new FormData();
        $.ajax( {
            url: domain + '/panel/deleteavatar',
            type: 'POST',
            processData: false,
            contentType: false,

            beforeSend: function(){
                hide_delete_button();
            },

            complete: function( jqXHR, textStatus ){
                //console.log(jqXHR.responseText);
            },

            success: function( response ){
                var status = response.status;
                if(status == 1){
                    show_default_avatar();
                    if(response.messages.correct && Array.isArray(response.messages.correct)){
                        info.attr('class', 'informer correct');
                        response.messages.correct.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                }
                else if(status == 2){
                    show_delete_button();
                    if(response.messages.error && Array.isArray(response.messages.error)){
                        info.attr('class', 'informer error');
                        response.messages.error.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                }
            },

            error : function( jqXHR, textStatus, errorThrown ){
                show_delete_button();
                info.attr('class', 'informer error');
                Info.throwInfo( jqXHR.statusText );
            }
        });
    }

    // File iterator:
    function filesContener( fileInputObject ){
        this.files;
        this.blocks = [ ];
        var index = 0;

        // construct :
        this.init = function( ){
            //(function getFile( ){
            files = fileInputObject.files;
        };
        this.nextFile = function( ){
            index++;
            if( this.files[ index ] ){
                return this.files.item( index );
            } else index = this.files.length - 1;
            return false;
        };
        this.currentFile = function( ){
            if( this.files[ index ] ){
                return this.files.item( index );
            } else {}
            return false;
        };
        this.prevFile = function( ){
            index--;
            if( this.files[ index ] ){
                return this.files.item( index );
            } else index = 0;
            return false;
        };
        this.reset = function( ){
            index = 0;
            return true;
        };
        this.end = function( ){
            index = this.files.length;
            return true;
        };
        this.ix = function( ){
            return index;
        };
        this.onload = function( ){
            if( index === this.files.length ){
                this.onload( );
            }
        };
        return this;
    }
    
    function setUserAvatar(id){
        
        var info = $('#info');
        var Info = new Informer(info);
        var f = new FormData();
        
        $.ajax( {
            url: domain + '/panel/setuseravatar',
            type: 'POST',
            data: f,
            processData: false,
            contentType: false,

            beforeSend: function(){
                f.append('id', id);
            },

            complete: function( jqXHR, textStatus ){
                //console.log(jqXHR.responseText);
            },

            success: function( response ){
                var status = response.status;
                if(status == 1){
                    
                    $('#avatar_image').fadeTo(250, 1);
                    $('#upload_panel').html('<div class="uploadAvatarButton" id="deletebutton">Delete</div>');
                    del_button.css('display', 'inline-block');
                    $('#deletebutton').bind({click: deleteAvatar});
                    
                    if(response.messages.correct && Array.isArray(response.messages.correct)){
                        info.attr('class', 'informer correct');
                        response.messages.correct.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                    
                }
                else if(status == 2){
                    
                    show_default_avatar();
                    
                    if(response.messages.error && Array.isArray(response.messages.error)){
                        info.attr('class', 'informer error');
                        response.messages.error.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                }
            },

            error : function( jqXHR, textStatus, errorThrown ){
                info.attr('class', 'informer error');
                Info.throwInfo( jqXHR.statusText );
            }
        });
    }// end setUserAvatar
    
    // File sender:
    function sendHandler( fContener ){
        
        // File iterator:
        var contener = fContener;
        var index = 0;
        var interval = 1;
        var Info = $('#info');
        var informer = new Informer(Info);
        // This reference:
        var that = this;

        // Send action:
        this.send = function( ){
            if( window.FormData ){
                var formData = new FormData( );
                
                $.ajax( {
                    url: save_link,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    progress: function(e) {
                        var percentage = e.loaded / e.total * 100;
                        var bar = $(contener.blocks[contener.ix()]).find( '.progressbar' );
                        bar.width( percentage + "%" );
                    },

                    beforeSend: function(){
                        // Append request content:
                        var bar = $( contener.blocks[contener.ix()]).find( '.progressbar' );
                        bar.css('display', 'block');
                        file_button.css('display', 'none');
                        formData.append( 'files[0]', contener.currentFile( ) );
                        index++;
                    },

                    complete: function( jqXHR, textStatus ){
                        
                        var response = JSON.parse(jqXHR.responseText);
                        // Hide progress bar:
                        var bar = $( contener.blocks[contener.ix()]).find( '.progressbar' );
                        bar.css('display', 'none');
                        // Send next file if exists:
                        if( contener.prevFile( ) ) that.send( );
                        // Invoke onsend action at the end:
                        if( index === contener.files.length ) that.onsend( );
                    },

                    success: function( response ){
                        
                        // Extract response:
                        if(Array.isArray(response)){
                            response = response[0];
                        }
                        
                        // Current block :
                        var block = contener.blocks[contener.ix()];
                        
                        // Append response string:
                        var res = $(block).find('input[name="response"]');
                        $(res).val(JSON.stringify(response));
                        
                        // Append file image:
                        var img = $( '#avatar_image' );
                        if( response.image && response.image !== '' ){
                            $(img).attr('src', response.image);
                        }
                        
                        if( response.status === 0 ) clas = 'error';
                        else if( response.status === 1 ) clas = 'warning';
                        else if( response.status === 2 ) clas = 'correct';
                        
                        if(response.status === 2){
                            setUserAvatar(response.id);
                        } else {
                            show_default_avatar();
                            Info.attr('class', 'informer ' + clas);
                            informer.throwInfo(response.message);
                        }
                    },

                    error : function( jqXHR, textStatus, errorThrown ){
                        file_button.css('display', 'block');
                        Info.attr('class', 'informer error');
                        informer.throwInfo(jqXHR.statusText);
                    }
                });
            }
        };
        this.onsend = function(){};
        return this;
    }
    
    // Load images from device:
    function loadFilesList( fContener, block ){
        
        // File iterator:
        var contener = fContener;
        // DOM storage:
        var status = block;
        var progress = 0;
        // Reference to this:
        var that = this;
        var informer = new Informer($('#info'));
        
        this.load = function( ){
            var f = contener.currentFile( );
            if( f ){
                // If file is an image:
                if( f.type.match( 'image.*' ) && window.FileReader ){
                    // Create file reader instance:
                    var reader = new FileReader( );
                    
                    // Define onload action:
                    reader.onload = ( function ( file, contener ){ 
                        return function( e ){
                            
                            var img = $( '<img>' );
                            img.attr('src', e.target.result);
                            img.attr('id', 'avatar_image');
                            
                            var bar = $('<div>');
                            bar.addClass('progressbar');
                            
                            var hidden_input = $('<input>');
                            hidden_input.attr('type', 'hidden');
                            hidden_input.attr('name', 'response');
                            
                            // Hide image element:
                            img.fadeTo( 0, 0 );
                            
                            // Add element at the begining:
                            status.html('');
                            status.prepend(hidden_input);
                            status.prepend(img);
                            status.prepend(bar);
                            
                            // Show image:
                            img.fadeTo( 250, 0.33, function( ){
                                // Prevent remove button submition:
                                /*$( div ).find( 'input[name="remove[]"]' ).bind( {
                                    submit: function( e ){
                                        event.preventDefault( );
                                        return false;
                                    } 
                                });*/
                                
                                window.setTimeout( function( ){ 
                                    // Load next file:
                                    //if( contener.nextFile( ) ) that.load( );
                                    contener.blocks[ progress++ ] = element;
                                    // Call onload if loading end:
                                    if( progress === contener.files.length ) that.onload( );
                                }, 0 );
                            });
                            
                        };
                    })(f, contener);
                    
                    // Read data:
                    reader.readAsDataURL(f);
                } else {
                    
                    $('#info').attr('class', 'informer error');
                    informer.throwInfo('Forbidden file type', 2);
                    
                }
            }
        };
        this.onload = function(){};
        return this;
    }
    
    this.run = function(){
        // File input:
        var getFile = file_input;
        // DOM storage:
        var status = element;
        // Informer object:
        var informer = new Informer(info);
        
        getFile.bind( {
            change : function( ){
                // Initialize file contener:
                var contener = filesContener( this );
                contener.init( );
                
                // Initialize file loader:
                var list = loadFilesList( contener, status );
                var up = new sendHandler(contener);
                
                // Onload list action:
                list.onload = ( function( up ){
                    return function( ){
                        // Onsend action:
                        up.onsend = function( ){
                            $( getFile ).val( '' );
                        };
                        // Send files:
                        up.send( );
                    };
                } )( up );
                // Load list:
                list.load( );
            }
        });
        
        del_button.bind({
            click: deleteAvatar
        });
    };
    return this;
}// end Uploader  