
function Informer(jqObj){
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
};