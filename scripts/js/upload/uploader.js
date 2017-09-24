// JavaScript Document
/* 12.07.2014 */
/* Krzysztof Abram */

function Uploader(options){
    
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
    
    // Extracting options:
    if(options.form) form = options.form;
    if(options.fileinput) file_input = options.fileinput;
    if(options.filebutton) file_button = options.filebutton;
    if(options.delete) delete_link = options.delete;
    if(options.save) save_link = options.save;
    if(options.input) input_option = options.input;
    if(options.element) element = options.element;
    if(options.info) info = options.info;
    if(options.removeable) removeable = options.removeable;
    
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
    
    // File sender:
    function sendHandler( fContener ){
        
        // File iterator:
        var contener = fContener;
        var index = 0;
        var interval = 1;
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
                        var bar = $( contener.blocks[contener.ix()]).find( '.bar' );
                        bar.width( percentage + "%" );
                    },

                    beforeSend: function(){
                        // Append request content:
                        formData.append( 'files[0]', contener.currentFile( ) );
                        index++;
                    },

                    complete: function( jqXHR, textStatus ){
                        // Send next file if exists:
                        if( contener.prevFile( ) ) that.send( );
                        // Invoke onsend action at the end:
                        if( index === contener.files.length ) that.onsend( );
                    },

                    success: function( response ){
                        
                        //console.log(JSON.stringify(response));
                        console.log(JSON.stringify(response));
                        
                        // Extract response:
                        if(Array.isArray(response)){
                            response = response[0];
                        }
                        
                        // Current block :
                        var block = contener.blocks[ contener.ix( ) ];
                        
                        // Get elements:
                        var bar = $( block ).find( '.bar' );
                        var img = $( block ).find( 'img' );
                        var message = $( block ).find( '.responseMessage' );
                        
                        // Append response string:
                        var res = $( block ).find( 'input[name="response"]' );
                        $( res ).val( JSON.stringify( response ) );
                        
                        // Append file image:
                        if( response.image && response.image !== '' ){
                            $( img ).attr( 'src', response.image );
                        }
                        
                        // Change response identifier:
                        var check = $( block ).find( 'input[name="file[]"]' );
                        check.attr( 'value', response.id );
                        check.val( response.id );

                        
                        window.setTimeout( function(){ 
                            bar.width( 0 + '%' ); 
                            img.fadeTo( 250, 1 );
                            
                            // Set response class:
                            var clas = '';
                            if( response.status === 0 ) clas = 'err';
                            else if( response.status === 1 ) clas = 'info';
                            else if( response.status === 2 ) clas = 'ok';
                            $( message ).addClass( clas );
                            
                            // Append message to html:
                            message.html( response.message );

                            if( response.status === 0 ){
                                window.setTimeout( function(){ $( block ).fadeOut( 300, 'linear', function(){ this.remove(); } ); }, interval * 3 * 1000 );
                            }
                        }, interval * 1000 );
                    },

                    error : function( jqXHR, textStatus, errorThrown ){
                        
                        // Current block :
                        var block = contener.blocks[ contener.ix( ) ];
                        
                        var bar = $( block ).find( '.bar' );
                        var img = $( block ).find( 'img' );
                        var message = $( block ).find( '.responseMessage' );
                        
                        var response = JSON.parse(jqXHR.responseText);
                        if(Array.isArray(response)){
                            response = response[0];
                        }
                        
                        // Set response class:
                        var clas = '';
                        if( response.status === 0 ) clas = 'err';
                        else if( response.status === 1 ) clas = 'info';
                        else if( response.status === 2 ) clas = 'ok';
                        $( message ).addClass( clas );
                        
                        // Append message to html:
                        message.html( response.message );
                        
                        window.setTimeout( function(){ 
                            bar.width( 0 + '%' ); 
                            img.fadeTo( 250, 1 );

                            //message.html( textStatus );
                            window.setTimeout( function(){ $( block ).fadeOut( 300, 'linear', function(){ this.remove( ); } ); }, interval * 3 * 1000 );
                        }, interval * 1000 );
                    }
                });
            }
        };
        this.onsend = function(){};
        return this;
    }
    
    function tile(filename, input_option, result){
        return [
            '<div class="imgContener">',
                '<div class="cross">',
                    '<input type="text" name="file_name" value="' + filename + '" class="file_name" readonly="readonly" />',
                    input_option ? toolInput(input_option, 'file[]', '') : '',
                    removeable ? '<input type="submit" name="remove[]" value="" class="close" title="Remove" />' : '',
                '</div>',
                '<img class="thumb" src="' + result + '" title="' + filename + '" />',
            '</div>',
            '<div class="progress">',
                '<div class="bar"></div>',
                '<input type="hidden" name="response" value=\'\' />',
                '<div class="responseMessage"></div>',
            '</div>'
        ];
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
                            
                            // Prepend file representation to the html:
                            var div = $( '<div>' );
                            div.addClass( 'tile' );
                            div.html(tile(file.name, input_option, e.target.result).join( '' ));
                            
                            // Hide image element:
                            var img = $( div ).find( 'img' ).fadeTo( 0, 0 );
                            
                            // Add element at the begining:
                            status.prepend( div );
                            
                            // Show image:
                            img.fadeTo( 250, 0.33, function( ){
                                // Prevent remove button submition:
                                $( div ).find( 'input[name="remove[]"]' ).bind( {
                                    submit: function( e ){
                                        event.preventDefault( );
                                        return false;
                                    } 
                                });
                                
                                window.setTimeout( function( ){ 
                                    // Load next file:
                                    if( contener.nextFile( ) ) that.load( );
                                    contener.blocks[ progress++ ] = div;
                                    // Call onload if loading end:
                                    if( progress === contener.files.length ) that.onload( );
                                }, 0 );
                            });
                        };
                    })( f, contener );
                    
                    // Read data:
                    reader.readAsDataURL( f );
                } else {
                    
                    // Prepend file representation to the html:
                    var div = $( '<div>' );
                    div.addClass( 'tile' );
                    div.html(tile(f.name, input_option, '').join( '' ));

                    // Hide image element:
                    var img = $( div ).find( 'img' ).fadeTo( 0, 0 );
                    
                    // Add element at the begining:
                    status.prepend( div );
                    
                    $( div ).find( 'input[name="remove[]"]' ).bind( {
                        submit: function( e ){
                            event.preventDefault( );
                            return false;
                        }
                    });
                    window.setTimeout( function( ){ 
                        // Load next file:
                        if( contener.nextFile( ) ) that.load( );
                        contener.blocks[ progress++ ] = div;
                        // Call onload if loading end:
                        if( progress === contener.files.length ) that.onload( );
                    }, 0);
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
                            informer.throwInfo( 'Done', 0 );
                        };
                        // Send files:
                        up.send( );
                    };
                } )( up );
                // Load list:
                list.load( );
            }
        });
    };
    return this;
}// end Uploader  