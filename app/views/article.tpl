<article>
    <section class="title">{$article.title}</section>
    <section class="info">
        <span class="left">
            {if isset($article.user.avatar.miniature) and !empty($article.user.avatar.miniature)}
            <img id="author_avatar" src="{$article.user.avatar.miniature}">
            <span style="display: block; float: left; margin: 3px 0 0 0;">
                by {if isset($article.user.role.name)}{$article.user.role.name}:{/if} {if isset($article.user.profile) and $article.user.profile == 1}<a href="{$home.link}/member/{$article.user.id}">{else}<b>{/if}{$article.user.firstname} {$article.user.lastname}{if isset($article.user.profile) and $article.user.profile == 1}</a>{else}</b>{/if}<br>
                on {$article.cdate|date_format:"%B %e, %Y"}
            </span>
            {else}
            by {if isset($article.user.profile) and $article.user.profile == 1}<a href="{$home.link}/member/{$article.user.id}">{else}<b>{/if}{$article.user.firstname} {$article.user.lastname}{if isset($article.user.profile) and $article.user.profile == 1}</a>{else}</b>{/if}<br>
            on {$article.cdate|date_format:"%B %e, %Y"}
            {/if}
        </span>
        <span class="right" id="modification_date">{$last_modified}: {$article.edate|date_format:"%B %e, %Y"}</span>
    </section>
    <section class="keywords">
        {if !empty($pages)}
        <div class="keys left">
            {foreach from=$pages item=$page}
            <a href="{$home.link}/page/{$page.namepath}">{$page.title}</a>
            {/foreach}
        </div>
        {/if}
        <span class="right" id="keywords_right">
            {if $user_identified}
                {section name=gradestars start=1 loop=6 step=1}
                    <span class="grade_star {if ($rated >= $smarty.section.gradestars.index)}red{/if}" id="grade_{$smarty.section.gradestars.index}"></span>
                {/section}
            {/if}
            <span class="grade" id="grade_circle">{$article.grade}</span> 
            <span style="display: block; float: right; margin-top: -2px;">
                <span id="visit_count" title="{$visits}">
                    <span class="ico"></span>
                    <span class="count">{$article.visits}</span>
                </span>
                <span id="comments_count" title="comments">
                    <span class="ico"></span>
                    <span class="count">{$article.comments}</span>
                </span>
            </span>
        </span>
    </section>

    <section class="social_media">
        <script>function openNewWindow(url, title, width, height){ var bLeftPos = (window.screenLeft ? window.screenLeft : window.screenX), bTopPos = (window.screenTop ? window.screenTop : window.screenY),left = 0 ,top = 0, d= document, root= d.documentElement, body= d.body, wid= (window.innerWidth || root.clientWidth || body.clientWidth), hi= (window.innerHeight || root.clientHeight || body.clientHeight);left=bLeftPos+wid/2 -width/2;top=bTopPos+hi/2-height/2;window.open(url, title, 'width='+width+', height='+height+' , left='+left+', top='+top+', resizable=yes , scrollbars=yes'); return false; }</script>
        <a class="fb" href="http://www.facebook.com/share.php?u={$home.link}/article/{$article.namepath}" onclick="openNewWindow('http://www.facebook.com/share.php?u={$home.link}/article/{$article.namepath}', 'Opublikuj na Facebooku', 580, 450); return false;"></a>
        <a class="twitter" href="https://twitter.com/intent/tweet?url={$home.link}/article/{$article.namepath}" onclick="openNewWindow('https://twitter.com/intent/tweet?url={$home.link}/article/{$article.namepath}', 'Opublikuj na Twitterze', 580, 450); return false;"></a>
        <a class="g" href="https://plus.google.com/share?url={$home.link}/article/{$article.namepath}" onclick="openNewWindow('https://plus.google.com/share?url={$home.link}/article/{$article.namepath}', 'Opublikuj na Google+', 580, 450); return false;"></a>
    </section>
    
    <section class="content">
        <section class="article-description">
            {$article.description}
        </section>
        
        {$article.body}
        
        <div style="margin-top: 40px;" class="no_results">
            <p>Treść tego artykułu udostępniana jest na licencji <a href="https://creativecommons.org/licenses/by-sa/4.0/deed.pl" target="_blank" style="color: #888; text-decoration: underline;">creative commons</a>.</p>
        </div>
        
    </section>
    
    <input id="grade_count" type="hidden" value="{$article.grade_count}">
    <input id="grade_value" type="hidden" value="{$article.grade}">
    
