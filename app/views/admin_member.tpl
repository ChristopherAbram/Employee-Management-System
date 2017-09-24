
<section class="title">{$title}</section>

<section class="form">
    
    <form id="member" method="post" action="{$panel.link}/member/{$user.id}">
        
    <div style="float: left; margin: 0 10px 0 0; border: solid 1px #ddd;">
        {if isset($user.avatar) and isset($user.avatar.miniature)}
            <img src="{$user.avatar.miniature}" alt="avatar" width="250" height="250">
        {else}
            <img src="{$home.link}/{$path.img}/users.png" alt="avatar" width="250" height="250">
        {/if}
    </div>
    
    <div class="field">
        <span>{$firstname.title}</span>
        {$firstname.input}
        <span class="description">{$firstname.description}</span>
    </div>
    
    <div class="field">
        <span>{$lastname.title}</span>
        {$lastname.input}
        <span class="description">{$lastname.description}</span>
    </div>
    
    <div class="field">
        <span>{$email.title}</span>
        {$email.input}
        <span class="description">{$email.description}</span>
    </div>
    
    <div class="field">
        <span>{$citation.title}</span>
        {$citation.input}
        <span class="description">{$citation.description}</span>
    </div>
    
    <div class="field">
        <span>{$description_.title}</span>
        {$description_.input}
        <span class="description">{$description_.description}</span>
    </div>
    
    <div class="field">
        <span>{$bdate.title}</span>
        {$bdate.input}
        <span class="description">{$bdate.description}</span>
    </div>
    
    <div class="field">
        <span>{$cdate.title}</span>
        {$cdate.input}
        <span class="description">{$cdate.description}</span>
    </div>
    
    <div class="field">
        <span>{$phone.title}</span>
        {$phone.input}
        <span class="description">{$phone.description}</span>
    </div>
    
    <div class="field">
        <span>User role</span>
        <div style="overflow: hidden;">
            <div style="float: left; width: 200px;">{$administrator.input} {$administrator.title}</div>
            <div style="float: left; width: 200px;">{$publicist.input} {$publicist.title}</div>
            <div style="float: left; width: 200px;">{$plain.input} {$plain.title}</div>
        </div>
        <span class="description">{$plain.description}</span>
    </div>
    
    {if $user.role.access_level <= 1}
    <div class="field">
        <span>Choose category</span>
        <span class="description">This user can publish. Select categories, which are available for this user.</span>
        {$categories}
    </div>
    {/if}
    
    </form>
</section>