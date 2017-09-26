<style type="text/css">
    
    #departments, #responsibilities, #working-times {
        width: 300px;
    }
    
    #salary {
        width: 250px;
        font-size: 35px;
        color: #0060ff;
        border: none;
    }
    
    #salary:focus {
        box-shadow: none;
    }
    
    #desc_input {
        min-width: 80%;
        min-height: 150px;
    }
    
    #curr {
        display: block;
        font-size: 35px;
    }
</style>

<section class="form">
    
    <form id="agreement" method="post" action="">
    
    <div class="field {if $department.input->error()}error{/if}">
        <span>{$department.title}</span>
        {$department.input}
        <span class="description">{$department.description}</span>
    </div>
    
    <div class="field {if $responsibility.input->error()}error{/if}">
        <span>{$responsibility.title}</span>
        {$responsibility.input}
        <span class="description">{$responsibility.description}</span>
    </div>
    
    <div class="field {if $working_time.input->error()}error{/if}">
        <span>{$working_time.title}</span>
        {$working_time.input}
        <span class="description">{$working_time.description}</span>
    </div>
    
    <table>
        <tr>
            <td>
                <div class="field {if $salary.input->error()}error{/if}">
                    <span>{$salary.title}</span>
                    {$salary.input}
                    <span class="description">{$salary.description}</span>
                </div>
            </td>
            <td><div class="field" id="curr"><span style="position: relative; top: 43px;">EUR</span></div></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td style="width: 200px;">
                <div class="field {if $from_date.input->error()}error{/if}">
                    <span>{$from_date.title}</span>
                    {$from_date.input}
                    <span class="description">{$from_date.description}</span>
                </div>
            </td>
            
            <td style="width: 200px; padding-left: 30px;">
                <div class="field {if $to_date.input->error()}error{/if}">
                    <span>{$to_date.title}</span>
                    {$to_date.input}
                    <span class="description">{$to_date.description}</span>
                </div>
            </td>
            
        </tr>
        
    </table>
                
    <div class="field {if $desc.input->error()}error{/if}">
        <span>{$desc.title}</span>
        {$desc.input}
        <span class="description">{$desc.description}</span>
    </div>
    
    </form>
</section>