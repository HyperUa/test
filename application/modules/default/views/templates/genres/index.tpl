{assign var=hasAuth value= $this->auth()->hasIdentity()}

<div class="col-lg-12">

    {if $hasAuth}
        <div class="add_new">
            <a title="Добавить новый жанр" href="{$this->url([], 'genre_add')}">
                <i class="icon-large icon-plus-sign"></i>
            </a>
        </div>
    {/if}

    <h1>Список жанров</h1>

    <ul>
        {foreach from = $pagerfanta item=genre}
        <li class="task_list two-col">
            <div class="left-col">
                <h4>{$genre->getHTMLGenre()}</h4>
            </div>

            {if $hasAuth}
                <div title="Опции" class="options">
                    <i class="icon-large icon-settings"></i>

                    <div class="options-list">

                        <div class="option">
                            <a title="Редактировать"
                               href="{$this->url(['action' => 'edit', 'id' => $genre->getId()], 'genre_opt')}">
                                <i class="icon-large icon-edit"></i>
                                Edit
                            </a>
                        </div>

                        <div class="option">
                            <a class="use_modal_confirm" title="Удалить"
                               href="{$this->url(['action' => 'delete', 'id' => $genre->getId()], 'genre_opt')}">
                                <i class="icon-large icon-remove"></i>
                                Delete
                            </a>
                        </div>

                    </div>
                </div>
            {/if}
        </li>
        {/foreach}
    </ul>

    {include file="pagination.tpl"}
</div>