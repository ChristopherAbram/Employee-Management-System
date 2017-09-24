<div id="user_avatar">
    
    <div id="avatar">
        <img id="loading_avatar" src="{$home.link}/{$path.img}/loading_small.gif" width="50px" height="50px" style="display: none; width: 50px; height: 50px; position: absolute; left: 50%; top: 50%; margin-left: -25px; margin-top: -25px;" />
        <div class="progressbar"></div>
        {if isset({$current_user.avatar.miniature}) and !empty({$current_user.avatar.miniature})}
        <img id="avatar_image" src="{$current_user.avatar.miniature}" alt="avatar">
        {else}
        <img id="avatar_image" src="{$path.avatar}" alt="avatar">
        {/if}
        <input type="hidden" name="response" value="" />
    </div>
    
    <form id="uploadAvatar" class="uploadAvatar" action="{$home.link}/connector/save" method="post" >
        
        <div id="upload_panel" class="avatar_panel">
            {if !isset({$current_user.avatar.miniature}) or empty({$current_user.avatar.miniature})}
            <div class="uploadAvatarButton" id="uploadAvatarButton">Upload Image</div>
            <input type="file" id="getAvatar" name="files[]" />
            {else}
            <div class="uploadAvatarButton" id="deletebutton">Delete</div>
            {/if}
        </div>
        
    </form>
    
</div>

<script type="text/javascript" src="{$home.link}/scripts/js/informer.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/jquery.form.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/upload/avatar_uploader.js"></script>

<script type="text/javascript">  
$(document).ready(function(){
    
    // Uploader:
    var up2 = AvatarUploader({
        
        // HTML blocks:
        form:           $('#uploadAvatar'),
        filebutton:     $('#uploadAvatarButton'),
        fileinput:      $('#getAvatar'),
        deletebutton:   $('#deletebutton'),
        loading:        $('#loading_avatar'),
        element:        $('#avatar'),
        info:           $('#info'),
        
        // Request params:
        domain:         '{$home.link}',
        delete:         '{$home.link}/connector/delete',
        save:           '{$home.link}/imageconnector/save',
        input:          '', // an input type
        removeable:     false
        
    });
    
    // Run uploader:
    up2.run();
    
});
</script>