</article>
    
<script type="text/javascript" src="{$home.link}/scripts/js/informer.js"></script>
        
{if $comments_active}
<aside>
    <section id="comments_area" class="comments">
        <section class="title">Comments</section>
        <section id="comment_set">
            <section id="no_results" style="display: none; padding: 20px 0;" class="no_results">No one has commented this article yet.</section>
        </section>
    </section>
    
    <div id="wait" style="display: none; margin: 20px 0 10px 0;">
        <img src="{$home.link}/{$path.img}/loading_small.gif" style="position: relative; left: 50%; margin-left: -25px;" />
    </div>
    
    <section class="comments" style="margin: 0;">
        <section class="comment" style="margin: 0;">
            <div id="more_comments">More &gt;</div>
        </section>
    </section>
    
    <section class="comments">
        {if $commenting}
        <section class="comment">
            <div class="logo">
                {if isset($user.avatar.miniature) && !empty($user.avatar.miniature)}
                <img src="{$user.avatar.miniature}" alt="avatar">
                {else}
                <img src="{$path.avatar}" alt="avatar">
                {/if}
            </div>
            {if isset($user.firstname, $user.lastname, $user.role.name)}
            <div class="info">
                <span>
                    <span class="author">{if isset($user.role.name)}{$user.role.name}:{/if} {if isset($user.profile) and $user.profile == 1}<a href="{$home.link}/member/{$user.id}">{else}<b>{/if}{$user.firstname} {$user.lastname}{if isset($user.profile) and $user.profile == 1}</a>{else}</b>{/if}</span><br>
                </span>
            </div>
            {/if}
            <div id="comment_field" class="content field">
                <div class="p">
                <form id="comment_form" method="get" action="">
                    <input id="article_id" type="hidden" name="article_id" value="{$article.id}"> 
                    <textarea id="comment_content"></textarea>
                    <div id="validate_message" class="message error"></div>
                    <input id="comment_submit" type="submit" value="Comment" />
                </form>
                </div>
            </div>
        </section>
        {/if}
    </section>
    
    <section class="">
    </section>
</aside>
    
<script type="text/javascript" src="{$home.link}/scripts/js/ListLoader.js"></script>
<script type="text/javascript" src="{$home.link}/scripts/js/ListRunner.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    
        var runner = new ListRunner({

            // Html blocks:
            morebutton:     $('#more_comments'),
            noresults:      $('#no_results'),
            element:        $('#comments_area'),
            info:           $('#info'),
            wait:           $('#wait'),

            // Define action for each result block:
            classifier:     '.comment',
            action:         function(index, e){literal}{{/literal}{literal}}{/literal},

            // Request parameters:
            count:          10,
            results:        '{$home.link}/getcommentlist',
            resultsexist:   '{$home.link}/nextcommentpageexists',
            parameters:     {literal}{{/literal}'article_id': {$article.id}{literal}}{/literal}

        });
            
        // Run:
        runner.run();
        
        // Highlighter:
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        
    });
    
</script>
{/if}

