<form id="uploadForm" class="uploadForm" action="{$home.link}/connector/save" method="post" enctype="multipart/form-data">
    
    <div class="panel">
        <div class="uploadFileButton" id="uploadFileButton" style="margin: 10px;">Upload File &gt;</div>
        <input type="file" id="getFile" name="files[]" multiple="multiple" />
    </div>

    <section id="file_area">
        <section id="no_results" style="display: none; padding: 20px 0;" class="no_results">Select files and upload</section>
    </section>
    
</form>
    
    <div id="wait" style="display: none; margin: 20px 0 10px 0;">
        <img src="{$home.link}/{$path.img}/loading_small.gif" style="position: relative; left: 50%; margin-left: -25px;" />
    </div>
    
    <div id="more">More &gt;</div>

<script type="text/javascript" src="{$home.link}/scripts/js/informer.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/ListLoader.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/ListRunner.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/jquery.form.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/addprogress.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/uploader.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    
    var runner = new ListRunner({
        
        // Html blocks:
        morebutton:     $('#more'),
        noresults:      $('#no_results'),
        element:        $('#file_area'),
        info:           $('#info'),
        wait:           $('#wait'),
        
        // Define action for each result block:
        classifier:     '.tile',
        action:         function(index, e){ 
            //e.s
        },
        
        // Request parameters:
        count:          10,
        results:        '{$panel.link}/getfilelist',
        resultsexist:   '{$panel.link}/nextfilepageexists',
        parameters:     { removeable: 'false', input: '' }
        
    });
    
    // Run:
    runner.run();
    
    
    // Uploader:
    var up = Uploader({
        
        // HTML blocks:
        form:           $('#uploadForm'),
        filebutton:     $('#uploadFileButton'),
        fileinput:      $('#getFile'),
        element:        $('#file_area'),
        info:           $('#info'),
        
        // Request params:
        delete:         '{$home.link}/connector/delete',
        save:           '{$home.link}/connector/save',
        input:          '', // an input type
        removeable:     false
        
    });
    
    // Run uploader:
    up.run();
    
});
</script>