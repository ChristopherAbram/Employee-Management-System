
function ListLoader(options){
    
    // Deafault vars:
    // Result link:
    var listlink = '';
    // Check for result existance link:
    var countlink = '';
    // Results container:
    var element = {};
    // Additional request parameters:
    var parameters = {};
    // Informer block object:
    var info = {};
    // List element class:
    var classifier = '';
    // Action to be bound to each element of class 'calssifier':
    var action = function(index, e){};
    
    // Init parameters:
    if(options.results) listlink = options.results;
    if(options.resultsexist) countlink = options.resultsexist;
    if(options.element) element = options.element;
    if(options.parameters) parameters = options.parameters;
    if(options.info) info = options.info;
    if(options.classifier) classifier = options.classifier;
    if(options.action) action = options.action;
    
    var Info = new Informer(info);
    
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
                        info.attr('class', 'informer error');
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
                
                console.log(JSON.stringify(jqXHR.status));
                
                info.attr('class', 'informer error');
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
                that.beforecheck();
                formData.append('page', page);
                formData.append('count', count);
                formData.append('parameters', JSON.stringify(parameters));
            },
            success: function( response ){
                //console.log(JSON.stringify(response));
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
    
    this.beforecheck = function(){};
    this.oncheck = function(){};
    
    return this;
}