{if count($flashMessenger) > 0}
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

    <script>
        (function() {
            Task.Message.showMessages('#messanger');
        })();
    </script>
{/if}