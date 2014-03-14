{assign var=hasAuth value= $this->auth()->hasIdentity()}

<div class="col-lg-12">

    {if $hasAuth}
        <div class="add_new">
            <a title="Добавить нового автора" href="{$this->url([], 'author_add')}">
                <i class="icon-large icon-plus-sign"></i>
            </a>
        </div>
    {/if}

    <h1>Список Авторов</h1>

    <ul>
        {foreach from = $pagerfanta item=author}
            <li class="task_list two-col">
                <div class="left-col">
                    <h4>{$author->getHTMLName()}</h4>
                </div>

                {if $hasAuth}
                    <div title="Опции" class="options">
                        <i class="icon-large icon-settings"></i>

                        <div class="options-list">

                            <div class="option">
                                <a title="Редактировать"
                                   href="{$this->url(['action' => 'edit', 'id' => $author->getId()], 'author_opt')}">
                                    <i class="icon-large icon-edit"></i>
                                    Edit
                                </a>
                            </div>

                            <div class="option">
                                <a class="use_modal_confirm" title="Удалить"
                                   href="{$this->url(['action' => 'delete', 'id' => $author->getId()], 'author_opt')}">
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