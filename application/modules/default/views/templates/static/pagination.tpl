{assign var="pages" value = $paginator->getPages()}

{if $pages->pageCount > 1}
    <ul id="paginator">

        {if (isset($paginator->getPages()->previous))}
            <li>
                <a class="page-prev" href="{$this->url(['page' => $pages->previous])}">Previous</a>
            </li>
        {/if}

        {foreach from = $pages->pagesInRange item=page}

            {if $page != $pages->current}
                <li>
                    <a class="page-item" href="{$this->url(['page' => $page], 'home')}">
                        {$page}
                    </a>
                </li>
            {else}
                <li>
                    <span class="active">
                        {$page}
                    </span>
                </li>
            {/if}

        {/foreach}

        {if isset($pages->next)}
            <li>
                <a class="page-next" href="{$this->url(['page' => $pages->next])}">Next</a>
            </li>
        {/if}

    </ul>
{/if}