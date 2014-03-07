{if count($flashMessenger) > 0}
    <div id="messanger" class="ui-widget hide">
        <div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all messages">
            {foreach from = $flashMessenger item = message}
                <p>
                    <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
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