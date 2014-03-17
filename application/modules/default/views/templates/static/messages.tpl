<div class="hide" id="messanger">
    <div class="messages">
        {foreach from = $flashMessenger item = message}
            <p>
                <i class="icon-large icon-exclamation-sign"></i>
                <span>{$message}</span>
            </p>
        {/foreach}
    </div>
</div>

{if count($flashMessenger) > 0}
    <script>
        (function() {
            Task.Message.showMessages();
        })();
    </script>
{/if}
