{assign var=hasAuth value= $this->auth()->hasIdentity()}

<div class="col-lg-12">

    {if $hasAuth}
        <div class="add_new">
            <a href="{$this->url([], 'genre_add')}">Добавить</a>
        </div>
    {/if}

    <h1>Список жанров</h1>

    <ul>
        {foreach from = $pagerfanta item=genre}
        <li class="task_list two-col">
            <div class="left-col">
                <h4>{$genre->getGenre()}</h4>
            </div>

            {if $hasAuth}
                <div class="right-col">
                    <ul class="inline-list">
                        <li>
                            <a href="{$this->url(['action' => 'edit', 'id' => $genre->getId()], 'genre_opt')}">Edit</a>
                        </li>
                        <li>
                            <a href="{$this->url(['action' => 'delete', 'id' => $genre->getId()], 'genre_opt')}">Delete</a>
                        </li>
                    </ul>
                </div>
            {/if}
        </li>
        {/foreach}
    </ul>

    {include file="pagination.tpl"}
</div>