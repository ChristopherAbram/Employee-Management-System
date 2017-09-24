
function ListRunner(options){
    
    // Result pare page:
    var count = 10;
    // More results button:
    var more = {};
    // No results block object:
    var no_results = {};
    // Wait block:
    var wait = {};
    
    // Init parameters:
    if(options.count) count = options.count;
    if(options.morebutton) more = options.morebutton;
    if(options.noresults) no_results = options.noresults;
    if(options.wait) wait = options.wait;
    
    this.run = function(){
        var page = 1;
        var loader = new ListLoader(options);

        loader.before = function(){
            //Hide button before send:
            more.hide();
            // Show loading:
            wait.show();
        };
        
        loader.beforecheck = function(){
            //Hide button before send:
            more.hide();
            // Show loading:
            wait.show();
        };

        loader.onsuccess = function(){
            // Increment result page:
            page++;
            // Check if there are more results:
            loader.hasNext(page, count);
        };
        
        loader.onload = function(){
            //wait.hide();
        };

        loader.oncheck = function(){
            wait.hide();
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
        var loader1 = new ListLoader(options);
        // Show loading:
        wait.show();
        loader1.oncheck = function(){
            wait.hide();
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
    };
    return this;
}