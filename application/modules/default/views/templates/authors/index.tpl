{assign var=hasAuth value= $this->auth()->hasIdentity()}

<div class="col-lg-12">

    {if $hasAuth}
        <div class="add_new">
            <a href="{$this->url([], 'author_add')}">Добавить</a>
        </div>
    {/if}

    <h1>Список Авторов</h1>

    <ul>
        {foreach from = $pagerfanta item=author}
            <li class="task_list two-col">
                <div class="left-col">
                    <h4>{$author->getName()}</h4>
                </div>

                {if $hasAuth}
                    <div class="right-col">
                        <ul class="inline-list">
                            <li>
                                <a href="{$this->url(['action' => 'edit', 'id' => $author->getId()], 'author_opt')}">Edit</a>
                            </li>
                            <li>
                                <a href="{$this->url(['action' => 'delete', 'id' => $author->getId()], 'author_opt')}">Delete</a>
                            </li>
                        </ul>
                    </div>
                {/if}
            </li>
        {/foreach}
    </ul>

    {include file="pagination.tpl"}
</div>