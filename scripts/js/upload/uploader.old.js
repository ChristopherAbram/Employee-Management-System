//$( document ).ready( function(){
    ////////////////////////////////////////////
    /*var Informer = (function Informer(jqObj){
        var obj = jqObj;
        this.throwInfo = function( msg, state ){
            $( obj ).html( msg )
            .fadeIn( 1000, function( ){ 
                window.setTimeout( function( ){ 
                    $( obj ).fadeOut( 1000 );
                }, 2000 );
            });
        };
        return this;
    })($( '.sent' ));*/
    ////////////////////////////////////////////

    /*var amount = 20;
    var sent = $( '.sent' );
    var more = $( '#more' );
    var status = $( '#status' );

    ////////////////////////////////////////////
    var get = ( function getResults( ){
        var nextExists = true;
        var resultsExists = false;
        var limit = result_count;
        var position = 0;

        this.results_exists = function( ){
            return resultsExists;
        };

        this.next_exists = function( lim ){
            var formData = new FormData();
            
            $.ajax( {
                url: browser_link,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    formData.append( 'countNext', 1 );
                    formData.append( 'position', position );
                    formData.append( 'limit', lim );
                },
                success: function( response ){
                    //console.log('Count: ' + response.count);
                    if( response.count <= 0 ){
                        hideNextResultButton();
                    }
                }
            });
        };

        this.next = function ( lim ){
            var formData = new FormData();
            var interval = 1;

            //formData.append( 'position', position );
            //formData.append( 'limit', lim );
            $.ajax( {
                url: browser_link,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    
                    formData.append( 'position', position );
                    formData.append( 'limit', lim );
                    
                    //console.log('Position: ' + position);
                    
                    var wait = $( '#wait' );
                    wait.html( '<div style="margin: 20px 0 10px 0;">' + 
                               '<img src="' + loading_link + '" style="position: relative; left: 50%; margin-left: -25px;" />' + 
                               '<br /><div class="info">Wait...</div>' + 
                               '</div>' );
                    hideNextResultButton();
                },
                complete: function( ){
                    var wait = $( '#wait' );
                    wait.html( '' );
                    showNextResultButton();
                },
                success: function( response ){
                    var status = $( '#status' );
                    var res = $( '<div>' );
                    
                    res.append( response );
                    var elements = $( res ).find( '.tile' );
                    status.append( res );
                    
                    $( elements ).each( function( index, block ){
                        
                        // Get close button:
                        var remove = $( block ).find( '.close' );
                        
                        // Add input:
                        var tools = $( block ).find( '.cross' );
                        tools.append(toolInput(input_option, 'file[]', remove.attr('value')));

                        remove.bind( {
                            click: function( e ){
                                var formData = new FormData();
                                formData.append('remove[]', this.value);
                                $.ajax( {
                                    url: delete_link,
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function( response ){
                                        var message = $( block ).find( '.responseMessage' );
                                        
                                        status = parseInt(response.status);
                                        
                                        var clas = '';
                                        if( status === 0 ) clas = 'err';
                                        else if( status === 1 ) clas = 'info';
                                        else if( status === 2 ) clas = 'ok';
                                        $( message ).attr( 'class', 'responseMessage ' + clas );

                                        message.html( response.message );

                                        if( status > 0 ){
                                            //position = position - 1;
                                            window.setTimeout( function(){ 
                                                $( block ).fadeOut( 300, 'linear', function(){ 
                                                    //next( 1 ); 
                                                    this.remove(); 
                                                }); 
                                            }, interval * 1000);
                                        }
                                    },
                                    error: function( jqXHR, textStatus, errorThrown ){
                                        $( block ).find( '.responseMessage' );
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
                                        block.fadeOut( 300, 'linear', function( ){ this.remove( ); } );
                                    }
                                } );
                                event.preventDefault( );
                                return false;
                            }
                        });
                    });
                    position += lim;
                    get.next_exists( lim );
                }
            });
        };
        return this;
    })();*/

    ////////////////////////////////////////////
	
    /*( function( ){
        var resultsExists = false;
        var formData = new FormData( );
        formData.append( 'count', 1 );

        $.ajax( {
            url: browser_link,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){ },
            success: function( response ){
                if( response.count ){
                    if( response.count > 0 ) resultsExists = true;
                    else resultsExists = false;
                } else resultsExists = false;
                
                //console.log('Count: ' + response.count);
                
                if( resultsExists ){
                    get.next( result_count );

                    var button = $( '<div>' );
                    button.attr( 'id', 'nextResultsButton' );					
                    button.html( 'Get next &gt;' );
                    button.bind({
                        click: function( ){
                            get.next( result_count );
                        }
                    });
                    more.append( button );
                } else Informer.throwInfo( 'No results...', 1 );
            },
            error: function( ){
                Informer.throwInfo( 'No results...', 1 );
            }
        });
    })();*/




// Remove action:

/*var remove = $( block ).find( 'input[name="remove[]"]' );
                        remove.attr('value', response.id);
                        remove.attr( 'name', remove.attr( 'name' ) + '_' + response.id );
                        remove.click( function( e ){
                            var formData = new FormData();
                            //formData.append( 'file_id_' + response.id, response.id );
                            //formData.append( 'remove_file_' + response.id, response.id );
                            
                            formData.append('remove[]', response.id);
                            
                            $.ajax( {
                                url: delete_link,
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
                        } );*/

