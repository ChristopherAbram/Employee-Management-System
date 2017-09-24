<section class="title">{$title}</section>

<section class="form">
    <form id="member" method="post" action="{$panel.link}/member/{$user.id}">
        
        <table style="width: 100%;">
            <tr>
                <td style="float: left; width: 250px;">
                    <div style="border: solid 1px #ddd; height: 250px;">
                    {if isset($user.avatar) and isset($user.avatar.miniature)}
                        <img src="{$user.avatar.miniature}" alt="avatar" width="250" height="250">
                    {else}
                        <img src="{$home.link}/{$path.img}/users.png" alt="avatar" width="250" height="250">
                    {/if}
                    </div>
                </td>
                
                <td style="float: left; padding: 0px 0 0 20px;">
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
                </td>
            </tr>
        </table>
    
        {if $citation.input->value() neq ''}
        <div class="field">
            <span>{$citation.title}</span>
            <span class="description">{$citation.input->value()}</span>
        </div>
        {/if}
    
        {if $description_.input->value() neq ''}
        <div class="field">
            <span>{$description_.title}</span>
            <span class="description">{$description_.input->value()}</span>
        </div>
        {/if}
        
        <div class="field">
            <span>{$sex.title}</span>
            <div style="width: 100%; overflow: hidden;">
                <div style="float: left; width: 90px;">{$sex.male} {$sex.male_title}</div>
                <div style="float: left; width: 90px;">{$sex.female} {$sex.female_title}</div>
            </div>
            <div class="description">{$sex.description}</div>
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
                <div style="float: left; width: 200px;">{$plain.input} {$plain.title}</div>
            </div>
            <span class="description">{$plain.description}</span>
        </div>
    
    </form>
</section>