{if $user_identified and is_null($rated)}
<script type="text/javascript">
    $(document).ready(function(){
        // Get stars:
        var g1 = $('#grade_1');
        var g2 = $('#grade_2');
        var g3 = $('#grade_3');
        var g4 = $('#grade_4');
        var g5 = $('#grade_5');
        
        // Define action:
        function addGrade(){
            var formData = new FormData();
            var Info = new Informer(('#informer'));
            
            this.oncorrect = function(value){literal}{}{/literal};
            this.before = function(){literal}{}{/literal};
            
            var that = this;
            
            this.send = function(value){
                $.ajax( {
                    url: '{$home.link}/addarticlegrade',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        that.before();
                        formData.append( 'parameters', JSON.stringify({literal}{{/literal}'article_id' : {$article.id}, 'grade' : value{literal}}{/literal}));
                    },
                    success: function( response ){
                        var status = response.status;
                        if(status == 1){
                            that.oncorrect(value);
                        }
                        else if(status == 2){
                            if(response.messages.error && Array.isArray(response.messages.error)){
                                $('#info').attr('class', 'informer error');
                                response.messages.error.forEach(function(element, index, array){
                                    Info.throwInfo(element);
                                });
                            }
                        }
                    },
                    complete: function(jqXHR, textStatus){

                    }
                });
            };
            return this;
        };
        
        var grade = new addGrade();
        grade.before = function(){
            g1.off('click');
            g2.off('click');
            g3.off('click');
            g4.off('click');
            g5.off('click');
        };
        
        grade.oncorrect = function(value){
            var grade_value = parseFloat($('#grade_value').val());
            var grade_count = parseInt($('#grade_count').val());
            var grade_circle = $('#grade_circle');
            
            var current = value;
            var new_grade = (grade_value*grade_count + current)/(grade_count + 1);
            grade_circle.html(new_grade.toFixed(1));
        }
        
        function show_grade(ob){
            $(ob).attr('class', 'grade_star red');
        };
        
        g1.on('click', function(){
            show_grade(g1);
            grade.send(1);
        });
        
        g2.on('click', function(){
            show_grade(g1);
            show_grade(g2);
            grade.send(2);
        });
        
        g3.on('click', function(){
            show_grade(g1);
            show_grade(g2);
            show_grade(g3);
            grade.send(3);
        });
        
        g4.on('click', function(){
            show_grade(g1);
            show_grade(g2);
            show_grade(g3);
            show_grade(g4);
            grade.send(4);
        });
        
        g5.on('click', function(){
            show_grade(g1);
            show_grade(g2);
            show_grade(g3);
            show_grade(g4);
            show_grade(g5);
            grade.send(5);
        });
    });
</script>
{/if}
        
{if $commenting and $comments_active}
                    
<script type="text/javascript">
    
$(document).ready(function(){
    
    // Elements:
    var field = $('#comment_field');
    var comments = $('#comment_set');
    var form = $('#comment_form');
    var block = $('#validate_message');
    
    var content = $('#comment_content');
    var article_id = $('#article_id');
    var submit = $('#comment_submit');
    var no_results = $('#no_results');
    
    // Init informer:
    var Info = Informer($('#info'));
    
    function validate_comment(){
        var value = content.val();
        if((value.length < 8) || (value.length > 1024)){
            field.attr('class', 'content field error');
            block.html('Comment must be at least 8 and at most 1024 long.');
            return false;
        }
        else {
            field.attr('class', 'content field');
            block.html('');
        }
        return true;
    }
    
    content.on('keyup', function(){
        validate_comment();
    });
    
    function do_comment(){
        var formData = new FormData();
        
        $.ajax( {
            url: '{$home.link}/addcomment',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(){
                submit.attr('disabled', true);
                formData.append( 'content', content.val());
                formData.append( 'article_id', article_id.val());
            },
            success: function( response ){
                
                var status = response.status;
                
                if(status == 1){
                    no_results.hide();
                    content.val('');
                    if(response.messages.correct && Array.isArray(response.messages.correct)){
                        $('#info').attr('class', 'informer correct');
                        response.messages.correct.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                    comments.prepend(response.content);
                }
                else if(status == 2){
                    if(response.messages.error && Array.isArray(response.messages.error)){
                        $('#info').attr('class', 'informer error');
                        response.messages.error.forEach(function(element, index, array){
                            Info.throwInfo(element);
                        });
                    }
                }
            },
            complete: function(jqXHR, textStatus){
                submit.attr('disabled', false);
            }
        });
    }
    
    form.submit(function(){
        if(validate_comment()){
            do_comment();
        }
        return false;
    });
});
</script>
{/if}