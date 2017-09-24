
var count = 10;
var listlink = 'http://abram.com/getcommentlist';
var countlink = 'http://abram.com/nextcommentpageexists';
var element = $('#comments_area');
var parameters = {'article_id' : 1};
var informer = $('#info');
var more = $('#more_comments');
var no_results = $('#no_results');

var classifier = '.comment';
var action = function(index, e){
    
};

function Loader(){
    
    var Info = new Informer(informer);
    
    this.onsuccess = function(){};
    
    this.onfailure = function(){};
    
    this.onerror = function(){};
    
    this.before = function(){};
    
    this.onload = function(){};
    
    var that = this;
    
    this.load = function(page, count){
        var formData = new FormData();
        $.ajax({
            url: listlink,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){ 
                that.before();
                formData.append('page', page);
                formData.append('count', count);
                formData.append('parameters', JSON.stringify(parameters));
            },
            success: function( response ){
                var status = response.status;
                
                if(status == 1 && response.content){
                    
                    // Parse html:
                    var html = $('<div>' + response.content + '</div>');
                    var elements = $(html).find(classifier);
                    
                    // Bind actions to appended content:
                    $(elements).each(action);
                    
                    // Append response content:
                    element.append(html);
                    
                    that.onsuccess();
                }
                else if(status == 2){
                    // Show error messages (if any exists):
                    if(response.messages.error && Array.isArray(response.messages.error)){
                        informer.attr('class', 'informer error');
                        response.messages.error.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                    that.onfailure();
                }
                that.onload();
                //console.log(JSON.stringify(response));
            },
            error: function( jqXHR, textStatus, errorThrown ){
                informer.attr('class', 'informer error');
                Info.throwInfo( 'An error has occurred while getting comments' );
                that.onerror();
            }
        });
    };
    
    this.hasNext = function(page, count){
        var formData = new FormData();
        var ret = false;
        $.ajax({
            url: countlink,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){ 
                formData.append('page', page);
                formData.append('count', count);
                formData.append('parameters', JSON.stringify(parameters));
            },
            success: function( response ){
                var status = response.status;
                if(status == 1){
                    // There are more results:
                    that.next = true;
                }
                else {
                    that.next = false;
                }
                that.oncheck();
            },
            error: function( ){
                //informer.attr('class', 'informer error');
                //Info.throwInfo( 'An error has occurred' );
            }
        });
        return ret;
    };
    
    this.next = false;
    
    this.oncheck = function(){};
    
    return this;
}

$(document).ready(function(){
    var page = 1;
    var loader = new Loader();
    
    loader.before = function(){
        //Hide button before send:
        more.hide();
    };
    
    loader.onsuccess = function(){
        // Increment result page:
        page++;
        // Check if there are more results:
        loader.hasNext(page, count);
    };
    
    loader.oncheck = function(){
        if(this.next){
            // Show button if there are more results:
            more.show();
        }
        else {
            // Otherwise hide button:
            more.hide();
        }
    };
    
    more.on('click', function(){
        // Load next page:
        loader.load(page, count);
    });
    
    
    // Create new loader instance for checking if there are any results at all:
    var loader1 = new Loader();
    loader1.oncheck = function(){
        if(this.next){
            // Load first page:
            loader.load(page, count);
        }
        else {
            // Show message there is no results:
            no_results.show();
        }
    };
    
    // Run:
    loader1.hasNext(page, count);
    
});