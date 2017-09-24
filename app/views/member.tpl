<style type="text/css">
    
#member_info {
    width: 750px;
    margin: 0 auto;
}
    
#member_info .avatar_image, #member_info .username {
    float: left;
}

#member_info .avatar_image, #member_info .avatar_image img {
    width: 250px;
    height: 250px;
    border-radius: 125px;
}

#member_info .avatar_image {
    border: solid 1px #ddd;
}

#member_info .username {
    width: 475px;
    font-size: 90px;
    line-height: 100%;
    letter-spacing: -8px;
    padding-left: 20px;
    padding-top: 30px;
    overflow: visible;
}

#member_info .quote {
    text-align: center;
    width: 100%;
    display: block;
    position: relative;
    color: #999;
    font-style: italic;
    font-size: 25px;
    margin: 20px 0;
}

#member_info .quote:before {
    position: absolute;
    top: -20px;
    left: -0px;
    content: "\201C";
    font-size: 80px;
    font-family: Arial;
}

#member_info .description {
    width: 75%;
    margin: 0 auto;
}

@media screen and (max-width: 750px){
    #member_info {
        width: 250px;
        margin: 0 auto;
    }
    
    #member_info .username {
        width: 250px;
        height: 110px;
        text-align: center;
        font-size: 50px;
        letter-spacing: -4px;
        padding-left: 0;
        padding-top: 20px;
        overflow: visible;
    }
    
    #member_info .quote {
        font-size: 20px;
        margin: -20px 0 30px 0;
        padding-left: 0px;
    }

    #member_info .quote:before {
        position: relative;
        left: -10px;
        top: 20px;
        content: "\201C";
        font-size: 80px;
        font-family: Arial;
    }
    
    #member_info .description {
        width: 100%;
    }
    
}

</style>


<div id="member_info">
    <div style="width: 100%; overflow: hidden;">
        <div class="avatar_image">
            <img src="{$user.avatar.miniature}" alt="avatar">
        </div>
        
        <div class="username">
            {$user.firstname}<br><b>{$user.lastname}</b>
        </div>
    </div>
        
    {if !empty($user.citation)}
    <div class="quote">
        {$user.citation}
    </div>
    {/if}
    
    {if !empty($user.description)}
    <div class="description">
        {$user.description}
    </div>
    {/if}
        
</div>
    
<article>
<section class="content">
    {if !empty($articles)}
    <section class="list">
        <section class="title">Published articles</section>
        <div class="list-container">
        {foreach from=$articles item=article}
        {include file="article_card.tpl"}
        {/foreach}
        </div>
    </section>

    <section class="switch center">
        {$result_switcher}
    </section>
    {/if}
</section>
</article>