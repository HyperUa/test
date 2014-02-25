{if count(messages) > 0}
    <div class="flash_messages">
        {foreach from = $messages item=mes}
            <script>alert('{$mes}')</script>
            {*<div>{$mes}</div>*}
        {/foreach}
    </div>
{/if}